<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Gnere;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // いいねボタンを押したときの処理
    public function like(Request $request)
    {
        // ログインしていない場合、ログインページにリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    }
    //  public function mypage()
    // {
    //     // 現在のユーザーのお気に入り店舗を取得
    //     $favorites = Favorite::where('user_id', Auth::id())->with('shop')->get();
        
    //     // 'mypage' ビューにデータを渡す
    //     return view('mypage', ['favorites' => $favorites]);
    //     redirect()->route('/mypage');
    // }

     // お気に入り店舗の削除
    public function destroyFavorite(Request $request, $id)
    {
        // ユーザーがログインしているか確認
        if (!Auth::check()) {
            return back(); // ログインしていない場合、元のページに戻る
        }

        $userId = Auth::id(); // ログイン中のユーザーIDを取得

        // お気に入りを削除
        Favorite::where('user_id', $userId)->where('shop_id', $id)->delete();

        // ホーム画面にリダイレクト
        return redirect()->route('mypage');
    }
    
}

