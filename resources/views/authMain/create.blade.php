@extends('layouts.app')

@section('content')
@include('layouts.sidebar')

<style>

    body {
        margin: 20 0 0 300px;
        padding: 0;
    }

    .todo-container {
    background-color: #fff8dc;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-height: 600px;
    margin-left: 300px;    中央寄せ
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* 見た目も整える */
}

    .todo-header {
        color: #000000;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        white-space: nowrap;
    }

    .register-btn {
        border-radius: 20px;
        display: block;
        margin-bottom: 20px;
    }

    .form-box {
        background-color: #ffe26f;
        margin-left: 50px;
        padding: 50px;
        border-radius: 15px;
        width: 100%;
    }

    .form-box label {
        font-weight: bold;
        position: relative;
    }

    input[type="text"], input[type="datetime-local"], textarea {
    border: 2px solid #ffdb4d;       /* 黄色っぽい枠線 */
    border-radius: 8px;               /* 角丸 */
    background-color: #fff9e6;        /* 薄い黄色の背景 */
    padding: 8px;
    box-sizing: border-box;
    transition: border-color 0.3s, background-color 0.3s;
}

input[type="text"]:focus, input[type="datetime-local"]:focus, textarea:focus {
    border-color: #ffbf00;            /* フォーカス時は濃い黄色 */
    background-color: #fff3b0;        /* フォーカス時の背景色 */
    outline: none;
}

textarea {
    resize: none;
}



    .genre-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .genre-buttons .btn-today {
        background-color: #17d239;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #17d239;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-study {
        background-color: #f5156f;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #f5156f;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-family {
        background-color:#113ceb;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #113ceb;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-entertainment {
        background-color: #f77d1a;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #f77d1a;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-parttime {
        background-color: #b42ed9;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #b42ed9;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-etc {
        background-color: #000;
        color: white;
        padding: 5px 30px;
        border-radius: 10px;
        border-color: #000;
        border: 2px solid transparent;
    }

    .genre-buttons .btn-today:hover,
    .genre-buttons .btn-study:hover,
    .genre-buttons .btn-family:hover,
    .genre-buttons .btn-entertainment:hover,
    .genre-buttons .btn-parttime:hover,
    .genre-buttons .btn-etc:hover {
    border-color: white;
    }


    .submit-btn {
        border-radius: 10px;
        display: block;
        margin: 0 auto;
        background-color: #17a2b8;
        padding: 10px 30px;
    }

    .submit-btn:hover {
    background-color: #00ddff; /* より濃いブルー */
}

</style>

<div class="container todo-container">

    <h2 class="todo-header">タスク登録</h2>

    <form action="#" method="POST" class="form-box">
        @csrf

        <div class="form-group mb-3">
            <label for="title">タイトル <span style="color: red;">必須</span></label>
            <input type="text" name="title" id="title" class="form-control" placeholder="タイトルを入力" required style="width: 100%;">
        </div>

        <div class="form-group mb-3">
            <label for="details">詳細</label>
            <textarea name="details" id="details" class="form-control" rows="7" cols="155" placeholder="詳細を入力してください"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="deadline">期限</label>
            <input type="datetime-local" name="deadline" id="deadline" class="form-control" value="2025-05-25T17:00">
        </div>

        <div class="form-group mb-3">
            <label>ジャンル</label>
            <div class="genre-buttons">
                <button type="button" class="btn btn-today">TODAY</button>
                <button type="button" class="btn btn-study">勉強</button>
                <button type="button" class="btn btn-family">家族</button>
                <button type="button" class="btn btn-entertainment">娯楽</button>
                <button type="button" class="btn btn-parttime">バイト</button>
                <button type="button" class="btn btn-etc">その他</button>
            </div>
        </div>

        <button type="submit" class="btn btn-primary submit-btn">送信</button>
    </form>
</div>
@endsection
