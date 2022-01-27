<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JwtController;
use App\Http\Controllers\CategoryController;

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



Route::group(['middleware'=>['api']], function ($router) {
    Route::post('logout',[JwtController::class,'logout']);
    Route::post('refresh',[JwtController::class,'refresh']);
    Route::get('profile',[JwtController::class,'profile']);
    Route::post('changePassword',[JwtController::class,'changePassword']);
    Route::get('myorders',[JwtController::class,'MyOrder']);
   
       
});

Route::post('login',[JwtController::class,'login']);
Route::post('register',[JwtController::class,'register']);
Route::post('contactus',[JwtController::class,'contactus']);
Route::get('category',[JwtController::class,'category']);
Route::get('category/{id}',[JwtController::class,'show']);
Route::get('banner',[JwtController::class,'banner']);
Route::get('product',[JwtController::class,'product']);
Route::post('checkout',[JwtController::class,'checkout']);
Route::get('services',[JwtController::class,'CMSDetails']);
Route::get('coupons',[JwtController::class,'Coupons']);
  



    