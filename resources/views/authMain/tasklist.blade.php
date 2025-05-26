@extends('layouts.app')
@section('content')

<style>
    /* ここはそのままでOK（デザインCSS） */
    .todo-list { display: flex; align-items: center; gap: 12px; }
    .todo-checkbox { transform: scale(1.2); cursor: pointer; }
    .todo-container {
        display: flex; align-items: flex-start; background-color: #fff8dc;
        border: 1px solid #e0e0e0; padding: 8px 12px; border-radius: 8px;
        box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1); flex-grow: 1; min-height: 32px;
        transition: background-color 0.2s ease;
    }
    .todo-container:hover { background-color: #fef3c7; }
    .todo-date-column { display: flex; flex-direction: column; align-items: flex-start; margin-right: 15px; min-width: 80px; font-size: 0.9em; }
    .todo-date-year { font-weight: bold; color: #bbb; font-size: 0.9em; margin-bottom: 3px; }
    .todo-date-month { font-size: 1.1em; color: #f59e0b; margin-bottom: 2px; }
    .todo-date-time { font-size: 0.9em; color: #777; }
    .todo-content { display: flex; flex-direction: column; gap: 4px; flex-grow: 1; }
    .todo-title { font-weight: bold; font-size: 1.3em; color: #4b3b2b; }
    .todo-detail { font-size: 0.95em; color: #555; white-space: pre-wrap; word-break: break-word; overflow-wrap: break-word; }
    .todo-actions { display: flex; flex-direction: column; gap: 6px; margin-left: 15px; flex-shrink: 0; }
    .edit-button, .delete-button { padding: 4px 8px; font-size: 0.85em; border: none; border-radius: 4px; cursor: pointer; }
    .edit-button { background-color: #4caf50; color: white; }
    .delete-button { background-color: #f44336; color: white; }
</style>

<div class="main-content">

    {{-- ✅ 未完了のタスクを表示 --}}
    @foreach ($tasks as $task)
    <div class="todo-list">
        {{-- 完了チェックボックス --}}
        <form method="POST" action="{{ route('tasks.done', $task->id) }}">
            @csrf
            @method('PATCH')
            <input type="checkbox" class="todo-checkbox" onclick="this.form.submit()">
        </form>

        <div class="todo-container">
            <div class="todo-date-column">
                {{-- 日付と時間を整形して表示（Carbon形式） --}}
                <div class="todo-date-year">{{ \Carbon\Carbon::parse($task->time)->format('Y') }}</div>
                <div class="todo-date-month">{{ \Carbon\Carbon::parse($task->time)->format('m-d') }}</div>
                <div class="todo-date-time">{{ \Carbon\Carbon::parse($task->time)->format('H:i') }}</div>
            </div>

            <div class="todo-content">
                <div class="todo-title">{{ $task->title }}</div>
                <div class="todo-detail">（ジャンル: {{ $task->genre ?? 'なし' }}）</div>
            </div>

            <div class="todo-actions">
                <a href="{{ route('tasks.edit', $task->id) }}">
                    <button class="edit-button" type="button">編集</button>
                </a>
                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button" type="submit">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    {{-- ✅ 完了済みのタスクを表示 --}}
    <h3 style="margin-top: 40px;">✅ 完了済みのタスク</h3>
    @foreach ($tasks_done as $task)
    <div class="todo-list" style="opacity: 0.6;">
        <div class="todo-container">
            <div class="todo-date-column">
                <div class="todo-date-year">{{ \Carbon\Carbon::parse($task->time)->format('Y') }}</div>
                <div class="todo-date-month">{{ \Carbon\Carbon::parse($task->time)->format('m-d') }}</div>
                <div class="todo-date-time">{{ \Carbon\Carbon::parse($task->time)->format('H:i') }}</div>
            </div>
            <div class="todo-content">
                <div class="todo-title">{{ $task->title }}</div>
                <div class="todo-detail">（ジャンル: {{ $task->genre ?? 'なし' }}）</div>
            </div>
        </div>
    </div>
    @endforeach

</div> {{-- .main-content の閉じタグ --}}
@endsection
