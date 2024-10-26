@extends('layouts.app')

@section('content')
<div class="detail-container">
    <!-- Shop Information Section -->
    <div class="shop-info">
        <p><a href=" {{ route('home')}}">戻る</a></p>
        <h2>{{ $shop->shopname }}</h2>
        <img src="{{ $shop->image }}" alt="Shop Image">
        <p>#{{ $shop->area->area }}  #{{ $shop->genre->genre }}</p>
        <p>{{ $shop->info }}</p>
    </div>

    <!-- Reservation Form Section -->
    <div class="reservation-form">
        <h3>予約</h3>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}"> <!-- 現在のショップのID -->

            @auth
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- ログイン中認証されたユーザーのID -->
            @endauth

            <!-- 日付の入力 -->
            <label for="date">Date</label>
            <input type="date" id="date" name="day" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>

            <!-- 時間の入力 -->
            <label for="time">Time</label>
            <input type="time" id="time" name="time" required>

            <!-- 人数の選択 -->
            <label for="number">Number</label>
            <select id="number" name="number" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}人</option>
                @endfor
            </select>

            <!-- Reservation Summary -->
            <div class="reservation-summary">
                <p><strong>Shop:</strong> {{ $shop->shopname }}</p>
                <p><strong>Date:</strong> <span name="day" id="summary-date">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span></p>
                <p><strong>Time:</strong> <span id="summary-time"></span></p>
                <p><strong>Number:</strong> <span id="summary-number">1人</span></p>
            </div>

           @auth
             <!-- ログイン済みのユーザーに表示される予約ボタン -->
             <button type="submit" class="reserve-btn">予約する</button>
            @else
             <!-- 未ログインユーザーにはログインページへ遷移するボタンを表示 -->
             <button type="button" class="reserve-btn" onclick="window.location.href='{{ route('login') }}'">予約する</button>
            @endauth 
        </form>
    </div>
</div>
@endsection
