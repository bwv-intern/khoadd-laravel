<?php

namespace App\Http\Controllers;

use App\Interfaces\ITodoRepository;
use App\Models\Todo;
use App\Repositories\TodoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{

    function __construct(private ITodoRepository $todoRepo)
    {
        // $todoRepo = new TodoRepository();
    }

    public function viewTodoCreate(Request $request)
    {
        return view('todo.create');
    }

    public function createTodo(Request $request)
    {
        $validated = $request->validate([
            'todoText' => 'required',
        ]);

        $validated['userId'] = $request->user()['id'];
        $todo = $this->todoRepo->create($validated);

        return redirect()->route('viewTodo', ['id' => $todo['id']]);
    }

    public function viewTodo(Request $request, int $id)
    {
        return view('todo.view', ['todo' => $this->todoRepo->get($id)]);
    }

    public function viewAllTodos(Request $request)
    {
        $page = intval($request->query('page', 1));
        $limit = intval($request->query('limit', 10));
        $search = $request->query('search', '');
        $sort = $request->query('sort', 'asc');

        $todoPaginator = $this->todoRepo->getAll($page, $limit, $search, $sort);

        $todoPaginator->withPath(url()->current())->withQueryString();

        return view('todo.viewAll', compact('todoPaginator'));
    }
}
