<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 登録フォームを表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 登録処理
    public function register(Request $request)
    {       
         // ユーザーを作成,usersテーブルに保存
        User::create([
        'name' => $request->input('name'),  
        'email' => $request->input('email'), 
        'password' => bcrypt($request->input('password')), 
        ]);

        return redirect()->route('thanks'); // ありがとうページへリダイレクト
    }

    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 認証
        if (Auth::attempt($credentials)) {
            // 認証に成功した場合のリダイレクト
            return redirect()->intended('home');
        }

        // 認証に失敗した場合のエラーメッセージ
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
