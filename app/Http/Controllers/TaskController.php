<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function index()
    {
        if (Gate::allows('admin')) {

            // We can use pagination
            $tasks = Task::where('status', '!=', 'closed')->get();

            return view('task.list', compact('tasks'));
        }
        return redirect()->route('dashboard')->with('task-not-allowed', 'Not allowed');
    }

    public function create()
    {
        if (Gate::allows('customer')) {
            return view('task.create');
        }
        return redirect()->route('dashboard')->with('task-not-allowed', 'Not allowed');
    }

    public function store(TaskRequest $request)
    {
        try {
            Task::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'type' => $request->type,
                'status' => 'pending',
                'priority' => $request->priority,
                'description' => $request->description,
                'context' => $request->context,
                'url' => $request->url,
            ]);
        } catch (\Exception $e) {
            // Do something
            dd($e->getMessage());
        }

        // Maybe send a notification to admin
        return redirect()->route('tasks.create')->with('success', 'Task created');
    }

    public function show($task)
    {
        if (Gate::allows('admin')) {

            $task = Task::whereId($task)->with('comments')->first();

            return view('task.show', compact('task'));
        }
        return redirect()->route('dashboard')->with('task-not-allowed', 'Not allowed');
    }
}
