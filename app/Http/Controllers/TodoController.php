<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function viewTodoCreate(Request $request) {
        return view('todo.create');
    }

    public function createTodo(Request $request) {
        $validation = Validator::make($request->all(), [
            'todoText' => 'required',
        ]);

        // validator error here later

        $validated = $validation->validated();
        $validated['userId'] = $request->user()['id'];
        $todo = Todo::create($validated);

        return redirect()->route('todo', ['todo' => $todo['id']]);
    }

    public function viewTodo(Request $request, Todo $todo) {
        return view('todo.view', ['todo' => $todo]);
    }
}
