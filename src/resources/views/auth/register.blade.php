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
                <input type="text" name="name"  placeholder="Username" required/> 
            </div>
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/メールアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="email" name="email"  placeholder="Email" required/> 
            </div>
            <div class="input-group">
                <div class="img"><img src="{{ asset('image/カギアイコン.png') }}" alt="Description" style="width: 100%; height: 100%;"></div>
                <input type="password" name="password" placeholder="Password" required/> 
            </div>
            <button type="submit">登録</button>
        </form>
     </div>
  </div>
@endsection
