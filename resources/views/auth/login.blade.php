{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('main')
@section('content')
    <div class="card w-50 center top">
        <p class="mt-5 jp-ttl">社内OJT</p>
        <p class="eng-ttl">Bulletin Board</p>
        <form action="{{ route('login') }}" method="post" class="form">
            @csrf
            <div class="form-group">
                <input type="email" class="form-control" placeholder="メールアドレス" name="email" value="{{ old('email') }}">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group mt-4">
                <input type="password" class="form-control" placeholder="パスワード" name="password" value="{{ old('password') }}">
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>
            <input type="submit" value="ログイン" class="btn btn-primary w-100 mt-4 login-btn">
            <a href="{{ route('password.request') }}" class="forget-password">パスワードを忘れる方はこちらへ</a>
        </form>
    </div>
@endsection
