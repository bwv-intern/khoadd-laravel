<?php

use App\Http\Controllers\{AuthController, TodoController};
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

Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
Route::post('/login', [AuthController::class, 'attemptLogin']);
Route::get('/register', [AuthController::class, 'viewRegister']);
Route::post('/register', [AuthController::class, 'attemptRegister']);
Route::any('/logout', [AuthController::class, 'logout']);

Route::get('/todos/new', [TodoController::class, 'viewTodoCreate'])->middleware('auth');
Route::post('/todos/new', [TodoController::class, 'createTodo'])->middleware('auth');
Route::get('/todos/{id}', [TodoController::class, 'viewTodo'])->name('viewTodo');
Route::get('/todos', [TodoController::class, 'viewAllTodos'])->name('viewAllTodos');
