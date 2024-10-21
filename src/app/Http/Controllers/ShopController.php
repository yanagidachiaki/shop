<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // トップページを表示
    public function index()
    {
    // 47都道府県のリストを配列として用意
        $prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', 
            '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', 
            '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', 
            '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', 
            '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];
        // 都道府県が含まれるデータのみを取得
        $areas = Area::whereIn('area', $prefectures)->get();

        // 他のデータ（ジャンルなど）も必要に応じて取得
        $genres = Genre::all();

       

    
        // shopsテーブルからデータを取得し、areaとgenreリレーションをロード
    $shops = Shop::with(['area', 'genre'])->get();

    // ログインしているか確認し、お気に入りデータを取得
    $favorites = [];
    if (auth()->check()) {
        // ログインユーザーのIDを取得
        $userId = auth()->id();
        // ユーザーのお気に入り取得
        $favorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray(); // お気に入りのshop_idを配列に格納
    }

    // データをビューに渡して表示
    return view('index', compact('shops', 'favorites', 'areas', 'genres'));
}



    public function storeFavorite(Request $request)
    {
       // ユーザーがログインしているか確認
        if (!auth()->check()) {
            return back();
        }

        $shop_id = $request->input('shop_id'); // リクエストから shop_id を取得

        // すでにお気に入りに登録されているか確認
        $favorite = Favorite::where('user_id', auth()->id())->where('shop_id', $shop_id)->first();

        // if (!$favorite) {
            // お気に入りを保存
            Favorite::create([
                'user_id' => auth()->id(), // ログインしているユーザーのIDを取得
                'shop_id' => $shop_id,
            ]);
        // }
         // セッションのクリア
        session()->forget('favorite_deleted');

        // // ホーム画面にリダイレクト
        return redirect()->route('home'); 
    }

 public function destroyFavorite(Request $request)
{
    // ユーザーがログインしているか確認
    if (!auth()->check()) {
        return back(); // ログインしていない場合、元のページに戻る
    }


    $userId = auth()->id(); // ログイン中のユーザーIDを取得
    $shopId = $request->input('shop_id'); // リクエストから shop_id を取得

    // お気に入りを削除
    Favorite::where('user_id', $userId)->where('shop_id', $shopId)->delete();

    // favoritesテーブルに特定のshop_idが存在するか確認（削除後に確認）
    $favoriteExists = Favorite::where('shop_id', $shopId)
                              ->where('user_id', $userId)
                              ->exists();
    
     // ホーム画面にリダイレクトし、削除が成功した場合のフラグをセッションに保存
    session(['favorite_deleted' => true]);


    // ホーム画面にリダイレクト
    return redirect()->route('home');
}

    
    // 店舗詳細を表示
    // public function show($shop_id)
    public function show()
    {
        // $shop = Shop::findOrFail($shop_id); // 指定したIDの店舗を取得
        // return view('detail', compact('shop'));
        return view('detail');
    }

    // MyPageの表示
     public function mypage()
    {
        // 必要に応じてユーザーやデータの取得処理をここに追加
        // 例: $user = auth()->user(); でログインユーザーを取得
        return view('mypage');  // 'mypage' ビューを返す
    }

    // 予約完了の表示
     public function done()
    {
        return view('done');  // 'mypage' ビューを返す
    }

   }
