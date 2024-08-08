<?php

use App\Http\Controllers\LoginController;
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


Route::view('/login', 'Login.login')->name('login');
Route::post('/login/check', [LoginController::class, 'login'])->name('checkLogin');

Route::middleware("auth.web")->group(function () {
    Route::get('/', [PostController::class, 'webShow'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('/comment/insert/{id}', [PostController::class, 'commentInsert'])->name('commentInsert');

    Route::prefix('post')->group(function () {
        Route::get('/{id}', [PostController::class, 'showComment'])->name('detailPost');
        Route::get('/', [PostController::class, 'webShow'])->name('webShow');
        Route::post('/insert', [PostController::class, 'create'])->name('insert');
        Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/update', [PostController::class, 'update'])->name('update');
    });
});

Route::middleware('auth.web')->get('/user', function () {
    return auth()->user();
})->name('user');
