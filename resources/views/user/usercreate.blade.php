@extends('header')
@section('content')
    <div class="sec-content">
        <p class="content-ttl">ユーザー情報新規作成</p>
        <form action="{{ route('user#confirm') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="create-tb">
                <tr>
                    <td><label for="name">氏名</label></td>
                    <td>
                        <input type="text" name="name" placeholder="山田金太郎" value="{{ old('name') }}">
                        @error('name')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="email">メールアドレス</label></td>
                    <td>
                        <input type="email" name="email" placeholder="yamada@gmail.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="role">権限種別</label></td>
                    <td>
                        <select name="role">
                            <option value="1">アドミン</option>
                            <option value="2">ユーザー</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="birthday">生年月日</label></td>
                    <td><input type="text" name="birthday" placeholder="1980/12/11" value="{{ old('birthday') }}">
                        @error('birthday')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="">携帯電話番号</label></td>
                    <td><input type="text" name="phone" placeholder="09-1234-2121" value="{{ old('phone') }}"></td>
                </tr>
                <tr>
                    <td><label for="address">住所</label></td>
                    <td><input type="text" name="address" placeholder="xxxxxxxxxxx" value="{{ old('address') }}"></td>
                </tr>
                <tr>
                    <td><label for="profile">プロフィール</label></td>
                    <td><input type="file" name="profile">
                        @error('profile')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="password">パスワード</label></td>
                    <td>
                        <input type="password" name="password" placeholder="●●●●●●●●" value="{{ old('password') }}">
                        @error('password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>

                </tr>
                <tr>
                    <td><label for="confirm-password">確認パスワード</label></td>
                    <td><input type="password" name="confirm-password" placeholder="●●●●●●●●"
                            value="{{ old('confirm-password') }}">
                        @error('confirm-password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </table>
            <button type="reset" class="cmn-btn reset-btn">クリア</button>
            <button type="submit" class="cmn-btn confirm-btn">確認</button>
        </form>
    </div>
@endsection
