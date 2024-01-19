<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login',[\App\Http\Controllers\Api\AuthController::class,'login'])->name('login');

Route::middleware('auth:sanctum')->group(function (){

    Route::resource('books',\App\Http\Controllers\Api\BookController::class)->only([
        'store',
        'index',
        'show',
        'update',
        'destroy'
    ]);
});

