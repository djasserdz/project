<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::view("/","home")->name("home");

Route::middleware('guest')->group(function(){
    Route::match(['get','post'],'/register',[AuthController::class,'register'])->name("register");
    Route::match(['get','post'],'/login',[AuthController::class,'login'])->name("login");
});

Route::middleware("auth")->group(function(){
 Route::post("/logout",[AuthController::class,"logout"])->name("logout");
 Route::match(['get','post'],"/Task/Create",action: [TaskController::class,'create'])->name("task.create");
 Route::match(['get','post'],"/Task/{task}/,edit",action: [TaskController::class,'edit'])->name("task.edit");
 
 Route::get("/tasks",[TaskController::class,'index'])->name("task.index");
});

