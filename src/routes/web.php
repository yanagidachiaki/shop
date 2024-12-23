<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FavoriteController;

// 登録フォーム表示
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// 登録処理
Route::post('/register', [AuthController::class, 'register']);

//ログイン画面遷移
Route::post('/login', [AuthController::class, 'login']);

//サンクスページ表示、会員登録ありがとうございます
Route::get('/thanks', function () {
    return view('thanks'); // サンクスページを表示
});

//トップページ表示用のルート
Route::get('/', [ShopController::class, 'index'])->name('home');

// いいねボタン押下時のルート
Route::post('/', [FavoriteController::class, 'like'])->name('like');

//お気に入りボタンがfavoritesテーブルに登録保存
// お気に入り保存用のルート
Route::post('/favorite', [ShopController::class, 'storeFavorite'])->middleware('auth')->name('favorites.store');

// お気に入り削除用のルート
Route::delete('/mypage', [ShopController::class, 'destroyFavorite'])->middleware('auth')->name('favorites.destroy');

// ログインしているユーザーのみアクセス可能
Route::get('/mypage', [ShopController::class, 'mypage'])->middleware('auth');

// 予約完了ページ
Route::get('/done', [ShopController::class, 'done'])->middleware('auth');

// キーワード検索のためのルート
Route::get('/shops/search', [ShopController::class, 'search'])->name('shops.search');

// 予約登録のためのルート
Route::post('/done', [ShopController::class, 'store'])->middleware('auth')->name('reservations.store');

// ホームから飲食店詳細ページのルート
Route::get('/detail/:{shop_id}', [ShopController::class, 'show']);
// ->name('shop.detail')

//mypageから詳細ページへのルート
Route::get('/detail/:{id}', [ShopController::class, 'show'])->middleware('auth')->name('shop.show');

// 予約削除ルート
Route::delete('/reservations/{id}', [ShopController::class, 'destroy'])->name('reservations.destroy');


