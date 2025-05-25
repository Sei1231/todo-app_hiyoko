<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



Route::get('/firstpage', function () {
    return view('firstpage');
});

Route::get('/loginMain', function () {
    return view('authMain.login');
});
Route::get('/tasklistMain', function () {
    return view('authMain.tasklist');
});
Route::get('/createMain', function () {
    return view('authMain.create');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Breezeなどのデフォルト認証を無効化するなら、以下をコメントアウト
// require __DIR__.'/auth.php';

// ✅ 自作のログイン・登録ルート
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('custom.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('custom.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('custom.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('custom.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('custom.logout');
Route::get('/', [TaskController::class, 'index'])->middleware(['auth'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->middleware(['auth'])->name('tasks.store');
Route::patch('/tasks/{id}/done', [TaskController::class, 'done'])->middleware(['auth'])->name('tasks.done');
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->middleware(['auth'])->name('tasks.edit');
Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware(['auth'])->name('tasks.update');
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::get('/tasks/genre/{genre}', [TaskController::class, 'filterByGenre'])->name('tasks.genre');
