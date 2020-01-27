<?php

namespace App\Http\Controllers;

use App\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    public function index(Request $request)
    {
        $todos = $request->user()->todos()->latest()->get();
        return view('todos', ['todos' => $todos]);
    }

    public function toggle(TodoItem $todo, Request $request)
    {
        if($request->user()->id !== $todo->user_id) return abort(403);
        $todo->toggle();
        $todo->save();
        return redirect()->route('todos.all');
    }

    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|min:3|max:250'
        ]);

        $todo = new TodoItem;
        $todo->user_id = $request->user()->id;
        $todo->text = $request->todo;
        $todo->save();
        return redirect()->route('todos.all');
    }
}
