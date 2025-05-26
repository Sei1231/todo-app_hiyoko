<div class="" style>
    <a href="" class="btn btn-primary">タスク一覧</a>


    <a href="" class="btn btn-danger">完了済みのタスク一覧</a>

    <h3>ジャンルで絞り込む</h3>
    <ul>
        <li><a href="{{ route('tasks.index') }}">すべて表示</a></li>
        <li><a href="{{ route('tasks.genre', 'TODAY') }}">TODAY</a></li>
        <li><a href="{{ route('tasks.genre', '勉強') }}">勉強</a></li>
        <li><a href="{{ route('tasks.genre', '家族') }}">家族</a></li>
        <li><a href="{{ route('tasks.genre', '娯楽') }}">娯楽</a></li>
        <li><a href="{{ route('tasks.genre', 'バイト') }}">バイト</a></li>
        <li><a href="{{ route('tasks.genre', 'その他') }}">その他</a></li>
    </ul>
</div>
