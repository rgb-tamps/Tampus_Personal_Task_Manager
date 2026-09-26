<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function dashboard()
    {
        $totalTasks = Task::count();

        $pendingTasks = Task::where('status', 'Pending')->count();

        $completedTasks = Task::where('status', 'Completed')->count();

        $overdueTasks = Task::where('status', 'Pending')
            ->whereDate('due_date', '<', now())
            ->count();

        $recentTasks = Task::latest()->take(5)->get();

        $progress = $totalTasks > 0
            ? round(($completedTasks / $totalTasks) * 100)
            : 0;

        return view('dashboard', compact(
            'totalTasks',
            'pendingTasks',
            'completedTasks',
            'overdueTasks',
            'recentTasks',
            'progress'
        ));
    }

    public function index()
    {
        $tasks = Task::latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added successfully.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,Completed',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => $task->status === 'Pending'
                ? 'Completed'
                : 'Pending'
        ]);

        return back();
    }
}