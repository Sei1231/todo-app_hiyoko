{{-- resources/views/todo/index.blade.php --}}

@extends('layouts.app')

@section('title', 'TO DO LIST')

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --yellow: #F7D774;
            --white: #ffffff;
            --sidebar-width: 240px;
            --header-height: 70px;
            --red: #EB473D;
            --purple: #5E16EB;
            --indigo: #4318F0;
            --blue: #46B2FF;
            --pink: #F385C6;
        }
        /*************************
           *  Top Header Bar
           *************************/
        .todo-header {
            height: var(--header-height);
            background: var(--yellow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
        }

        .todo-header h1 {
            margin: 0;
            font-weight: 600;
            letter-spacing: 2px;
            font-size: 1.8rem;
        }

        .todo-header .user {
            font-size: 32px;
            width: 48px;
            height: 48px;
            border: 2px solid #fff;
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /*************************
           *  Layout Wrapper
           *************************/
        .wrapper {
            display: flex;
        }

        /*************************
           *  Sidebar
           *************************/
        .sidebar {
            width: var(--sidebar-width);
            background: var(--yellow);
            padding: 20px 14px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            height: 100vh;
        }

        .sidebar h2 {
            margin: 0 0 8px;
            font-size: 0.9rem;
        }

        .btn {
            display: block;
            text-align: center;
            padding: 10px 12px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-template {
            background: #fff;
            color: #333;
        }

        .btn-done {
            background: #E94A35;
            color: #fff;
        }

        .btn-category {
            position: relative;
            padding-right: 36px;
        }

        .btn-category i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-work {
            background: #4C2AE5;
            color: #fff;
        }

        .btn-study {
            background: #3EB7FF;
            color: #fff;
        }

        .btn-family {
            background: #F387CA;
            color: #fff;
        }

        .settings {
            margin-top: auto;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .settings i {
            font-size: 18px;
        }

        /*************************
           *  Main Content
           *************************/
        .content {
            flex: 1;
            padding: 40px 10%;
        }

        ul.tasks {
            list-style: none;
            margin: 0;
            padding: 0 30px;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Each list item wraps the checkbox + task card */
        ul.tasks li {
            display: flex;
            align-items: flex-start;
            gap: 18px;

        }

        /* Pretty checkbox */
        .task-check {
            margin-top: 28px;
            font-size: 0; /* reset font-size to prevent layout issues */
            width: 36px !important;
            height: 36px !important;
            border: 2px solid #555;
            border-radius: 4px;
            appearance: none;
            cursor: pointer;
        }

        .task-check:checked {
            background: #39B54A !important;
            border-color: #39B54A !important;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>') !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }

        /* Task card */
        .task-card {
            position: relative;
            border-radius: 4px;
            color: #fff;
            padding: 18px 26px 14px 140px;
            /* leave space for date */
            display: flex;
            flex-direction: column;
            font-size: 14px;
            overflow: hidden;
            width: 100%
        }

        .task-card .date {
            position: absolute;
            left: 20px;
            top: 18px;
            width: 100px;
            font-size: 14px;
            line-height: 1.4;
        }

        .task-card h3 {
            margin: 0 0 6px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .task-card p {
            margin: 0;
            font-size: 13px;
            line-height: 1.4;
            opacity: 0.9;
        }

        /* Color variants */
        .red {
            background: var(--red);
        }

        .purple {
            background: var(--purple);
        }

        .indigo {
            background: var(--indigo);
        }

        .blue {
            background: var(--blue);
        }

        .pink {
            background: var(--pink);
        }

        /*************************
           *  Floating Add Button
           *************************/
        .fab {
            position: fixed;
            right: 40px;
            bottom: 120px;
            width: 104px;
            height: 104px;
            background: #19C540;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 62px;
            color: #fff;
            text-decoration: none;
        }

        /*************************
           *  Responsive
           *************************/
        @media (max-width: 960px) {
            .sidebar {
                display: none;
            }

            .task-card {
                padding-left: 110px;
                /* a bit narrower on small screens */
            }

            .todo-header {
                padding: 0 20px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2>John&nbsp;Doe のTO&nbsp;DO&nbsp;リスト</h2>
            <button class="btn btn-template">タスク一覧</button>
            <button class="btn btn-done">完了タスク一覧</button>

            <h2>John&nbsp;Doe の作成ジャンル</h2>
            <button class="btn btn-category btn-work">仕事 <i class="fa-solid fa-bars"></i></button>
            <button class="btn btn-category btn-study">勉強</button>
            <button class="btn btn-category btn-family">家族</button>

            <div class="settings"><i class="fa-solid fa-gear"></i>設定/テーマ変更</div>
        </aside>

        <!-- Main Content Area -->
        <main class="content">
            <ul class="tasks">
                <li>
                    <input type="checkbox" class="task-check" checked>
                    <article class="task-card red">
                        <div class="date">2025年<br>5月25日<br>17:00</div>
                        <h3>ひよこ開発団プロジェクト完了</h3>
                        <p>これはダミーのタスク説明テキストです。</p>
                    </article>
                </li>
                <li>
                    <input type="checkbox" class="task-check">
                    <article class="task-card purple">
                        <div class="date">2025年<br>5月26日<br>10:00</div>
                        <h3>提案書ドラフト送付</h3>
                        <p>ダミーの説明文がここに入ります。</p>
                    </article>
                </li>
                <li>
                    <input type="checkbox" class="task-check">
                    <article class="task-card indigo">
                        <div class="date">2025年<br>5月27日<br>09:00</div>
                        <h3>チームミーティング</h3>
                        <p>ミーティング準備としてアジェンダ確認。</p>
                    </article>
                </li>
                <li>
                    <input type="checkbox" class="task-check">
                    <article class="task-card blue">
                        <div class="date">2025年<br>5月28日<br>13:00</div>
                        <h3>オンライン講義視聴</h3>
                        <p>Laravel Blade 応用編を受講。</p>
                    </article>
                </li>
                <li>
                    <input type="checkbox" class="task-check">
                    <article class="task-card pink">
                        <div class="date">2025年<br>5月29日<br>18:30</div>
                        <h3>家族ディナー</h3>
                        <p>レストラン予約を確認する。</p>
                    </article>
                </li>
            </ul>
        </main>
    </div>

    <a href="#" class="fab"><i class="fa-solid fa-plus"></i></a>
@endsection
