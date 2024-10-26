@extends('layouts.app')

@section('content')
    <div class="mypageuser">
        <h2>{{ Auth::user()->name }}さん</h2>
    </div>
    <div class="mypage-content">
        <div class="reservation">
            <h2>予約状況</h2>
            @foreach($reserves as $reserve)
                <div class="reservation-card">
                    <div class="reservation-header">
                        <span>予約{{ $loop->iteration }}</span>
                        <form action="{{ route('reservations.destroy', $reserve->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="close-btn" type="submit">
                                <i class="bi bi-x-circle"></i>
                            </button>
                        </form>
                    </div>
                    <div class="reservation-details">
                        <p>Shop: {{ $reserve->shop->shopname }}</p>
                        <p>Date: {{ $reserve->day }}</p>
                        <p>Time: {{ \Carbon\Carbon::parse($reserve->time)->format('H:i') }}</p>
                        <p>Number: {{ $reserve->number }}人</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="favorites">
            <h3>お気に入り店舗</h3>
            <div class="shop-info2">
                @foreach($favorites as $favorite)
                    <div class="card">
                        <img src="{{ $favorite->shop->image }}" alt="Store Image" class="card-img"> <!-- 店舗画像 -->
                        
                        <div class="card-content">
                            <h2>{{ $favorite->shop->shopname }}</h2> <!-- 店舗名 -->
                            <div class="hashtags">
                                <span>#{{ $favorite->shop->area->area }}</span> <!-- エリア -->
                                <span>#{{ $favorite->shop->genre->genre }}</span> <!-- ジャンル -->
                            </div>
                            <a href="{{ route('shop.show', ['id' => $favorite->shop->id]) }}" class="details-btn">詳しくみる</a> <!-- 詳細ページへのリンク -->

                            <form id="like-form" action="{{ route('favorites.destroy') }}" method="POST"> <!-- お気に入り削除フォーム -->
                                @csrf
                                @method('DELETE') <!-- DELETEメソッドを指定 -->
                                <input type="hidden" name="shop_id" value="{{ $favorite->shop->id }}"> <!-- 店舗IDを隠しフィールドで送信 -->
                                <button type="submit" class="like-btn1">
                                    <i class="bi bi-heart-fill" style="color: red;"></i> <!-- 赤いハートマーク -->
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
