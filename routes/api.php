<?php

use App\Http\Controllers\LoginControllerApi;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware("auth.login")->group(function () {
    Route::get('/post', [PostControllerApi::class,'index']);
    Route::get('/post/{id}', [PostControllerApi::class,'detail']);
    Route::post('/post/insert', [PostControllerApi::class,'store']);
    Route::put('/post/edit/{id}', [PostControllerApi::class,'update']);
    Route::delete('/post/delete/{id}', [PostControllerApi::class,'destroy']);
    Route::post('/post/insert', [PostControllerApi::class,'store']);
    Route::post('/comment/insert/{id}', [PostControllerApi::class,'commentInsert']);
});


Route::post('/login',[LoginControllerApi::class, 'index']);
Route::post('/registration',[LoginControllerApi::class, 'regis']);
Route::post('/logout',[LoginControllerApi::class, 'logout']);

Route::middleware('auth.login')->get('/user', function () {
    return auth()->user();
});
