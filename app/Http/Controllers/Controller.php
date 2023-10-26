<?php

namespace App\Http\Controllers;

use Hash;
use Storage;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request)
    {
        $validationRules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ];
        $validateMessage = [
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => 'メールアドレスの形式が間違っています。',
            'email.exists' => 'メールアドレスが違っています。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは少なくとも8つ必要です。',
        ];
        Validator::make($request->all(), $validationRules, $validateMessage)->validate();
        if (Auth::attempt(request()->except('_token'))) {
            return view('home');
        } else {
            return back()->withInput()->withErrors(
                [
                    'password' => 'パスワードが違っています。',
                ]
            );
            ;
        }
    }
    public function homeCount()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $userPostCount = Auth::user()->posts->count();
        return view('home', compact('userCount', 'postCount', 'userPostCount'));
    }

    public function userManagement()
    {
        $user_datas = User::orderBy('created_at', 'desc')->paginate(10);
        return view('user/usermanagement', compact('user_datas'));
    }
    public function userCreate()
    {
        return view('user/usercreate');
    }
    public function userConfirm(Request $request)
    {
        $this->userValidationCheck($request);
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $address = $request->address;
        $role = $request->role;
        $birthday = $request->birthday;
        if ($request->hasFile('profile')) {
            $fileName = uniqid() . $request->file('profile')->getClientOriginalName();
            $path = $request->file('profile')->storeAs('images', $fileName, 'public');
            $profile = '/storage/' . $path;
        }
        return view('user/userconfirm', compact('name', 'email', 'password', 'phone', 'address', 'role', 'birthday', 'profile', 'fileName'));
    }
    public function userCreateComplete(Request $request)
    {
        User::Create($request->all());
        return redirect()->route('user#management');
    }
    public function userEdit($id)
    {
        $user = User::where('id', $id)->first()->toArray();
        return view('user/useredit', compact('user'));
    }
    public function userUpdate(Request $request)
    {
        // $this->userValidationCheck($request);
        $updateData = request()->except(['_token', 'user_id']);
        $id = $request->user_id;

        if ($request->hasFile('profile')) {
            $oldImg = User::select('profile')->where('id', $id)->first()->toArray();
            $oldImg = $oldImg['profile'];
            Storage::delete('public/images/' . $oldImg);

            $fileName = uniqid() . $request->file('profile')->getClientOriginalName();
            $path = $request->file('profile')->storeAs('images', $fileName, 'public');
            $profile = '/storage/' . $path;
            $updateData['profile'] = $fileName;
        }

        User::where('id', $id)->update($updateData);
        return redirect()->route('user#management');
    }
    public function userDelete(Request $request)
    {
        // dd($request->all());
        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();
        return redirect()->route('user#management');
    }

    public function userSearch(Request $request)
    {
        // dd($request->all());
        $user_datas = User::where('name', 'like', '%' . $request->name . '%')
            ->where('email', 'like', '%' . $request->email . '%')
            ->whereDate('created_at', $request->create_date)
            ->paginate(10);
        ;
        return view('user/usermanagement', compact('user_datas'));
    }
    private function userValidationCheck($request)
    {
        $validationRules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm-password' => 'required_with:password|same:password|min:8',
            'role' => 'required',
            'profile' => 'required|mimes:jpg,jpeg,png',
        ];
        $validateMessage = [
            'name.required' => '氏名は必須項目です。',
            'name.min' => '氏名は少なくとも5つ必要です。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => 'メールアドレスの形式が間違っています。',
            'password.required' => 'パスワードは必須項目です。',
            'password.min' => 'パスワードは少なくとも8つ必要です。',
            'confirm-password.required' => 'ベリファイパスワードは必須項目です。',
            'confirm-password.min' => 'ベリファイパスワードは少なくとも8つ必要です。',
            'confirm-password.same' => 'パスワードは同じでなければなりません。',
            'role.required' => '権限種別は必須項目です。',
            'profile.required' => 'プロフィールは必須項目です。',
            'profile.mimes' => 'プロフィールはjpg,png,jpegになる必要があります。',
        ];
        Validator::make($request->all(), $validationRules, $validateMessage)->validate();
    }
}
