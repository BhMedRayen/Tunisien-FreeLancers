<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\auth\ForgotPassword;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SkillsController;
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
    Route::post('/user_update/{id}',[UserController::class,'updateUser']);
});


Route::group(["prefix"=>"/auth"],function(){
    Route::post("/register",[AuthController::class,'Register']);
    Route::post("/login",[LoginController::class,'Login']);
    Route::post("/verify/{email}",[EmailController::class,"VerifyEmail"]);
    Route::post("/RenvoyerEmail/{email}",[EmailController::class,"RenvoyerEmail"]);
    Route::post("/forgotPasswordToken/{email}",[ForgotPassword::class,"forgotPasswordToken"]);
    Route::post("/VerifyToken",[ForgotPassword::class,"VerifyToken"]);
    Route::post("/ChangerPassword",[ForgotPassword::class,"ChangerPassword"]);
});

Route::group(["prefix"=>"/post"],function(){
    Route::post("/AddPOST",[PostController::class,'addPost']);
    Route::get("/getPosts",[PostController::class,'getPosts']);
    Route::put("/updatepost",[PostController::class,'updatePost']);
    Route::delete("/deletPost/{id}",[PostController::class,'deletepost']);
    Route::get("/getPostsUser/{id}",[PostController::class,'getPostsUser']);
    Route::get("/getComments/{id}",[PostController::class,'getComments']);
    Route::post("/ajouterComment",[PostController::class,'ajouterComment']);
});

Route::group(["prefix"=>"/notif"],function(){
    Route::get("/getNotification/{id}",[NotifController::class,'getNotification']);
    Route::delete("/DeleteNotif/{id}",[NotifController::class,'DeleteNotif']);
});

Route::group(["prefix"=>"/skill"],function(){
    Route::post("/AddSkill",[SkillsController::class,'AddSkill']);
    Route::delete("/DeleteSkill/{id}",[SkillsController::class,'DeleteSkill']);
    Route::put("/UpdateService/{id}",[SkillsController::class,'UpdateService']);
    Route::get("/getSkills/{id}",[SkillsController::class,'getSkill']);
});
