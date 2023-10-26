@extends('main')
@section('content')
<div class="card w-50 center top">
    <p class="mt-5 jp-ttl">社内OJT</p>
    <p class="eng-ttl">Bulletin Board</p>
    <div class="mt-4">
        メールアドレス宛にパスワードを送信しました。
    </div>
    <a href="{{ route('password.request') }}"  class="mail-complete btn btn-primary">ログイン画面へ</a></button>
</div>
@endsection
