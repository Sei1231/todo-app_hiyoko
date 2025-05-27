{{-- resources/views/todo/index.blade.php --}}

@extends('layouts.app')

@section('title', 'TO DO LIST')


@section('content')

    <div class="wrapper">


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
    <a href="{{ route('tasks.create') }}" class="fab"><i class="fa-solid fa-plus"></i></a>
@endsection
