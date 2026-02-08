<?php

use App\Http\Middleware\TokenMiddleware;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
require __DIR__."/task.php";

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(TokenMiddleware::class);


Route::get('/health',function(){
    return response()->json([
        "status"=>true,
        "message"=>"server is running",
        "time"=>Carbon::now()
    ]);
});