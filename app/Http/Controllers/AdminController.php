<?php

namespace App\Http\Controllers;

use App\Interfaces\IUSerRepository;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class AdminController extends Controller
{
    public function __construct(private IUSerRepository $userRepo)
    {
    }

    public function viewAdmin(Request $request) {
        return view('admin.index');
    }

    public function exportUsers(Request $request) {
        $allUsers = $this->userRepo->getAllForExport();
        return (new FastExcel($allUsers))->download('users.csv');
    }

    public function importUsers(Request $request) {
        $request->validate([
            'csvToUpload' => ['file', 'extensions:csv', 'max:51200'],
        ]);

        $csv = $request->file('csvToUpload');

        $filePath = $csv->path();
        $newFilePath =  $filePath . '.' . $request->file('csvToUpload')->getClientOriginalExtension();
        move_uploaded_file($filePath, $newFilePath);

        $csvCollection = (new FastExcel())->import($newFilePath);
        $numAddedUsers = $this->userRepo->addUsersFromCsv($csvCollection);

        return view('admin.index', compact(['numAddedUsers']));
    }
}
