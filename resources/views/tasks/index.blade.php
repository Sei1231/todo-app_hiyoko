<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoリスト</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #fefefe;
            margin: 40px;
        }

        h1, h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], input[type="date"] {
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
</head>
<body>
    <h1>ToDoリスト</h1>
    <p>今日の日付：{{ $today }}</p>

    <h2>新しいタスクを追加</h2>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <input type="text" name="title" placeholder="タスク名">
        <input type="date" name="time">
        <button type="submit">追加</button>
    </form>

    <h2>未完了のタスク</h2>
    <ul>
        @foreach ($tasks as $task)
            <li>
                {{ $task->title }}（期限：{{ $task->time }}）
                <form method="POST" action="{{ route('tasks.done', $task->id) }}" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">完了</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>完了済みのタスク</h2>
    <ul>
        @foreach ($tasks_done as $task)
            <li>{{ $task->title }}（完了日：{{ $task->done_at }}）</li>
        @endforeach
    </ul>
</body>
</html>
