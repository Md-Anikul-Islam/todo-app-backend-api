<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentication Routes
Route::post('/registration',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){

    //Task Routes
    Route::get('/tasks',[TaskController::class,'index']);
    Route::post('/task-store',[TaskController::class,'store']);
    Route::post('/task-update/{id}',[TaskController::class,'update']);
    Route::delete('/task-delete/{id}',[TaskController::class,'destroy']);

    //Logout Route
    Route::post('/logout',[AuthController::class,'logout']);
});
