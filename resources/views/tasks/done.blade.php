@extends('layouts.app')

@section('content')
    <h1 class="done_task_view">完了済みのタスク一覧</h1>
    <p class="today_done_task">今日の日付：{{ $today }}</p>

    <ul>
        @forelse ($tasks_done as $task)
            <li>
                {{ $task->title }}（完了日：{{ \Carbon\Carbon::parse($task->done_at)->format('Y-m-d H:i') }}
            </li>
        @empty
            <li class="no_done_task">完了タスクはないよ！</li>
        @endforelse
    </ul>

    <a href="{{ route('tasks.index') }}">← 未完了タスク一覧に戻る</a>
@endsection
