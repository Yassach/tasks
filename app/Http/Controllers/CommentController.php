<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form before storing the comment
        Comment::create([
            'user_id' => Auth::id(),
            'task_id' => $request->task_id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('tasks.show', ['task' => $request->task_id]);
    }
}
