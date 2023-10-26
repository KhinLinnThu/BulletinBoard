<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function ChangePasswordForm()
    {
        return view('auth/passwordchange');
    }

    public function passwordChange(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect('/')->with('success', 'Password changed successfully.');
        } else {
            return back()->with('error', 'Current password is incorrect.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showLinkRequestForm()
    {
        return view('auth/forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $token = Str::random(20);
        $data = DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        $action_link = route('password#reset', ['token' => $token, 'email' => $request->email]);
        $body = "氏名　：" . $request->email . "<br>" . "パスワード　：";
        $mail = Mail::send(
            'emails.forget_password',
            ['action_link' => $action_link, 'body' => $body],
            function ($message) use ($request) {
                $message->from('scm.khinlinthu@gmail.com', 'Khin Linn Thu');
                $message->to($request->email)
                    ->subject('Reset Password Confirmation Email');
            }
        );
        return back()->with(['data' => $data, 'mail' => $mail])
            ->with('message', 'メールアドレス宛にパスワードを送信しました。');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth/reset-password')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token,
            ])
            ->first();
        //dd($updatePassword);
        if (!$updatePassword) {
            return false;
        } else {
            $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);
            $data = DB::table('password_resets')->where(['email' => $request->email, 'token' => $request->token])->delete();
        }

        if ($data) {
            return redirect()->route('user#login')->with('message', 'パスワードリセットしました。');
        } else {
            return back();
        }
    }

}
