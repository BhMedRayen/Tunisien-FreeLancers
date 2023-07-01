<?php

use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'/user'],function(){
Route::get('/users',[UserController::class,'getAllUsers']);
Route::get('/user/{id}',[UserController::class,'getUser']);
Route::delete('/user_delete/{id}',[UserController::class,'deleteUser']);
Route::post('/user_insert',[UserController::class,'addUser']);
Route::put('/user_update/{id}',[UserController::class,'updateUser']);
});
