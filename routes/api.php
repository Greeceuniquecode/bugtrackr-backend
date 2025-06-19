<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BugsController;
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
Route::put('/edit-project/{id}',[ProjectController::class,'editProject']);
Route::get('/get-projects',[ProjectController::class, 'getAllProjects']);
Route::delete('/delete-project',[ProjectController::class,'deleteProject']);


//bugs routes 
Route::post("/register-bug",[BugsController::class,'createBug']);
Route::put("/edit-bug/{id}",[BugsController::class,'editBug']);
Route::post("/get-bug",[BugsController::class,'getBug']);
Route::get("/get-all-bugs/{id}",[BugsController::class,'getAllBugs']);
Route::post('/submit-bug/{id}', [BugsController::class,'submitBug']);
Route::get('/reject-bug/{id}', [BugsController::class,'rejectBug']);


