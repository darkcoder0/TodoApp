<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
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

Route::get('/',[TodoController::class,'TaskList'])->name('todo');
Route::post('/addtask',[TodoController::class,'AddTask'])->name('addtask');
Route::post('/delete/{id}',[TodoController::class,'DeleteTask'])->name('deletetask');
Route::get('/edit/{id}',[TodoController::class,'EditTask'])->name('edit');
Route::post('/update/{id}',[TodoController::class,'UpdateTask'])->name('update');
Route::get('/taskdone/{id}',[TodoController::class,'TaskDone'])->name('taskdone');
