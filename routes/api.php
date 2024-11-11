<?php

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasicProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitMeasurementController;
use App\Http\Controllers\OrganizationController;


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
//admin routes
Route::post('/product_create',[AdminController::class,'storeProduct']);
Route::post('basic-products-prices', [BasicProductController::class, 'store']);
Route::get('/basic-products-prices', [BasicProductController::class, 'getAllProducts']);



Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{user}/assign-role', [UserController::class, 'assignRole']);


Route::post('/admin/offer-requests', [AdminController::class, 'createOfferRequest']);
Route::get('/admin/offer-requests', [AdminController::class, 'getOfferRequests']);
Route::get('/admin/offer-requests/{id}', [AdminController::class, 'getOfferRequest']);

// Warehouse Routes
Route::post('/warehouses', [AdminController::class, 'createWarehouse']);
Route::get('/warehouses', [AdminController::class, 'getAllWarehouses']);


Route::post('/admin/product-groups', [AdminController::class, 'addProductToWarehouse']);
Route::get('/warehouses/{id}/products', [AdminController::class, 'getProductsByWarehouse']);

//admin routes end

Route::middleware('auth:sanctum')->post('/upload-photo', [AuthController::class, 'uploadPhoto']);

Route::post('sales', [BasicProductController::class, 'storeSales']);
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
   Route::get('/users', [UserController::class, 'index']);
   Route::post('/users', [UserController::class, 'store']);
   Route::put('/users/{user}', [UserController::class, 'update']);
   Route::delete('/users/{user}', [UserController::class, 'destroy']);

   Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy']);

    // Unit Measurements Routes
    Route::get('/unit-measurements', [UnitMeasurementController::class, 'index']);
    Route::post('/unit-measurements', [UnitMeasurementController::class, 'store']);
    Route::put('/unit-measurements/{unit}', [UnitMeasurementController::class, 'update']);
    Route::delete('/unit-measurements/{unit}', [UnitMeasurementController::class, 'destroy']);

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



















Route::get('/users', [UserController::class, 'index']);
   Route::post('/users', [UserController::class, 'store']);
   Route::put('/users/{user}', [UserController::class, 'update']);
   Route::delete('/users/{user}', [UserController::class, 'destroy']);

   Route::get('/organizations', [OrganizationController::class, 'index']);
    Route::post('/organizations', [OrganizationController::class, 'store']);
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update']);
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy']);

    // Unit Measurements Routes
    Route::get('/unit-measurements', [UnitMeasurementController::class, 'index']);
    Route::post('/unit-measurements', [UnitMeasurementController::class, 'store']);
    Route::put('/unit-measurements/{unit}', [UnitMeasurementController::class, 'update']);
    Route::delete('/unit-measurements/{unit}', [UnitMeasurementController::class, 'destroy']);
