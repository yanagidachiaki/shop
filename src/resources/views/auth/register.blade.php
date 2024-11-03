@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="register-container">
   <div class="register-form">
        <div class="form-header"><p>Registration</p></div>
        <form class="form" action="{{ route('register') }}" method="post">
          @csrf
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/人物アイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="text" name="name" class="@error('name') error-input @enderror" placeholder="@error('name') {{ $message }} @else Username @enderror" value="{{ old('name') }}"/>
            </div>
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/メールアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="text" name="email" class="@error('email') error-input @enderror" placeholder="@error('email') {{ $message }} @else Emai @enderror" value="{{ old('email') }}"/>
            </div>
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/カギアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>       
                <input type="password" name="password" class="@error('name') error-input @enderror" placeholder="@error('password') {{ $message }} @else Password @enderror" value="{{ old('password') }}"/>
            </div>
            <button type="submit">登録</button>
        </form>
     </div>
  </div>
@endsection
