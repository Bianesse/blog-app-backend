<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'webShow'])->name('home');

Route::get('/post', [PostController::class, 'webShow'])->name('webShow');
Route::post('/post/insert', [PostController::class,'create'])->name('insert');
Route::get('/post/delete/{id}', [PostController::class,'destroy'])->name('delete');
Route::get('/post/edit/{id}', [PostController::class,'edit'])->name('edit');
Route::post('/post/update', [PostController::class,'update'])->name('update');

