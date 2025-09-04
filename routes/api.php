<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\BlogController;


Route::apiResource('categories', CategoryController::class);
Route::get('allblogs', [BlogController::class, 'index']);
Route::get('blogs/{slug}', [BlogController::class, 'show']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function($router){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::middleware(['auth:api'])->group(function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    
    //blogs
    Route::apiResource('blogs', BlogController::class);
    Route::get('yourblog/{id}', [BlogController::class, 'yourblog'] );
    Route::delete('deleteblog/{slug}', [BlogController::class, 'destroy']);
});