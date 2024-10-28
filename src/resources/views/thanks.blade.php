@extends('layouts.app')

@section('content')
<div class="thanks-container">
   <div class="register-form">
        <p>会員登録ありがとうございます</p>
        <form action="{{ url('/login') }}" method="GET">
            <button type="submit">ログインする</button>
        </form>
    </div>
</div>
@endsection