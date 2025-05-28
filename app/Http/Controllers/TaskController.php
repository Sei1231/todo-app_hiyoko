<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\kind;
use Carbon\Carbon;

class TaskController extends Controller
{
    // タスク一覧を表示（未完了・完了を分けて取得）
    public function index()
    { {
            $today = now()->toDateString();

            // 未完了のタスク（ログインユーザー限定）
            $tasks = Task::where('user_id', auth()->id())
                ->whereNull('done_at')
                ->orderBy('time')
                ->get();

            // 完了済みのタスク（ログインユーザー限定）
            $tasks_done = Task::where('user_id', auth()->id())
                ->whereNotNull('done_at')
                ->get();

            // タスクの種類も取得
            $kinds = Kind::orderBy('id')->get();

            // ビューにデータを渡す
            return view('tasks.index', compact('today', 'tasks', 'kinds'));
        }
    }
    public function showDoneTasks()
    {
        $today = now()->toDateString();

        $tasks_done = Task::where('user_id', auth()->id())
            ->whereNotNull('done_at')
            ->orderByDesc('done_at')
            ->get();

        return view('tasks.done', compact('today', 'tasks_done'));
    }


    public function create()
    {
        $today = Carbon::now()->toDateString(); // 今日の日付を取得
        $kinds = kind::all();
        return view('tasks.create', compact('today','kinds')); // ビューに渡す
    }

    // タスクの登録処理
    public function store(Request $request)
    {

        // dd($request);
        // バリデーション（入力チェック）
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:255',
            'time' => 'required|date',
            'kind_id' => 'required|exists:kinds,id',
        ]);

        // タスクの新規作成（ログインユーザーに紐づけ）
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'time' => $request->time,
            'kind_id' => $request->kind_id,
            'user_id' => auth()->id(), // ← ここでユーザーと紐づける
        ]);

        return redirect()->route('tasks.index'); // /tasklistMain に戻る
    }

    // タスクを完了にする処理
    public function done($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['done_at' => now()]);
        return redirect()->route('tasks.index');
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
        return redirect()->route('tasks.index');
    }

    // タスクの更新処理（編集画面から）
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:255',
            'time' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->only('title', 'description', 'time', 'genre'));

        return redirect()->route('tasks.index');
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
