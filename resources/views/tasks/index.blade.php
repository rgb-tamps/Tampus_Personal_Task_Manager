@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="page-title">
            Tasks
        </div>

        <div class="page-subtitle">
            View and manage all your tasks.
        </div>
    </div>

    <a href="{{ route('tasks.create') }}" class="add-button">
        + Add Task
    </a>

</div>

<style>

    .task-card {
        background: white;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 15px;
    }

    .task-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        align-items: center;
    }

    .task-title {
        font-size: 17px;
        font-weight: bold;
    }

    .description {
        color: #777;
        font-size: 13px;
        margin-top: 7px;
    }

    .due-date {
        color: #888;
        font-size: 12px;
        margin-top: 8px;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .btn {
        border: none;
        padding: 9px 13px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: bold;
    }

    .btn-edit {
        background: #bcc4f2;
        color: #252525;
    }

    .btn-delete {
        background: #ffe0e0;
        color: #d63232;
    }

    .btn-status {
        background: #e93f1a;
        color: white;
    }

    .badge {
        display: inline-block;
        margin-top: 10px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .pending {
        background: #fff0e9;
        color: #e93f1a;
    }

    .completed {
        background: #e0f5e7;
        color: #24834a;
    }

</style>

@if(session('success'))

    <div style="
        background:#e0f5e7;
        color:#24834a;
        padding:14px;
        border-radius:10px;
        margin-bottom:20px;
    ">
        {{ session('success') }}
    </div>

@endif

@forelse($tasks as $task)

    <div class="task-card">

        <div class="task-row">

            <div>

                <div class="task-title">
                    {{ $task->task_name }}
                </div>

                <div class="description">
                    {{ $task->description ?: 'No description' }}
                </div>

                <div class="due-date">

                    @if($task->due_date)
                        Due: {{ $task->due_date->format('M d, Y') }}
                    @else
                        No due date
                    @endif

                </div>

                @if($task->status === 'Completed')

                    <span class="badge completed">
                        Completed
                    </span>

                @else

                    <span class="badge pending">
                        Pending
                    </span>

                @endif

            </div>

            <div class="actions">

                <form method="POST"
                      action="{{ route('tasks.status', $task) }}">

                    @csrf
                    @method('PATCH')

                    <button class="btn btn-status">
                        {{ $task->status === 'Pending' ? 'Complete' : 'Pending' }}
                    </button>

                </form>

                <a
                    href="{{ route('tasks.edit', $task) }}"
                    class="btn btn-edit">
                    Edit
                </a>

                <form
                    method="POST"
                    action="{{ route('tasks.destroy', $task) }}"
                    onsubmit="return confirm('Delete this task?');">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-delete">
                        Delete
                    </button>

                </form>

            </div>

        </div>

    </div>

@empty

    <div class="task-card">
        <p style="color:#777;">
            No tasks found.
        </p>
    </div>

@endforelse

@endsection