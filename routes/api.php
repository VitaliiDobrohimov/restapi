<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category;
use App\Http\Controllers\Dish;
use App\Http\Controllers\Order\AddDishController;


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

    Route::group(['namespace'=>'App\Http\Controllers\Order'],function (){
        Route::get('/orders','IndexController');
        Route::post('/orders', 'StoreController');
        Route::get('/orders/{id}', 'ShowController');
        Route::get('/orders/{id}/edit', 'EditController');
        Route::put('/orders/{id}/update', 'UpdateController');
        Route::delete('/orders/{id}/delete', 'DestroyController');
        Route::post('/orders/{dish_id}/{order_id}', 'AddDishController');
        Route::delete('/orders/{dish_id}/{order_id}/delete', 'DelDishController');
        Route::put('/orders/{id}/close', 'CloseController');


    });
    Route::group(['namespace'=>'App\Http\Controllers\Reports'],function () {
        Route::get('/reports/{id}', 'ShowController');
    });

});

Route::post('/forgot-password',[AuthController::class,'forgotPassword']);
//Route::post('/reset-password',[AuthController::class,'ResetPassword'])->name('password.reset');




