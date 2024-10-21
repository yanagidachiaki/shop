@extends('layouts.app')

@section('content')
<div class="card-container">
  <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- CSSファイルを読み込む -->
    <title>プルダウンリストと検索ボックス</title>
</head>
<body>
    <div class="container">
        <div class="search-box">
            <select class="dropdown" id="dropdown1">
                <option value="">All area</option>
                 @foreach ($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->area }}</option>
                 @endforeach
            </select>
            <select class="dropdown" id="dropdown2">
                <option value="">All genre</option>
                 @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre }}</option>
                 @endforeach
            </select>
            <input type="text" class="search-input" placeholder="Serach..." />
        </div>
    </div>
</body>
</html>

</dv>
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
                    <!-- ログイン中の場合 -->
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
                    <!-- ログインしていない場合 -->
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
