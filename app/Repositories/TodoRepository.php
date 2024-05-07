<?php

namespace App\Repositories;

use App\Interfaces\ITodoRepository;
use App\Models\Todo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class TodoRepository implements ITodoRepository
{
    public function getAll(int $page = 1, int $limit = 10, string $search = '', string $sortOrder = 'asc')
    {
        $todoPaginator = Todo::where('todoText', 'like', "%{$search}%")->orderBy('id', $sortOrder)->paginate($limit, page: $page);
        return $todoPaginator;
    }

    public function get(int $id)
    {
        $todo = Todo::withTrashed()->findOrFail($id);
        if ($todo->trashed()) {
            if (Auth::check() && Auth::user()->id == $todo->userId)
            {
                return $todo;
            }
            else
            {
                throw new ModelNotFoundException();
            }
        }
        return $todo;
    }

    public function create(array $details)
    {
        return Todo::create($details);
    }

    public function update(int $id, array $details)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($details);
        return $todo;
    }

    public function delete(int $id)
    {
        Todo::findOrFail($id)->delete();
    }

    public function restore(int $id)
    {
        Todo::onlyTrashed()->findOrFail($id)->restore();
    }
}
