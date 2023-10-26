@extends('header')
@section('content')
    <div class="sec-content">
        <p class="content-ttl">新規投稿</p>
        <form action="{{ route('post#update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="create-tb">
                <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                <tr>
                    <td><label for="name">投稿タイトル</label></td>
                    <td>
                        <input type="text" name="title" value="{{ $post['title'] }}">
                        @error('title')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="description">投稿内容</label></td>
                    <td>
                        <textarea type="text" name="description" rows="4" cols="50">{{ $post['description'] }}</textarea>
                        @error('description')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="authority">公開ステータス</label></td>
                    <td>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" name="status" type="checkbox" role="switch"
                                id="flexSwitchCheckChecked" value="1"
                                {{ $post['status'] || old('status', 0) === 1 ? 'checked' : '' }}>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="reset" class="cmn-btn reset-btn">クリア</button>
            <button type="submit" class="cmn-btn confirm-btn">更新</button>
        </form>
    </div>
@endsection
