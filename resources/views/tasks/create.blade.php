@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="page-title">
            Add Task
        </div>

        <div class="page-subtitle">
            Create a new task.
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

    .error {
        color: #d63232;
        font-size: 12px;
        margin-top: 5px;
    }

</style>

<div class="form-card">

    <form method="POST" action="{{ route('tasks.store') }}">

        @csrf

        <div class="form-group">

            <label>
                Task Name
            </label>

            <input
                type="text"
                name="task_name"
                value="{{ old('task_name') }}"
                placeholder="Enter task name"
                required
            >

            @error('task_name')
                <div class="error">{{ $message }}</div>
            @enderror

        </div>

        <div class="form-group">

            <label>
                Description
            </label>

            <textarea
                name="description"
                placeholder="Describe your task..."
            >{{ old('description') }}</textarea>

        </div>

        <div class="form-group">

            <label>
                Status
            </label>

            <select name="status">

                <option value="Pending">
                    Pending
                </option>

                <option value="Completed">
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
                value="{{ old('due_date') }}"
            >

        </div>

        <button type="submit" class="save-button">
            Save Task
        </button>

        <a href="{{ route('tasks.index') }}" class="cancel-button">
            Cancel
        </a>

    </form>

</div>

@endsection