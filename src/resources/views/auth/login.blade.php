@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
   <div class="register-form">
        <div class="form-header"><p>Login</p></div>
        <form action="/login" method="post">
        @csrf
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/メールアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"required>
            </div>
            <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/カギアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
            <button type="submit">ログイン</button>
        </form>
    </div>
</div>
@endsection