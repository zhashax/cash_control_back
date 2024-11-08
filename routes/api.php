<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasicProductController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function () {

    
// });

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout']);

//Protected routes
// Route::group(['middleware'=>['auth:sanctum']], function () {
  
// });
Route::post('/product_create',[AdminController::class,'storeProduct']);

Route::middleware('auth:sanctum')->post('/upload-photo', [AuthController::class, 'uploadPhoto']);

Route::post('basic-products-prices', [BasicProductController::class, 'store']);
Route::post('sales', [BasicProductController::class, 'storeSales']);
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
   Route::get('/users', [UserController::class, 'index']);
   Route::post('/users', [UserController::class, 'store']);
   Route::put('/users/{user}', [UserController::class, 'update']);
   Route::delete('/users/{user}', [UserController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:client'])->group(function () {

});

Route::middleware(['auth:sanctum', 'role:cashbox'])->group(function () {

});

Route::middleware(['auth:sanctum', 'role:storage'])->group(function () {

});

Route::middleware(['auth:sanctum', 'role:courier'])->group(function () {

});

Route::middleware(['auth:sanctum', 'role:packer'])->group(function () {

});