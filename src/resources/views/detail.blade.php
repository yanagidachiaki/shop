@extends('layouts.app')

@section('content')
<main>
    <section class="reservation-status">
            <h2>予約状況</h2>
            <div class="reservation-card">
                <p>予約1</p>
                <p><strong>Shop:</strong> 仙人</p>
                <p><strong>Date:</strong> 2021-04-01</p>
                <p><strong>Time:</strong> 17:00</p>
                <p><strong>Number:</strong> 1人</p>
                <button class="cancel-btn">×</button>
            </div>
        </section>
        
        <section class="favorite-shops">
            <h2>testさん</h2>
            <h3>お気に入り店舗</h3>
            <div class="shop-list">
                <div class="shop-card">
                    <img src="shop1.jpg" alt="仙人">
                    <p>仙人</p>
                    <p>#東京都 #寿司</p>
                    <a href="#" class="details-btn">詳しくみる</a>
                    <button class="favorite-btn">❤</button>
                </div>
                
                <div class="shop-card">
                    <img src="shop2.jpg" alt="牛助">
                    <p>牛助</p>
                    <p>#大阪府 #焼肉</p>
                    <a href="#" class="details-btn">詳しくみる</a>
                    <button class="favorite-btn">❤</button>
                </div>
            </div>
        </section>
    </main>

@endsection