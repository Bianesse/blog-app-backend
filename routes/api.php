<?php

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
Route::get('/post', [PostControllerApi::class,'index']);
Route::post('/post/insert', [PostControllerApi::class,'store']);
Route::post('/post/edit/{id}', [PostControllerApi::class,'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
