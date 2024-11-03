@extends('layouts.app')

@section('content')
<div class="detail-container">
    <div class="detail-container2">
     <!-- Shop Information Section -->
      <div class="shop-info">
        <a href="{{ route('home') }}"><img src="{{ asset('image/戻る.png') }}" alt="戻る" style="background-color: white; width:50px; height:auto; border-radius: 11px; 
             box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); border: 2px solid #ccc;"></a>
        <h2>{{ $shop->shopname }}</h2>
       </div>
      <div class="shop-info2">
        <img src="{{ $shop->image }}" alt="Shop Image">
        <p>#{{ $shop->area->area }}    #{{ $shop->genre->genre }}</p>
        <p>{{ $shop->info }}</p>
       </div>
    </div>

    <!-- Reservation Form Section -->
    <div class="reservation-form">
      <div class="reservation-form2">
        <h3>予約</h3>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}"> <!-- 現在のショップのID -->

            @auth
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> <!-- ログイン中認証されたユーザーのID -->
            @endauth

            <!-- 日付の入力 -->
            <label for="date"></label>
            <input type="date" id="date" name="day" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  style="width: 30%" required>

            <!-- 時間の入力 -->
            <label for="time"></label>
            <input type="time" id="time" name="time" required>

            <!-- 人数の選択 -->
            <label for="number"></label>
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
