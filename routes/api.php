<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
//Auth Routes
Route::post("/register",[AuthController::class,'register']);
Route::get("/get-user",[AuthController::class,'getuser']);
Route::post("/login",[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/get-auth-user',[AuthController::class,'getAuthUser']);
Route::post('/edit-user',[AuthController::class,'editUser']);


//project Routes 
Route::post("/create-project",[ProjectController::class,'createProject']);
Route::post('/edit-project',[ProjectController::class,'editProject']);

