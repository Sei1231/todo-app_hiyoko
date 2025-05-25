{{-- <style>
    body {
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        height: calc(100vh - 60px);
        margin-top: 60px;
    }

    .sidebar {
        width: 250px;
        background-color: #facc15;
        color: #6b4226;
        padding: 20px;
        position: fixed;
        top: 100px;
        left: 0;
        bottom: 20px;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .main-content {
        margin-left: 250px;
        padding: 30px 60px;
        flex: 1;
        overflow-y: auto;
        height: calc(100vh - 60px);
        display: flex;
        flex-direction: column;
        gap: 20px;
        scrollbar-width: none;
    }

    .main-content::-webkit-scrollbar {
        width: 8px;
    }

    .main-content::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 4px;
    }

    .add-todo {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    .section-title {
        font-weight: bold;
        margin: 25px 0 10px;
        color: #6b4226;
    }

    .template1-button,
    .template2-button,
    .today-button,
    .study-button,
    .family-button,
    .school-button,
    .work-button,
    .others-button {
        width: 210px;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .template1-button {
        background-color: #fff;
        color: #000;
        border-color: #fff;
    }

    .template2-button {
        background-color: #ff0000;
        color: #000;
        border-color: #ff0000;
    }

    .template1-button:hover {
        border-color: #000;
    }

    .template2-button:hover,
    .today-button:hover,
    .study-button:hover,
    .family-button:hover,
    .school-button:hover,
    .work-button:hover,
    .others-button:hover {
        border-color: white;
    }

    .today-button { background-color: #17d239; color: white; }
    .study-button { background-color: #f5156f; color: white; }
    .family-button { background-color: #113ceb; color: white; }
    .school-button { background-color: #f77d1a; color: white; }
    .work-button { background-color: #b42ed9; color: white; }
    .others-button { background-color: #000; color: white; }

    .add-button {
        background-color: #6b4226;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
    }


</style>

<div class="sidebar">
    <div class="menu">
        <h3 class="section-title">テンプレート</h3>
        <ul style="list-style: none; padding-left: 0;">
            <li><button class="template1-button">タスク一覧</button></li>
            <li><button class="template2-button">完了タスク一覧</button></li>
        </ul>
        <h3 class="section-title">作成ジャンル</h3>
        <ul style="list-style: none; padding-left: 0;">
            <li><button class="today-button">T O D A Y</button></li>
            <li><button class="study-button">勉　強</button></li>
            <li><button class="family-button">家　族</button></li>
            <li><button class="school-button">娯　楽</button></li>
            <li><button class="work-button">バ　イ　ト</button></li>
            <li><button class="others-button">そ　の　他</button></li>
        </ul>
    </div>
</div> --}}

@extends('layouts.app')

@section('content')
<style>
        body {
            font-family: sans-serif;
            background-color: #fefefe;
            margin: 40px;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="date"] {
            padding: 8px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 6px 12px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            background-color: #fff8dc;
            border: 1px solid #eee;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 8px;
        }
    </style>

    <h1>ToDoリスト</h1>
    <p>今日の日付：{{ $today }}</p>


    <h2>新しいタスクを追加</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <input type="text" name="title" placeholder="タスク名">
        <input type="date" name="time">
        <div class="form-group mb-3">
            <label for="genre">ジャンル</label>
            <select name="genre" id="genre">
                <option value="">選択してください</option>
                <option value="TODAY">TODAY</option>
                <option value="勉強">勉強</option>
                <option value="家族">家族</option>
                <option value="娯楽">娯楽</option>
                <option value="バイト">バイト</option>
                <option value="その他">その他</option>
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
                    <span
                        style="margin-left: 10px; background-color: #eee; padding: 4px 8px; border-radius: 4px; font-size: 0.9em;">
                        ジャンル：{{ $task->genre }}
                    </span>
                @endif
                <a href="{{ route('tasks.edit', $task->id) }}"
                    style="margin-left: 8px; background-color: #007bff; color: white; padding: 5px 10px; border-radius: 4px; text-decoration: none;">編集</a>
                <form method="POST" action="{{ route('tasks.done', $task->id) }}" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">完了</button>
                </form>
                <form method="POST" action="{{ route('tasks.destroy', $task->id) }}"
                    style="display:inline; margin-left: 8px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: red; color: white;">削除</button>
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
                    <button type="submit" style="background-color: red; color: white;">削除</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h3>ジャンルで絞り込む</h3>
    <ul>
        <li><a href="{{ route('tasks.index') }}">すべて表示</a></li>
        <li><a href="{{ route('tasks.genre', 'TODAY') }}">TODAY</a></li>
        <li><a href="{{ route('tasks.genre', '勉強') }}">勉強</a></li>
        <li><a href="{{ route('tasks.genre', '家族') }}">家族</a></li>
        <li><a href="{{ route('tasks.genre', '娯楽') }}">娯楽</a></li>
        <li><a href="{{ route('tasks.genre', 'バイト') }}">バイト</a></li>
        <li><a href="{{ route('tasks.genre', 'その他') }}">その他</a></li>
    </ul>
    @if (isset($genre))
        <h2>ジャンル: {{ $genre }}</h2>
    @endif
@endsection


