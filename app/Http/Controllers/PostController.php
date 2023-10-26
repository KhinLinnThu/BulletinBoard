<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function postManagement()
    {
        $post_datas = Post::orderBy('created_at', 'desc')->paginate(10);
//         $user = User::all();
//         $post = Post::where('created_user_id', $user->id)->get();  // Replace 1 with the ID of the post you want to retrieve.
// dd($post);
// if ($post) {
//     $userName = $post->user->name;
// }
        return view('post/postmanagement', compact('post_datas'));
    }
    public function postCreate()
    {
        return view('post/postcreate');
    }
    public function postConfirm(Request $request)
    {
        $this->userValidationCheck($request);
        $confirm_data = $request->all();
        return view('post/postconfirm', compact('confirm_data'));
    }
    public function postCreateComplete(Request $request)
    {

        $status = (isset($request->status) == '1' ? '1' : '0');
        Post::Create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $status,
            ]
        );
        return redirect()->route('post#management');
    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->first()->toArray();
        return view('post/postedit', compact('post'));
    }
    public function postUpdate(Request $request)
    {
        $this->userValidationCheck($request);
        $id = $request->post_id;
        $updateData = request()->except(['_token', 'post_id']);
        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#management');
    }
    public function postDelete($id)
    {
        Post::find($id)->delete();
        return redirect()->route('post#management');
    }

    public function postSearch(Request $request)
    {
        // dd($request->all());
        $search = $request->search;
        $post_datas = Post::where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        })
            ->where('status', 'like', '%' . $request->status . '%')
            ->paginate(10);
        return view('post/postmanagement', compact('search', 'post_datas'));
    }

    private function userValidationCheck($request)
    {
        $validationRules = [
            'title' => 'required|max:255',
            'description' => 'required',
        ];
        $validateMessage = [
            'title.required' => 'タイトルは必須項目です。',
            'title.max' => 'タイトルは255内である必要です。',
            'description.required' => '投稿内容は必須項目です。'
        ];
        Validator::make($request->all(), $validationRules, $validateMessage)->validate();
    }

}
