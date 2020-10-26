<?php

use Illuminate\Http\Request;

// use Modules\Setup\Http\Controllers\Api\CategoryController;

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

Route::middleware('auth:api')->get('/setup', function (Request $request) {
    return $request->user();
});


Route::namespace('Api')->group(function(){

    // Category
    Route::apiResource('category', CategoryController::class);


    // Brand
    Route::apiResource('barnd', BrandController::class);


    // Unit
    Route::apiResource('unit', UnitController::class);


    // Tax
    Route::apiResource('tax', TaxController::class);


    // Warehouse
    Route::apiResource('warehouse', WarehouseController::class);

});




