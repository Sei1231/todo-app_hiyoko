@extends('layouts.app')
@section('content')

@include('layouts.sidebar')

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
</style>

<div class="main-content">
    @for ($i = 0; $i < 5; $i++)
    <div class="todo-list">
        <input type="checkbox" class="todo-checkbox">
        <div class="todo-container">
            <div class="todo-date-column">
                <div class="todo-date-year">2025</div>
                <div class="todo-date-month">05-23</div>
                <div class="todo-date-time">21:00</div>
            </div>
            <div class="todo-content">
                <div class="todo-title">会議資料の作成</div>
                <div class="todo-detail">詳細が折り返されて表示されますが、行間や余白は控えめでコンパクトに収まります。</div>
            </div>
            <div class="todo-actions">
                <button class="edit-button">編集</button>
                <button class="delete-button">削除</button>
            </div>
        </div>
    </div>
    @endfor
</div>

<div class="add-todo">
    <button class="add-button">＋</button>
</div>
<!-- 削除確認モーダル -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0;
    width: 100%; height: 100%; background: rgba(0,0,0,0.5);
    z-index: 1000; justify-content: center; align-items: center;">
    <div style="background: white; padding: 50px 50px; border-radius: 10px; text-align: center;">
        <p style="margin-bottom: 10px">本当に削除しますか？</p>
        <button id="confirmDeleteBtn" style="background-color: red; color: white; padding: 8px 20px; margin-right: 10px; border-radius: 10%;">削除</button>
        <button id="cancelDeleteBtn" style="background-color: gray; color: white; padding: 8px 20px; border-radius: 10%;">戻る</button>
    </div>
</div>
<script>
    let currentDeleteButton = null;

    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', (e) => {
            currentDeleteButton = e.target;
            document.getElementById('deleteModal').style.display = 'flex';
        });
    });

    document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
        document.getElementById('deleteModal').style.display = 'none';
    });

    document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
        // 削除処理の実行（仮にDOMから消す）
        const todoItem = currentDeleteButton.closest('.todo-list');
        todoItem.remove();

        document.getElementById('deleteModal').style.display = 'none';
    });
</script>

@endsection
