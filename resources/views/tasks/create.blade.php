@extends('layouts.app')

@section('content')
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
@endsection
