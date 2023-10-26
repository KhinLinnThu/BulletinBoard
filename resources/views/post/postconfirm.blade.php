@extends('header')
@section('content')
    <div class="sec-content confirm-page">
        <p class="content-ttl">新規投稿</p>
        <form action="{{ route('post#complete') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="create-tb">
                <tr>
                    <td><label for="name">投稿タイトル</label></td>
                    <td>
                        <input type="text" name="title" value="{{ $confirm_data['title'] }}" readonly>
                    </td>
                </tr>
                <tr>
                    <td><label for="description">投稿内容</label></td>
                    <td>
                        <textarea type="text" name="description" placeholder="xxxxxxxxxxxxxxx" rows="4" cols="50" readonly>{{ $confirm_data['description'] }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td><label for="authority">公開ステータス</label></td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            value="{{ $confirm_data['status'] }}" {{ $confirm_data['status'] == 1 ? 'checked' : '' }} >
                        </div>
                    </td>
                </tr>
            </table>
            <button type="reset" class="cmn-btn reset-btn">クリア</button>
            <button type="submit" class="cmn-btn confirm-btn">登録</button>
        </form>
    </div>
@endsection
