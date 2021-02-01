<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'customer'], function() {
    Route::get("supplier",[supplierController::class,'suppliers']);
    Route::get("purchaser",[supplierController::class,'purchasers']);
    Route::view("add","customer/add");
    Route::post("add",[supplierController::class,'add']);
    Route::get("edit/{id}",[supplierController::class,'edit']);
    Route::post("update",[supplierController::class,'update']); 
    Route::get("delete/{id}",[supplierController::class,'delete']);
    
});





// Route::view("order","order");

Route::group(['prefix' => 'stock'], function() {
    Route::get('/create', [InventoryController::class,'create']);
    Route::get('edit/{id}', [InventoryController::class,'edit']);
    Route::post("store",[InventoryController::class,'store']);
    Route::get("inventory",[InventoryController::class,'index']);
    Route::post("update",[InventoryController::class,'update']);
    Route::get("delete/{id}",[InventoryController::class,'destroy']);
});


Route::group(['prefix' => 'item'], function() {

        Route::get("items",[ItemController::class,'index']);
        Route::view("add","item/store");
        Route::post("add",[ItemController::class,'store']);
        Route::get("edit/{id}",[ItemController::class,'edit']);
        Route::post("update",[ItemController::class,'update']);
        Route::get("delete/{id}",[ItemController::class,'destroy']);
});


