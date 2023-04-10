<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category;
use App\Http\Controllers\Dish;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function ()
{
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

});


Route::group(['middleware'=> ['auth:sanctum']], function ()
{

    Route::post('/logout',[AuthController::class,'logout']);


    Route::group(['namespace'=>'App\Http\Controllers\User'],function (){

        Route::get('/users', 'IndexController');
        Route::post('/users', 'StoreController');
        Route::get('/users/{id}', 'ShowController');
        Route::get('/users/{id}/edit', 'EditController');
        Route::put('/users/{id}/update', 'UpdateController');
        Route::delete('/users/{id}/delete', 'DestroyController');

    });



    Route::group(['namespace'=>'App\Http\Controllers\Category'],function (){
        Route::get('/categories','IndexController');
        Route::post('/categories', 'StoreController');
        Route::get('/categories/{id}', 'ShowController');
        Route::get('/categories/{id}/edit', 'EditController');
        Route::put('/categories/{id}/update', 'UpdateController');
        Route::delete('/categories/{id}/delete', 'DestroyController');
    });


    Route::group(['namespace'=>'App\Http\Controllers\Dish'],function (){
        Route::get('/dishes','IndexController');
        Route::post('/dishes', 'StoreController');
        Route::get('/dishes/{id}', 'ShowController');
        Route::get('/dishes/{id}/edit', 'EditController');
        Route::put('/dishes/{id}/update', 'UpdateController');
        Route::delete('/dishes/{id}/delete', 'DestroyController');
    });
});



Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
//Route::post('/reset-password',[AuthController::class,'ResetPassword'])->name('password.reset');




