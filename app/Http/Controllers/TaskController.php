<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // タスク一覧を表示（未完了・完了を分けて取得）
    public function index()
    {
        $today = now()->toDateString(); // 今日の日付を取得

        // 未完了のタスク（ログイン中のユーザー限定）
        $tasks = Task::where('user_id', auth()->id())
            ->whereNull('done_at')
            ->orderBy('time')
            ->get();

        // 完了済みのタスク
        $tasks_done = Task::where('user_id', auth()->id())
            ->whereNotNull('done_at')
            ->get();

        // ビューにデータを渡して表示（authMain/tasklist.blade.php）
        return view('authMain.tasklist', compact('today', 'tasks', 'tasks_done'));
    }

    // タスクの登録処理
    public function store(Request $request)
    {
        // バリデーション（入力チェック）
        $request->validate([
            'title' => 'required',
            'time' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        // タスクの新規作成（ログインユーザーに紐づけ）
        Task::create([
            'title' => $request->title,
            'time' => $request->time,
            'genre' => $request->genre,
            'user_id' => auth()->id(), // ← ここでユーザーと紐づける
        ]);

        return redirect()->route('tasks.main'); // /tasklistMain に戻る
    }

    // タスクを完了にする処理
    public function done($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['done_at' => now()]);
        return redirect()->route('tasks.main');
    }

    // タスクの編集画面を表示
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task')); // ← これはそのままでOK（editページ用）
    }

    // タスクの削除処理
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.main');
    }

    // タスクの更新処理（編集画面から）
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required',
            'time' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->only('title', 'time', 'genre'));

        return redirect()->route('tasks.main');
    }

    // ジャンルでタスクを絞り込む処理
    public function filterByGenre($genre)
    {
        $today = now()->toDateString();

        // 未完了タスク（ジャンル指定）
        $tasks = Task::where('user_id', auth()->id())
            ->where('genre', $genre)
            ->whereNull('done_at')
            ->orderBy('time')
            ->get();

        // 完了済みタスク（ジャンル指定）
        $tasks_done = Task::where('user_id', auth()->id())
            ->where('genre', $genre)
            ->whereNotNull('done_at')
            ->get();

        return view('authMain.tasklist', compact('today', 'tasks', 'tasks_done', 'genre'));
    }
}
