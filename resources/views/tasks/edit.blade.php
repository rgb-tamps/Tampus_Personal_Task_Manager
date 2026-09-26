@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="page-title">
            Edit Task
        </div>

        <div class="page-subtitle">
            Update your task information.
        </div>
    </div>

</div>

<style>

    .form-card {
        background: white;
        border: 1px solid #eee;
        border-radius: 14px;
        padding: 30px;
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 9px;
        font-family: inherit;
        font-size: 14px;
        outline: none;
    }

    input:focus,
    textarea:focus,
    select:focus {
        border-color: #e93f1a;
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .save-button {
        background: #e93f1a;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 9px;
        font-weight: bold;
        cursor: pointer;
    }

    .cancel-button {
        background: #bcc4f2;
        color: #222;
        padding: 12px 20px;
        border-radius: 9px;
        font-weight: bold;
        margin-left: 8px;
    }

</style>

<div class="form-card">

    <form method="POST" action="{{ route('tasks.update', $task) }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label>
                Task Name
            </label>

            <input
                type="text"
                name="task_name"
                value="{{ old('task_name', $task->task_name) }}"
                required
            >

        </div>

        <div class="form-group">

            <label>
                Description
            </label>

            <textarea
                name="description"
            >{{ old('description', $task->description) }}</textarea>

        </div>

        <div class="form-group">

            <label>
                Status
            </label>

            <select name="status">

                <option
                    value="Pending"
                    {{ $task->status === 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option
                    value="Completed"
                    {{ $task->status === 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

        </div>

        <div class="form-group">

            <label>
                Due Date
            </label>

            <input
                type="date"
                name="due_date"
                value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
            >

        </div>

        <button type="submit" class="save-button">
            Update Task
        </button>

        <a href="{{ route('tasks.index') }}" class="cancel-button">
            Cancel
        </a>

    </form>

</div>

@endsection