


{{-- resources/views/todo/index.blade.php --}}

@extends('layouts.app')

@section('title', 'TO DO LIST')


@section('content')

    <div class="wrapper">


        <!-- Main Content Area -->
        <main class="content">
            <ul class="tasks">
                @forelse ($tasks_done as $task)
                    <li style="background-color: {{ $task->kind->color_code }}">
                        {{ $task->title }}（期限：{{ $task->time }}）
                        <form method="POST" action="{{ route('tasks.undo', $task->id) }}" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">未完</button>
                        </form>

                        <a href="{{ route('tasks.edit', $task->id) }}">
                            <i class="fa-solid fa-pen-to-square btn btn-warning"></i>
                        </a>

                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" onclick="return confirm('本当に削除しますか？')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </li>
                @empty
                    <li>完了のタスクはありません。</li>
                @endforelse

            </ul>
        </main>
    </div>
    <a href="{{ route('tasks.create') }}" class="fab"><i class="fa-solid fa-plus"></i></a>
@endsection
