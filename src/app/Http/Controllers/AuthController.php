<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\ShopRequest; 


class AuthController extends Controller
{
    // 登録フォームを表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 登録処理
    public function register(AuthorRequest $request)
    {         

         // ユーザーを作成,usersテーブルに保存
        User::create([
        'name' => $request->input('name'),  
        'email' => $request->input('email'), 
        'password' => bcrypt($request->input('password')), 
        ]);

         // thanksページにリダイレクト
         return redirect('/thanks'); 
    }

    // ログインフォームを表示
    public function showLoginForm(ShopRequest $request)
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(ShopRequest $request)
    {
          // 認証情報を取得
    $credentials = $request->only('email', 'password');

    // 認証
    if (Auth::attempt($credentials)) {
        // 認証に成功した場合のリダイレクト
        return redirect()->intended('/');
    }
     // 認証に失敗した場合、エラーメッセージをセッションに設定
    return back()->withErrors([
        'loginError' => 'メールアドレスまたはパスワードが間違っています。',
    ])->withInput($request->only('email'));

    }
}
