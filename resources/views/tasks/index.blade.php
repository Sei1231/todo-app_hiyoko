@extends('layouts.app')

@section('content')
    <style>
        .todo-list {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .todo-checkbox {
            transform: scale(1.2);
            /* margin-top: 6px; */
            cursor: pointer;
        }

        .todo-container {
            display: flex;
            align-items: flex-start;
            background-color: #fff8dc;
            border: 1px solid #e0e0e0;
            padding: 8px 12px;
            border-radius: 8px;
            box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
            min-height: 32px;
            transition: background-color 0.2s ease;
        }

        .todo-container:hover {
            background-color: #fef3c7;
        }

        .todo-date-column {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-right: 15px;
            min-width: 80px;
            font-size: 0.9em;
        }

        .todo-date-year {
            font-weight: bold;
            color: #bbb;
            font-size: 0.9em;
            margin-bottom: 3px;
        }

        .todo-date-month {
            font-size: 1.1em;
            color: #f59e0b;
            margin-bottom: 2px;
        }

        .todo-date-time {
            font-size: 0.9em;
            color: #777;
        }

        .todo-content {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex-grow: 1;
        }

        .todo-title {
            font-weight: bold;
            font-size: 1.3em;
            color: #4b3b2b;
        }

        .todo-detail {
            font-size: 0.95em;
            color: #555;
            white-space: pre-wrap;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .todo-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-left: 15px;
            flex-shrink: 0;
        }

        .edit-button,
        .delete-button {
            padding: 4px 8px;
            font-size: 0.85em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit-button {
            background-color: #4caf50;
            color: white;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
        }
    </>


    </style>

    <h1>ToDoリスト</h1>
    <p>今日の日付：{{ $today }}</p>


    <h2>新しいタスクを追加</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <input type="text" name="title" placeholder="タスク名">
        <input type="date" class="todo-date-month" name="time" class="todo-date-time">
        <div class="form-group mb-3">
            <label for="genre">ジャンル</label>
            <select name="genre" id="genre">
                <option value="">選択してください</option>
                {{-- <option value="TODAY">TODAY</option>
                <option value="勉強">勉強</option>
                <option value="家族">家族</option>
                <option value="娯楽">娯楽</option>
                <option value="バイト">バイト</option>
                <option value="その他">その他</option> --}}
                `@foreach ($kinds as $kind )
            <option value="{{ $kind->id }}">{{ $kind->name }}</option>

                @endforeach
            </select>
        </div>
        <button type="submit">追加</button>
    </form>

    <h2>未完了のタスク</h2>
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->title }}（期限：{{ $task->time }}）
                @if ($task->genre)
                    <span\
                    \
                        style="margin-left: 10px; background-color: #eee; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">
                        ジャンル：{{ $task->genre }}
                    </span>
                @endif

                <a href="{{ route('tasks.edit', $task->id) }}" class="edit-button"
                    >編集</a>
                <form method="POST" action="{{ route('tasks.done', $task->id) }}" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">完了</button>
                </form>
                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                    style="display:inline; margin-left: 8px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>完了済みのタスク</h2>
    <ul>
        @foreach ($tasks_done as $task)
            <li>{{ $task->title }}（完了日：{{ $task->done_at }}）

                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                    style="display:inline; margin-left: 8px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h3>ジャンルで絞り込む</h3>
    {{-- <ul>
        <li><a href="{{ route('tasks.index') }}">すべて表示</a></li>
        <li><a href="{{ route('tasks.genre', 'TODAY') }}">TODAY</a></li>
        <li><a href="{{ route('tasks.genre', '勉強') }}">勉強</a></li>
        <li><a href="{{ route('tasks.genre', '家族') }}">家族</a></li>
        <li><a href="{{ route('tasks.genre', '娯楽') }}">娯楽</a></li>
        <li><a href="{{ route('tasks.genre', 'バイト') }}">バイト</a></li>
        <li><a href="{{ route('tasks.genre', 'その他') }}">その他</a></li>
    </ul> --}}

    <ul>
        @foreach ($kinds as $kind )
            <li value="{{ $kind->id }}">{{ $kind->color-code }}</li>
        @endforeach
    </ul>
    @if (isset($genre))
        <h2>ジャンル: {{ $genre }}</h2>
    @endif
@endsection
