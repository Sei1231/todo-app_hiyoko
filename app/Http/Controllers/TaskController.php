<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\kind;

class TaskController extends Controller
{
    public function index()
    {
        
        $today = now()->toDateString();
        $tasks = Task::whereNull('done_at')->orderBy('time')->get();
        $tasks_done = Task::whereNotNull('done_at')->get();
        $kinds = Kind::orderBy('id')->get();
        return view('tasks.index', compact('today', 'tasks', 'tasks_done','kinds'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'time' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        Task::create([
            'title' => $request->title,
            'time' => $request->time,
            'genre' => $request->genre,
            'user_id' => auth()->id(), // 👈これを必ず追加！
        ]);
        return redirect()->route('tasks.index');
    }

    public function done($id)
    {
        $task = Task::findOrFail($id);
        $task->update(['done_at' => now()]);
        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->route('tasks.index');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'time' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->only('title', 'time', 'genre'));

        return redirect()->route('tasks.index');
    }
    public function filterByGenre($genre)
    {
        $today = now()->toDateString();
        $tasks = Task::where('user_id', auth()->id()) // ← 忘れず追加！
            ->where('genre', $genre)
            ->whereNull('done_at')
            ->orderBy('time')
            ->get();

        $tasks_done = Task::where('user_id', auth()->id()) // ← こちらも
            ->where('genre', $genre)
            ->whereNotNull('done_at')
            ->get();

        return view('tasks.index', compact('today', 'tasks', 'tasks_done', 'genre'));
    }
}
