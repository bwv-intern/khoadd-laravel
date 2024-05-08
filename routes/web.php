<?php

use App\Http\Controllers\{AuthController, TodoController, ValidatorController};
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

Route::view('/home', 'home')->name('home');

Route::get('/login', [AuthController::class, 'viewLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'submitLogin'])->middleware('guest');
Route::get('/register', [AuthController::class, 'viewRegister'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'submitRegister'])->middleware('guest');
Route::any('/logout', [AuthController::class, 'submitLogout'])->middleware('auth')->name('logout');
Route::any('/profile', [AuthController::class, 'viewProfile'])->middleware('auth')->name('profile');

Route::get('/todos/new', [TodoController::class, 'viewTodoCreate'])->middleware('auth')->name('createTodo');
Route::post('/todos/new', [TodoController::class, 'submitTodoCreate'])->middleware('auth');
Route::get('/todos/{id}', [TodoController::class, 'viewTodo'])->name('viewTodo');
Route::get('/todos', [TodoController::class, 'viewAllTodos'])->name('viewAllTodos');
Route::put('/todos/{id}', [TodoController::class, 'submitUpdateTodo'])->name('updateTodo');
Route::delete('/todos/{id}', [TodoController::class, 'submitDeleteTodo'])->name('deleteTodo');
Route::post('/todos/restore/{id}', [TodoController::class, 'submitRestoreTodo'])->name('restoreTodo');

Route::view('/validator', 'validator')->name('validator');
Route::post('/validatorCheck', [ValidatorController::class, 'submitForm'])->name('validatorSubmit');
