<?php

namespace App\Http\Controllers;

use App\Interfaces\ITodoRepository;
use Illuminate\Http\{Request, Response};
use Illuminate\Validation\ValidationException;

class TodoController extends Controller
{
    public function __construct(private ITodoRepository $todoRepo) {
        // $todoRepo = new TodoRepository();
    }

    public function viewTodoCreate(Request $request) {
        return view('todo.create');
    }

    public function submitTodoCreate(Request $request) {
        $validated = $request->validate([
            'todoText' => 'required',
        ]);

        $validated['userId'] = $request->user()['id'];
        $todo = $this->todoRepo->create($validated);

        return redirect()->route('viewTodo', ['id' => $todo['id']]);
    }

    public function viewTodo(Request $request, int $id) {
        return view('todo.view', ['todo' => $this->todoRepo->get($id)]);
    }

    public function viewAllTodos(Request $request) {
        $page = intval($request->query('page', 1));
        $limit = intval($request->query('limit', 10));
        $search = $request->query('search', '');
        $sort = $request->query('sort', 'asc');

        $todoPaginator = $this->todoRepo->getAll($page, $limit, $search, $sort);

        $todoPaginator->withPath(url()->current())->withQueryString();

        return view('todo.viewAll', compact('todoPaginator'));
    }

    public function submitUpdateTodo(Request $request, int $id) {
        try {
            $validated = $request->validate([
                'todoText' => 'required',
            ]);
        } catch (ValidationException $ve) {
            return response($ve->validator->errors()->first(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $todo = $this->todoRepo->update($id, $validated);

        return response(htmlspecialchars($todo->todoText));
    }

    public function submitDeleteTodo(Request $request, int $id) {
        $this->todoRepo->delete($id);

        return response(status: Response::HTTP_NO_CONTENT);
    }

    public function submitRestoreTodo(Request $request, int $id) {
        $this->todoRepo->restore($id);

        return response(status: Response::HTTP_NO_CONTENT);
    }
}
