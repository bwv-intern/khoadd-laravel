<?php

namespace App\Interfaces;

interface ITodoRepository {
    public function getAll(int $page = 1, int $limit = 10, string $search = '', string $sortOrder = 'asc');
    public function get(int $id);
    public function create(array $details);
    public function update(int $id, array $details);
    public function delete(int $id);
}