@extends('header')
@section('content')
<div class="sec-content confirm-page">
    <p class="content-ttl">ユーザー情報新規作成</p>

    <form action="{{ route('user#complete') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <table class="create-tb">
            <tr>
                <td><label for="name">氏名</label></td>
                <td>
                    <input type="text" name="name" value="{{$name}}" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="email">メールアドレス</label></td>
                <td>
                    <input type="email" name="email" value="{{$email}}" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="role">権限種別</label></td>
                <td>
                    <input type="text" name="role" value="{{$role}}" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="birthday">生年月日</label></td>
                <td><input type="text" name="birthday" value="{{$birthday}}" readonly></td>
            </tr>
            <tr>
                <td><label for="">携帯電話番号</label></td>
                <td><input type="text" name="phone" value="{{$phone}}" readonly></td>
            </tr>
            <tr>
                <td><label for="address">住所</label></td>
                <td><input type="text" name="address" value="{{$address}}" readonly></td>
            </tr>
            <tr>
                <td><label for="profile">プロフィール</label></td>
                <td>
                    <img src="{{ $profile }}" alt="profile" class="img-thumbnail">
                    <input type="hidden" name="profile" value="{{$fileName}}" readonly>
                </td>
            </tr>
            <tr>
                <td><label for="password">パスワード</label></td>
                <td><input type="password" name="password" value="{{$password}}" readonly></td>
            </tr>
        </table>
        <button type="reset" class="cmn-btn reset-btn">クリア</button>
        <button type="submit" class="cmn-btn confirm-btn">登録</button>
    </form>
</div>
@endsection
