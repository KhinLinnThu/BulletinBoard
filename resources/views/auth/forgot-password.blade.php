{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('main')
@section('content')
    <div class="card w-50 center top">
        <p class="mt-5 jp-ttl">社内OJT</p>
        <p class="eng-ttl">Bulletin Board</p>
        <form action="{{ route('password#email') }}" method="post" class="form">
            @csrf
            <div class="form-group mt-4">
                <input type="email" class="form-control" placeholder="パスワードリセットするメールアドレスを入力してください。" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="text-danger text-sm" style="font-size: 0.8rem;"><b>{{ $message }}</b></span>
                @enderror
            </div>
            <input type="submit" value="パスワードリセット" class="btn btn-primary w-100 mt-4 login-btn">
            <a href="#" class="forget-password">戻る</a>
        </form>
    </div>
@endsection
