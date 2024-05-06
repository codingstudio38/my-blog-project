<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login',[AuthController::class,'Login'])->name('login');
Route::post('register',[AuthController::class,'Register'])->name('register'); 
// auth:api,jwt.auth
Route::group(['middleware'=>'MyJWTMiddleware','prefix' => 'auth'],function($route){
Route::post('refresh',[AuthController::class,'refresh'])->name('refresh');  
Route::get('profile',[AuthController::class,'Profile'])->name('profile');
Route::post('logout',[AuthController::class,'Logout'])->name('logout');
});