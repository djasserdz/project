<?php

use App\Http\Controllers\TaskController;
use App\Http\Middleware\TokenMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/task/{id}',[TaskController::class,'search'])->middleware(TokenMiddleware::class);
Route::post('/task',[TaskController::class,'create'])->middleware(TokenMiddleware::class);
Route::get('/userTasks',[TaskController::class,'user_tasks'])->middleware(TokenMiddleware::class);