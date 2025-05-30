@extends('layouts.app')
@section('title', 'タスク編集')

@section('content')
    <div class="task-form">
        <h2 class="task-form__heading">タスク編集</h2>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="task-form__body">
            @csrf
            @method('PUT')

            {{-- タイトル --}}
            <div class="task-form__group">
                <label for="title" class="task-form__label">タイトル</label>
                <input type="text" id="title" name="title" class="task-form__input" placeholder="タイトルを入力"
                    value="{{ old('title', $task->title) }}" required>
            </div>

            {{-- 詳細 --}}
            <div class="task-form__group">
                <label for="description" class="task-form__label">詳細</label>
                <textarea id="description" name="description" rows="5" class="task-form__input task-form__input--textarea"
                    placeholder="詳細・・・">{{ old('description', $task->description) }}</textarea>
            </div>

            {{-- 期限 --}}
            <div class="task-form__group">
                <label for="time" class="task-form__label">期限</label>
                <input type="datetime-local" id="time" name="time" class="task-form__input"
                    value="{{ old('time', \Carbon\Carbon::parse($task->time)->format('Y-m-d\TH:i')) }}" required>
            </div>

            {{-- ジャンル --}}
            <div class="task-form__group">
                <label for="kind_id" class="task-form__label">ジャンル</label>
                <select name="kind_id" id="kind_id" class="task-form__input">
                    <option value="">選択してください</option>
                    @foreach ($kinds as $kind)
                        <option value="{{ $kind->id }}"
                            {{ old('kind_id', $task->kind_id) == $kind->id ? 'selected' : '' }}>
                            {{ $kind->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 送信 --}}
            <div class="task-form__actions">
                <button type="submit" class="task-form__submit-btn">更新</button>
            </div>
        </form>
    </div>
@endsection
