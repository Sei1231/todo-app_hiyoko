@extends('layouts.app')
@section('title', 'タスク登録')

@section('content')
    <div class="task-form">
        <h2 class="task-form__heading">タスク登録</h2>

        <form action="{{ route('tasks.store') }}" method="POST" class="task-form__body">
            @csrf

            {{-- タイトル --}}
            <div class="task-form__group">
                <label for="title" class="task-form__label">タイトル</label>
                <input type="text" id="title" name="title" class="task-form__input" placeholder="タイトルを入力"
                    value="{{ old('title') }}" required>
            </div>

            {{-- 詳細 --}}
            <div class="task-form__group">
                <label for="description" class="task-form__label">詳細</label>
                <textarea id="description" name="description" rows="5" class="task-form__input task-form__input--textarea"
                    placeholder="詳細・・・">{{ old('description') }}</textarea>
            </div>

            {{-- 期限 --}}
            <div class="task-form__group">
                <label for="time" class="task-form__label">期限</label>
                <input type="datetime-local" id="time" name="time" class="task-form__input"
                    value="{{ old('due_at') }}" required>
            </div>

            {{-- ジャンル --}}
            <div class="task-form__group">
                <label for="category_id" class="task-form__label">ジャンル</label>
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

            {{-- 送信 --}}
            <div class="task-form__actions">
                <button type="submit" class="task-form__submit-btn">送信</button>
            </div>
        </form>
    </div>
@endsection
