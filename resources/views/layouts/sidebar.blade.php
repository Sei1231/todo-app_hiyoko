<!-- Sidebar -->
    <div class="sidebar">

        <h1>{{ optional(auth()->user())->name }} さんのTO&nbsp;DO&nbsp;リスト</h1>
        <button class="btn btn-template" onclick="location.href='{{ route('tasks.index') }}'">タスク一覧</button>
        <button class="btn btn-done" onclick="location.href='{{ route('tasks.doneList') }}'">完了タスク一覧</button>

        <h2>ジャンルで絞り込み</h2>
        @foreach ($kinds as $kind)
            <a href="{{ route('tasks.filterByKind', $kind->id) }}" class="btn btn-category"
                style="background-color: {{ $kind->color_code }};">
                {{ $kind->name }}
            </a>
        @endforeach

        <div class="settings"><i class="fa-solid fa-gear"></i>設定/テーマ変更</div>
    </div>
</aside>
