<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers;
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

 Route::group(['namespace'=>'App\Http\Controllers\User'],function (){
     Route::get('/users', 'IndexController');
     Route::post('/users', 'StoreController');
     Route::get('/users/{id}', 'ShowController');
     Route::get('/users/{id}/edit', 'EditController');
     Route::put('/users/{id}/update', 'UpdateController');
     Route::delete('/users/{id}/delete', 'DestroyController');
 });

Route::controller(AuthController::class)->group(function ()
{
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware'=> ['auth:sanctum']], function ()
{
    Route::post('/logout',[AuthController::class,'logout']);

});


//Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
//Route::post('/me', [AuthController::class, 'me']);
Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
Route::post('/reset-password',[AuthController::class,'ResetPassword'])->name('password.reset');




