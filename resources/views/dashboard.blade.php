@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="page-title">
            Dashboard
        </div>

        <div class="page-subtitle">
            Manage your tasks and stay organized.
        </div>
    </div>

    <a href="{{ route('tasks.create') }}" class="add-button">
        + Add Task
    </a>

</div>

<style>

    .stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: white;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #eee;
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-title {
        color: #777;
        font-size: 13px;
    }

    .stat-number {
        font-size: 30px;
        font-weight: bold;
        margin-top: 12px;
    }

    .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .orange {
        background: #ffe1d9;
        color: #e93f1a;
    }

    .purple {
        background: #bcc4f2;
        color: #30365a;
    }

    .green {
        background: #dcf5e6;
        color: #238447;
    }

    .red {
        background: #ffe0e0;
        color: #d63232;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .card {
        background: white;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 24px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .view-all {
        color: #e93f1a;
        font-size: 13px;
        font-weight: bold;
    }

    .task-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .task-item:last-child {
        border-bottom: none;
    }

    .task-name {
        font-weight: bold;
        font-size: 14px;
    }

    .task-date {
        color: #888;
        font-size: 12px;
        margin-top: 5px;
    }

    .badge {
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
    }

    .badge-pending {
        background: #fff0e9;
        color: #e93f1a;
    }

    .badge-completed {
        background: #e0f5e7;
        color: #24834a;
    }

    .progress-container {
        margin-top: 15px;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        background: #eee;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: #e93f1a;
        border-radius: 20px;
    }

    .progress-number {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .progress-text {
        color: #777;
        font-size: 13px;
        margin-bottom: 15px;
    }

    @media (max-width: 900px) {
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 550px) {
        .stats {
            grid-template-columns: 1fr;
        }

        .topbar {
            align-items: flex-start;
            gap: 15px;
            flex-direction: column;
        }
    }

</style>

<div class="stats">

    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-title">Total Tasks</div>
                <div class="stat-number">{{ $totalTasks }}</div>
            </div>

            <div class="stat-icon orange">
                ☷
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-title">Pending</div>
                <div class="stat-number">{{ $pendingTasks }}</div>
            </div>

            <div class="stat-icon purple">
                ◷
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-title">Completed</div>
                <div class="stat-number">{{ $completedTasks }}</div>
            </div>

            <div class="stat-icon green">
                ✓
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div>
                <div class="stat-title">Overdue</div>
                <div class="stat-number">{{ $overdueTasks }}</div>
            </div>

            <div class="stat-icon red">
                !
            </div>
        </div>
    </div>

</div>

<div class="dashboard-grid">

    <div class="card">

        <div class="card-header">

            <div class="card-title">
                Recent Tasks
            </div>

            <a href="{{ route('tasks.index') }}" class="view-all">
                View All
            </a>

        </div>

        @forelse($recentTasks as $task)

            <div class="task-item">

                <div>

                    <div class="task-name">
                        {{ $task->task_name }}
                    </div>

                    <div class="task-date">

                        @if($task->due_date)
                            Due {{ $task->due_date->format('M d, Y') }}
                        @else
                            No due date
                        @endif

                    </div>

                </div>

                <div>

                    @if($task->status === 'Completed')

                        <span class="badge badge-completed">
                            Completed
                        </span>

                    @else

                        <span class="badge badge-pending">
                            Pending
                        </span>

                    @endif

                </div>

            </div>

        @empty

            <p style="color:#888;">
                No tasks yet.
            </p>

        @endforelse

    </div>

    <div class="card">

        <div class="card-title">
            Task Progress
        </div>

        <div class="progress-container">

            <div class="progress-number">
                {{ $progress }}%
            </div>

            <div class="progress-text">
                Tasks completed
            </div>

            <div class="progress-bar">

                <div
                    class="progress-fill"
                    style="width: {{ $progress }}%;">
                </div>

            </div>

        </div>

    </div>

</div>

@endsection