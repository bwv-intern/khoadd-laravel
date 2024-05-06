<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'home');

Route::get('/login', [AuthController::class, 'viewLogin']);
Route::post('/login', [AuthController::class, 'attemptLogin']);
Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/register', [AuthController::class, 'attemptRegister']);
Route::any('/logout', [AuthController::class, 'logout']);
