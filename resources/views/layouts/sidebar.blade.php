<!-- Sidebar -->
<aside class="sidebar">
    <h2>{{ optional(auth()->user())->name }} さんのTO&nbsp;DO&nbsp;リスト</h2>
    <button class="btn btn-template" onclick="location.href='{{ route('tasks.index') }}'">タスク一覧</button>
    <button class="btn btn-done" onclick="location.href='{{ route('tasks.doneList') }}'">完了タスク一覧</button>

    <h2>{{ optional(auth()->user())->name }} さんのジャンル</h2>
    <button class="btn btn-category btn-work">仕事</button>
    <button class="btn btn-category btn-study">勉強</button>
    <button class="btn btn-category btn-family">家族</button>

    <div class="sidebar">
        <h2>ジャンルで絞り込み</h2>
        @foreach ($kinds as $kind)
            <a href="{{ route('tasks.filterByKind', $kind->id) }}" class="btn btn-category"
                style="background-color: #{{ $kind->color_code }};">
                {{ $kind->name }}
            </a>
        @endforeach
    </div>


    <div class="settings"><i class="fa-solid fa-gear"></i>設定/テーマ変更</div>
</aside>
