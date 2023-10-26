@extends('header')
@section('content')
    <div class="card w-50 center top">
        <p class="mt-5 jp-ttl">パスワード変更</p>
        <p class="eng-ttl">Bulletin Board</p>
        <form method="POST" action="{{ route('password#change') }}" class="form">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control"
                    value="{{ old('current_password') }}">
                @error('current_password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control"
                    value="{{ old('new_password') }}">
                @error('new_password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control"
                    value="{{ old('new_password_confirmation') }}">
                @error('new_password_confirmation')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="cmn-btn">変更</button>
        </form>
    </div>
@endsection
