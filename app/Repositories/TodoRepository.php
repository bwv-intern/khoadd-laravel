<?php

namespace App\Repositories;

use App\Interfaces\ITodoRepository;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class TodoRepository implements ITodoRepository
{
    public function getAll(int $page = 1, int $limit = 10, string $search = '', string $sortOrder = 'asc') {
        $todoPaginator = DB::table('todos')->where('todoText', 'like', "%{$search}%")->orderBy('id', $sortOrder)->paginate($limit, page: $page);
        return $todoPaginator;
    }

    public function get(int $id) {
        return Todo::findOrFail($id);
    }

    public function create(array $details) {
        return Todo::create($details);
    }

    public function update(int $id, array $details) {
        return Todo::findOrFail($id)->update($details);
    }

    public function delete(int $id) {
        Todo::destroy($id);
    }
}
