@extends('layouts.app')
@section('content')
<style>
    /* 全体はflexで横並び */
    .container {
        display: flex;
        height: calc(100vh - 60px); /* ヘッダーの高さ分を引く */
        margin-top: 60px; /* ヘッダーの高さ分だけ下げる */
        left: 120px

    }

    /* サイドバー */
    .sidebar {
        width: 250px;
        background-color: #facc15; /* 黄色基調 */
        color: #6b4226; /* 茶色っぽい文字色 */
        padding: 20px;
        position: fixed;
        top: 100px; /* ヘッダーの下から開始 */
        left: 0;
        bottom: 20px;
        overflow-y: auto;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    /* メインコンテンツ */
    .main-content {
        margin-left: 250px;
        padding: 20px;
        flex: 1;
        overflow-y: auto;
        height: calc(100vh - 60px);
    }

    /* 右下のプラスボタンは固定配置 */
    .add-todo {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    /* 見出しの色調整 */
    .section-title {
        font-weight: bold;
        margin: 25px 0px 10px 0px;
        color: #6b4226;
    }

    /* ボタンのスタイル調整 */
    .template1-button {
        background-color: #ffffff;
        color: rgb(0, 0, 0);
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #ffffff;
    }
    .template2-button {
        background-color: #ff0000;
        color: rgb(0, 0, 0);
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #ff0000;
    }

    .add-button {
        background-color: #6b4226;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
    }

    .template2-button:hover, .today-button:hover, .school-button:hover, .study-button:hover, .family-button:hover, .others-button:hover, .work-button:hover {
        /* background-color: #a15a1b; */
        border: 2px solid white;
    }

    .template1-button:hover {
        border: 2px solid rgb(0, 0, 0);
    }


    .work-button {
        background-color: #b42ed9;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #b42ed9;
    }
    .family-button {
        background-color: #113ceb;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #113ceb;
    }
    .others-button {
        background-color: #000000;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid rgb(0, 0, 0);
    }
    .school-button {
        background-color: #f77d1a;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #f77d1a;
    }
    .study-button {
        background-color: #f5156f;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #f5156f;
    }
    .today-button {
        background-color: #17d239;
        color: white;
        border: none;
        padding: 8px 12px;
        margin: 5px 0;
        border-radius: 4px;
        cursor: pointer;
        width: 210px;
        border: 2px solid #17d239;
    }
    .todo-list {
    display: flex;
    gap: 15px;
    }

.todo-wrapper {
    display: flex;
    align-items: center;
}

.todo-checkbox {
    margin-right: 10px;
    transform: scale(1.3);
    cursor: pointer;
}

.todo-container {
    display: flex;
    align-items: center;
    background-color: #fff8dc;
    border: 1px solid #e0e0e0;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 1px 1px 5px rgba(0,0,0,0.1);
    transition: background-color 0.2s ease;
    flex-grow: 1;
}

.todo-container:hover {
    background-color: #fef3c7;
}

.todo-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.todo-title {
    font-weight: bold;
    font-size: 1.1em;
    color: #4b3b2b;
}

.todo-detail {
    font-size: 0.9em;
    color: #555;
}

.todo-date {
    font-size: 0.8em;
    color: #999;
}

.todo-actions {
    display: flex;
    flex-direction: column;
    gap: 5px;
    margin-left: 15px;
}

.edit-button,
.delete-button {
    padding: 5px 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.9em;
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

{{-- <div class="container"> --}}
    <!-- サイドバー -->
    <div class="sidebar">
        <div class="menu">
            <div class="menu-section template-section">
                <h3 class="section-title">テンプレート</h3>
                <ul class="template-list" style="list-style:none; padding-left: 0;">
                    <li><button class="template1-button" type="button">タスク一覧</button></li>
                    <li><button class="template2-button" type="button">完了タスク一覧</button></li>
                </ul>
            </div>

            <div class="menu-section genre-section">
                <h3 class="section-title">作成ジャンル</h3>
                <ul class="genre-list" style="list-style:none; padding-left: 0;">
                    <li><button class="today-button">T O D A Y</button></li>
                    <li><button class="study-button">勉　強</button></li>
                    <li><button class="family-button">家　族</button></li>
                    <li><button class="school-button">娯　楽</button></li>
                    <li><button class="work-button">バ　イ　ト</button></li>
                    <li><button class="others-button">そ　の　他</button></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- メインコンテンツ -->
    <div class="main-content">
        <!-- ToDoリスト表示エリア -->
        <!-- ToDoリスト表示エリア -->
<div class="todo-list">
    <input type="checkbox" class="todo-checkbox">
    <div class="todo-container">
        <div class="todo-content">
            <div class="todo-title">ひよこ開発団プロジェクト作成</div>
            <div class="todo-detail">詳細内容がここに入ります</div>
            <div class="todo-date">2025-05-22-23:00</div>
        </div>
        <div class="todo-actions">
            <button class="edit-button">編集</button>
            <button class="delete-button">削除</button>
        </div>
    </div>
</div>


        <!-- プラスボタン -->
        <div class="add-todo">
            <button class="add-button" type="button">＋</button>
        </div>
    </div>
</div>
@endsection
