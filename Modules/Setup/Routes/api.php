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


    // Store/Warehouse 
    Route::apiResource('store', StoreController::class);


    // Varient 
    Route::apiResource('varient', VarientController::class);
        // varient value
    Route::get('varient_value/{id}',[VarientController::class, 'getVarientValue']);
    Route::post('varient_value',[VarientController::class, 'storeVarientValue']);
    Route::put('varient_value/{id}',[VarientController::class, 'updateVarientValue']);
    Route::delete('varient_value/{id}',[VarientController::class, 'deleteVarientValue']);



    // Customer Group
    Route::apiResource('customer_group', CustomerGroupController::class);

    

});




