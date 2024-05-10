<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface IUSerRepository
{
    public function getAllForExport();
    public function addUsersFromCsv(Collection $collection);
}
