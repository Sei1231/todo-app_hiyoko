<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // 登録画面を表示するメソッド
    // 自作の register.blade.php を表示するだけの処理
    public function showRegisterForm()
    {
        return view('authMain.register'); // 登録フォームのビューを表示
    }

    // 登録処理（ユーザーの新規作成）
    public function register(Request $request)
    {
        // 入力されたデータのバリデーション（チェック）
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // 名前は必須、文字列、最大255文字
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // メールはユニーク（他と重複できない）
            'password' => ['required', 'confirmed', 'min:8'], // パスワードは確認フィールドと一致、8文字以上
        ]);

        // データベースに新しいユーザーを作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードは暗号化して保存
        ]);

        // 作成したユーザーで自動ログイン
        Auth::login($user);

        // タスク一覧ページへリダイレクト
        return redirect('tasks/index');
    }

    // ログイン画面を表示するメソッド
    public function showLoginForm()
    {
        return auth()->check() ? redirect()->route('tasks.index') : view('authMain.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // 入力されたメールアドレスとパスワードのみを取得
        $credentials = $request->only('email', 'password');

        // 認証が成功した場合
        if (Auth::attempt($credentials)) {
            // セッションIDを再生成（セキュリティ上の理由）
            $request->session()->regenerate();

            // タスク一覧ページへリダイレクト
            return redirect('tasks/index');
        }

        // 認証失敗時、元の画面に戻りエラーメッセージを表示
        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。', // メール欄にエラーとして表示される
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        // ログアウト実行
        Auth::logout();

        // セッション情報を無効化して、CSRF対策のトークンを再生成
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログイン画面に戻る
        return redirect('/login');
    }
}
