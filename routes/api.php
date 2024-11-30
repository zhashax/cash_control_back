<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnitMeasurementController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProductCardController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PriceRequestController;
use App\Http\Controllers\SubCardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StorageController;

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class,'logout']);




Route::post('/admin/offer-requests', [AdminController::class, 'createOfferRequest']);
Route::get('/admin/offer-requests', [AdminController::class, 'getOfferRequests']);
Route::get('/admin/offer-requests/{id}', [AdminController::class, 'getOfferRequest']);


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
   Route::post('price_bulkStore', [PriceRequestController::class, 'bulkStore']);

   
   //оприходование товаров
   Route::post('/admin_warehouses', [AdminController::class, 'createWarehouse']);
   Route::post('/receivingBulkStore', [AdminController::class, 'receivingBulkStore']);
   //оприходование товаров
   // Warehouse Routes
   Route::get('/admin_warehouses', [AdminController::class, 'getAllWarehouses']);


   Route::post('/admin/product-groups', [AdminController::class, 'addProductToWarehouse']);
   Route::get('/warehouses/{id}/products', [AdminController::class, 'getProductsByWarehouse']);

//admin routes end
   
   //подкарточки
   Route::post('/product_subcards', [SubCardController::class, 'store']); //подкарточки
   Route::get('/product_subcards', [SubCardController::class, 'getSubCards']); 
   //подкарточки

   //создать поставщика
   Route::get('providers',[AdminController::class,'getProviders']);
   Route::post('create_providers', [AdminController::class,'storeProvider']);
   // Route::put('update_providers', [AdminController::class,'updateProvider']);
   // Route::delete('delete_providers', [AdminController::class,'deleteProvider']);
   //создать поставщика

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
    Route::post('unit-measurements', [UnitMeasurementController::class, 'store']);
    Route::put('/unit-measurements/{unit}', [UnitMeasurementController::class, 'update']);
    Route::delete('/unit-measurements/{unit}', [UnitMeasurementController::class, 'destroy']);

    // создать адрес клиентов
    Route::get('/users/{userId}/addresses', [AddressController::class, 'index']); // List addresses
    Route::post('/users/{userId}/addresses', [AddressController::class, 'store']); // Add an address
    Route::put('/addresses/{addressId}', [AddressController::class, 'update']); // Update an address
    Route::delete('/addresses/{addressId}', [AddressController::class, 'destroy']); // Delete an address
    // создать адрес клиентов

   //  создать продажу
   // 
   // Route::post('sales', [SalesController::class, 'store']);
   Route::post('bulk_sales', [SalesController::class, 'bulkStore']);

   // создать продажу
   
   // Инвентаризация склада
   Route::get('client-users', [AdminController::class, 'getClientUsers']);
   Route::get('/operations-history', [AdminController::class, 'fetchOperationsHistory']);

   Route::get('getStorageUsers',[StorageController::class,'getStorageUsers']);
   Route::post('bulkStoreInventory',[StorageController::class,'bulkStoreInventory']);
   Route::get('getInventory',[StorageController::class,'getInventory']);

   

});
Route::middleware(['auth:sanctum', 'role:admin,client'])->group(function () {
   Route::get('sales', [SalesController::class, 'index']);
   Route::get('/product_subcards', [SubCardController::class, 'getSubCards']);
   Route::get('/product_cards', [ProductCardController::class, 'getCardProducts']);
});

Route::middleware(['auth:sanctum', 'client'])->group(function () {
     // Route::get('sales', [SalesController::class, 'index']);

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

  