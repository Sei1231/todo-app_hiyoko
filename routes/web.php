<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| 各ページのURLと、それに対応する処理（コントローラーやビュー）を定義するファイル
*/

// 最初のページ（Welcomeなど）を表示

Route::get('/firstpage', function () {
    return view('firstpage');
});

// 自作のログイン画面を表示
Route::get('/loginMain', function () {
    return view('authMain.login');
});
// ✅ /tasklistMain：タスク一覧ページを表示（TaskControllerを使ってタスクを渡す）
Route::get('/tasklistMain', [TaskController::class, 'index'])->middleware('auth')->name('tasks.main');

// ✅ タスク作成ページ（createフォーム）
Route::get('/createMain', function () {
    return view('authMain.create');
});

Route::get('/createMain', function () {
    return view('authMain.create');
});

// ダッシュボードページ（ログイン後のみ表示）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィールの編集・更新・削除（ログインユーザーのみ）
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breezeなどのデフォルト認証を無効化するなら、以下をコメントアウト
// require __DIR__.'/auth.php';


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('custom.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('custom.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('custom.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('custom.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('custom.logout');

// ✅ タスク機能のルート群（全てログイン中のみアクセス可）
Route::get('/', [TaskController::class, 'index'])->middleware(['auth'])->name('tasks.index'); // ホームでタスク一覧
Route::post('/tasks', [TaskController::class, 'store'])->middleware(['auth'])->name('tasks.store'); // タスク追加
Route::patch('/tasks/{id}/done', [TaskController::class, 'done'])->middleware(['auth'])->name('tasks.done'); // 完了チェック
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware(['auth'])->name('tasks.edit'); // 編集画面表示
Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware(['auth'])->name('tasks.update'); // 更新処理
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware(['auth'])->name('tasks.destroy'); // 削除処理
Route::get('/tasks/genre/{genre}', [TaskController::class, 'filterByGenre'])->middleware(['auth'])->name('tasks.genre'); // ジャンル別フィルター
