<!-- Sidebar -->
<aside class="sidebar">
    <h2>John&nbsp;Doe のTO&nbsp;DO&nbsp;リスト</h2>
    <button class="btn btn-template" onclick="location.href='{{ route('tasks.index') }}'">タスク一覧</button>
    <button class="btn btn-done" onclick="location.href='{{ route('tasks.doneList') }}'">完了タスク一覧</button>

    <h2>John&nbsp;Doe の作成ジャンル</h2>
    <button class="btn btn-category btn-work">仕事</button>
    <button class="btn btn-category btn-study">勉強</button>
    <button class="btn btn-category btn-family">家族</button>

    <div class="settings"><i class="fa-solid fa-gear"></i>設定/テーマ変更</div>
</aside>
