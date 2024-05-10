<?php

namespace App\Repositories;

use App\Interfaces\IUSerRepository;
use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUSerRepository
{
    public function getAllForExport()
    {
        return User::all();
    }

    public function addUsersFromCsv(Collection $collection)
    {
        $successfullyAdded = 0;
        foreach ($collection as $line) {
            try {
                $user = new User();
                foreach ($line as $k => $v) {
                    if ($k == 'password') {
                        $user[$k] = Hash::make($v);
                    } else {
                        $user[$k] = $v;
                    }
                }
                $user->save();
                $successfullyAdded += 1;
            } catch (Exception $e) {
                // silent here intentionally
            }
        }
        return $successfullyAdded;
    }
}
