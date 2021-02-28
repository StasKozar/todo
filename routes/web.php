<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoTaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard', [TodoListController::class, 'index'])->name('dashboard');

    Route::get('/todo-list', [TodoListController::class, 'add']);
    Route::post('/todo-list', [TodoListController::class, 'create']);

    Route::get('/todo-list/{todoList}', [TodoListController::class, 'edit']);
    Route::post('/todo-list/{todoList}', [TodoListController::class, 'update']);

    Route::get('/todo-list/{todoList}/task', [TodoTaskController::class, 'add']);
    Route::post('/todo-list/{todoList}/task', [TodoTaskController::class, 'create']);
    Route::post('/todo-list/{todoList}/task/{task}', [TodoTaskController::class, 'update']);
});
