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
}
