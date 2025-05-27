@extends('layouts.app')

@section('content')
    <h1>完了済みのタスク一覧</h1>
    <p>今日の日付：{{ $today }}</p>

    <ul>
        @forelse ($tasks_done as $task)
            <li>
                {{ $task->title }}（完了日：{{ \Carbon\Carbon::parse($task->done_at)->format('Y-m-d H:i') }})
            </li>
        @empty
            <li>完了タスクはありません。</li>
        @endforelse
    </ul>

    <a href="{{ route('tasks.index') }}">← 未完了タスク一覧に戻る</a>
@endsection
