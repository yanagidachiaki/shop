@extends('layouts.app')

@section('content')
<div class="card-container">
    <div class="container">
        <div class="search-box">   
            <form action="{{ route('home') }}" method="GET">
                <select class="dropdown" id="dropdown1" name="area_id" onchange="this.form.submit()">
                    <option value="">All area</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}" {{ request('area_id') == $area->id ? 'selected' : '' }}>{{ $area->area }}</option>
                    @endforeach
                </select>
                <select class="dropdown" id="dropdown2" name="genre_id" onchange="this.form.submit()">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->genre }}</option>
                    @endforeach
                </select>
                <img src="{{ asset('image/虫眼鏡の無料アイコン8.png') }}" alt="Description" style="width: 30px; height: 30px;">
                <input type="text" class="search-input" id="search-input" name="query" placeholder="Search..." oninput="this.form.submit()" value="{{ request('query') }}" />
            </form>
        </div>
    </div>
</div>

<div class="card-container">
    @foreach($shops as $shop) <!-- 店舗データをループして表示 -->
        <div class="card">
            <img src="{{ $shop->image }}" alt="Store Image" class="card-img"> <!-- 店舗画像 -->
            <div class="card-content">
                <h2>{{ $shop->shopname }}</h2> <!-- 店舗名 -->
                <div class="hashtags">
                    <span>#{{ $shop->area->area }}</span> <!-- エリア -->
                    <span>#{{ $shop->genre->genre }}</span> <!-- ジャンル -->
                </div>
                <a href="/detail/:{{ $shop->id }}" class="details-btn">詳しくみる</a> <!-- 詳細ページへのリンク -->

                @if (Auth::check()) <!-- ユーザーがログインしているか確認 -->
                    @if (in_array($shop->id, $favorites)) <!-- お気に入りに登録されているか確認 -->
                        <form id="like-form" action="{{ route('favorites.destroy') }}" method="POST"> <!-- お気に入り削除フォーム -->
                            @csrf
                            @method('DELETE') <!-- DELETEメソッドを指定 -->
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}"> <!-- 店舗IDを隠しフィールドで送信 -->
                            <button type="submit" class="like-btn1">
                                <i class="bi bi-heart-fill" style="color: red;"></i> <!-- 赤いハートマーク -->
                            </button>
                        </form>
                    @else
                        <form id="like-form" action="{{ route('favorites.store') }}" method="POST"> <!-- お気に入り登録フォーム -->
                            @csrf
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}"> <!-- 店舗IDを隠しフィールドで送信 -->
                            <button type="submit" class="like-btn2">
                                <i class="bi bi-heart"></i> <!-- 通常のハートマーク -->
                            </button>
                        </form>
                    @endif
                @else
                    <form id="like-form" action="{{ route('like') }}" method="POST"> <!-- お気に入り登録フォーム -->
                        @csrf
                        <button type="submit" class="like-btn3">
                            <i class="bi bi-heart"></i> <!-- 通常のハートマーク -->
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
