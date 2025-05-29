<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('authMain.login'); // 初期画面は welcome.blade.php を表示
});

//最終的に消してください
Route::get('/editPage', function () {
    return view('tasks.edit'); // 初期画面は welcome.blade.php を表示
});

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

Route::middleware(['auth'])->prefix('tasks')->name('tasks.')->group(function () {

    Route::get('/index', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/', [TaskController::class, 'store'])->name('store');
    Route::patch('/{id}/done', [TaskController::class, 'done'])->name('done');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TaskController::class, 'update'])->name('update');
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('destroy');
    Route::get('/genre/{genre}', [TaskController::class, 'filterByGenre'])->name('genre');
    Route::get('/done', [TaskController::class, 'showDoneTasks'])->middleware('auth')->name('doneList');

    Route::get('/kind/{id}', [TaskController::class, 'filterByKind'])->name('filterByKind');

});

// 例：タスク作成ページへのルート
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
