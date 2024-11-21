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
use App\Http\Controllers\ProductCardController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PriceRequestController;

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
   Route::group(['middleware' => ['auth:sanctum']], function () {
      
  });
    
// });

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/logout', [AuthController::class,'logout']);

//Protected routes
// Route::group(['middleware'=>['auth:sanctum']], function () {
  
// });
//admin routes
Route::post('/product_create',[AdminController::class,'storeProduct']);
   




Route::post('/admin/offer-requests', [AdminController::class, 'createOfferRequest']);
Route::get('/admin/offer-requests', [AdminController::class, 'getOfferRequests']);
Route::get('/admin/offer-requests/{id}', [AdminController::class, 'getOfferRequest']);

// Warehouse Routes
Route::post('/warehouses', [AdminController::class, 'createWarehouse']);
Route::get('/warehouses', [AdminController::class, 'getAllWarehouses']);


Route::post('/admin/product-groups', [AdminController::class, 'addProductToWarehouse']);
Route::get('/warehouses/{id}/products', [AdminController::class, 'getProductsByWarehouse']);

//admin routes end
// это чтобы всех ролей собрать
Route::middleware('auth:sanctum')->get('/user/roles', function () {
   return auth()->user()->roles->pluck('name');
});
// все роли собирать заканчивается ветка
Route::middleware('auth:sanctum')->post('/upload-photo', [AuthController::class, 'uploadPhoto']);


// страница администратора

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
   Route::post('product_card_create', [ProductCardController::class, 'store']);//создать карточку товара
   Route::get('/product_cards', [ProductCardController::class, 'getCardProducts']);

   Route::post('price_requests', [PriceRequestController::class, 'store']);


   Route::put('/users/{user}/assign-roles', [UserController::class, 'assignRoles']);
   Route::delete('/users/{user}/remove-role', [UserController::class, 'removeRole']);

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

    // создать адрес клиентов
    Route::get('/users/{userId}/addresses', [AddressController::class, 'index']); // List addresses
    Route::post('/users/{userId}/addresses', [AddressController::class, 'store']); // Add an address
    Route::put('/addresses/{addressId}', [AddressController::class, 'update']); // Update an address
    Route::delete('/addresses/{addressId}', [AddressController::class, 'destroy']); // Delete an address
    // создать адрес клиентов

});
// страница администратора

Route::middleware(['auth:sanctum', 'client'])->group(function () {
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
