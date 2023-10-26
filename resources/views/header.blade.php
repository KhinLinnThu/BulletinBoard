@extends('main')

<header class="header">
    <h1>社内OJT Bulletin Board</h1>
    <nav class="nav">
        <ul class="menu">
            <li><a href="{{ route('home') }}">ホーム</a></li>
            <li><a href="{{ route('user#management') }}">ユーザー管理</a></li>
            <li><a href="{{ route('post#management') }}">投稿管理</a></li>
        </ul>
        {{-- <div>
            @if (Route::has('login'))
                @auth
                    <a href="#" class="user-name"> {{ Auth::user()->name }}</a>
                    <ul class="dropdown-menu dropdown-menu-end border border-dark rounded-0">
                        <li><a class="dropdown-item" href="#">プロファイル</a>
                        </li>
                        <li><a class="dropdown-item" href="#">パスワード変更</a></li>
                        <li><a class="dropdown-item border-bottom-0" href="#">ログアウト</a>
                        </li>
                    </ul>
                @endauth
            @endif
        </div> --}}

        <div class="dropdown">
            @if (Route::has('login'))
                @auth
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">プロフィール</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('password#show') }}">パスワード変更</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">ログアウト</a></li>
                    </ul>
                @endauth
            @endif
        </div>
    </nav>

</header>
