@extends('layouts.app')

@section('content')
<h2>タスク編集</h2>

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    <label for="title">タイトル</label>
    <input type="text" name="title" value="{{ old('title', $task->title) }}" required>

    <label for="time">期限</label>
    <input type="datetime-local" name="time" value="{{ \Carbon\Carbon::parse($task->time)->format('Y-m-d\TH:i') }}" required>

    <label for="genre">ジャンル</label>
    <select name="genre">
        <option value="">選択してください</option>
        <option value="TODAY" {{ $task->genre === 'TODAY' ? 'selected' : '' }}>TODAY</option>
        <option value="勉強" {{ $task->genre === '勉強' ? 'selected' : '' }}>勉強</option>
        <option value="家族" {{ $task->genre === '家族' ? 'selected' : '' }}>家族</option>
        <!-- 他のジャンルも追加 -->
    </select>

    <button type="submit">更新</button>
</form>
@endsection
