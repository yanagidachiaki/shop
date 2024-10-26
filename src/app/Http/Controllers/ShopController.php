<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // 47都道府県のリストを配列として用意
        $prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県', 
            '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県', 
            '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県', 
            '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', 
            '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];

        // エリア情報を取得
        $areas = Area::whereIn('area', $prefectures)->get();
        $genres = Genre::all(); // ジャンル情報を取得

        // エリアIDとジャンルIDを取得
        $areaId = $request->input('area_id');
        $genreId = $request->input('genre_id');

        // 検索キーワードをリクエストから取得
        $query = $request->input('query');

        // クエリビルダーを開始
        $shopsQuery = Shop::with(['area', 'genre']);

        // エリアIDが指定されている場合、店舗をフィルタリング
        if ($areaId) {
            $shopsQuery->where('area_id', $areaId); // area_idがエリアIDと一致する店舗を取得
        }

        // ジャンルIDが指定されている場合、店舗をフィルタリング
        if ($genreId) {
            $shopsQuery->where('genre_id', $genreId); // genre_idがジャンルIDと一致する店舗を取得
        }

        // 検索キーワードがある場合、店舗名でフィルタリング
        if ($query) {
            $shopsQuery->where('shopname', 'like', '%' . $query . '%'); // shopnameカラムを使用
        }

        // フィルタリングされた店舗を取得
        $shops = $shopsQuery->get();

        // ログインしているか確認し、お気に入りデータを取得
        $favorites = [];
        if (auth()->check()) {
            $userId = auth()->id();
            $favorites = Favorite::where('user_id', $userId)->pluck('shop_id')->toArray();
        }

        // データをビューに渡して表示
        return view('index', compact('shops', 'favorites', 'areas', 'genres'));
    }

    // キーワードで店舗を検索するメソッド
    public function search(Request $request)
    {
        // 検索キーワードを取得
        $query = $request->input('query');

        // リダイレクト先のhomeルートを指定
        return redirect()->route('home')->with('query', $query);
    }

    // お気に入り店舗登録
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

        // 以外の場合はホームにリダイレクト
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
 
        if ($request->has('redirect_to')) {
            return redirect()->route('home'); // トップ画面から削除ボタンを押したとき
        } else {
            return redirect()->back(); // mypageから画面から削除ボタンを押したとき
        }
    }

    // 店舗詳細を表示
    public function show($id)
    {
        // Shopstテーブルからデータを取得
        $shop = Shop::find($id); // 特定のレコードを取得

        // ビュー（Bladeテンプレート）にデータを渡す
        return view('detail', ['shop' => $shop]);
    }

    // MyPageの表示
    public function mypage()
    {
        // ログインしているユーザーの予約データを取得し、関連するShopデータも取得
        $userReserves = Reserve::where('user_id', Auth::id())->with('shop')->get();

        // 取得したデータをデバッグ表示（ddは一時的にデバッグ用）
        // dd($userReserves);

        // ログイン中のユーザーのお気に入り店舗を取得
        $favorites = Favorite::where('user_id', Auth::id())->with('shop')->get();
        
        return view('mypage', ['favorites' => $favorites, 'reserves' => $userReserves]);
    }

    public function store(Request $request)
    {
        // 予約データの作成
        Reserve::create([
            'user_id' => $request->input('user_id'), 
            'shop_id' => $request->input('shop_id'), // 予約するショップのIDを取得
            'day' => $request->input('day'),
            'time' => $request->input('time'),
            'number' => $request->input('number'),
        ]);

        // 成功メッセージを返す
        return view('done');
    }

    // 予約完了の表示
    public function done()
    {
        // ユーザーが未ログインであれば、ログイン画面にリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login');
        } else {
            return view('done');  // 'mypage' ビューを返す
        }
    }

    public function filter(Request $request)
    {
        $areaId = $request->input('area_id');

        // 指定されたエリアIDで店舗をフィルタリング
        if ($areaId) {
            $shops = Shop::with(['area', 'genre'])
                ->where('area_id', $areaId) // area_idがエリアIDと一致する店舗を取得
                ->get();
        } else {
            // エリアが選択されていない場合は全店舗を取得
            $shops = Shop::with(['area', 'genre'])->get();
        }
    }

    public function destroy($id)
    {
        // ログイン済みのユーザーを取得
        $user = Auth::user();
        
        // ログイン済みのユーザーに関連する予約を検索
        $reserve = Reserve::where('id', $id)->where('user_id', $user->id)->first();

        $reserve->delete();
        return redirect()->back();
    }
}
