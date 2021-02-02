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

Route::group(['prefix' => 'customer'], function() 
{
    Route::get("customers",[supplierController::class,'index'])->middleware(['auth']);
    Route::get("supplier",[supplierController::class,'suppliers'])->middleware(['auth']);
    Route::get("purchaser",[supplierController::class,'purchasers'])->middleware(['auth']);
    Route::view("add","customer/add")->middleware(['auth']);
    Route::post("add",[supplierController::class,'add'])->middleware(['auth']);
    Route::get("edit/{id}",[supplierController::class,'edit'])->middleware(['auth']);
    Route::post("update",[supplierController::class,'update'])->middleware(['auth']); 
    Route::get("delete/{id}",[supplierController::class,'delete'])->middleware(['auth']);
    
});





// Route::view("order","order");

Route::group(['prefix' => 'stock'], function() 
{
    Route::get('/create', [InventoryController::class,'create'])->middleware(['auth']);
    Route::get('edit/{id}', [InventoryController::class,'edit'])->middleware(['auth']);
    Route::post("store",[InventoryController::class,'store'])->middleware(['auth']);
    Route::get("inventory",[InventoryController::class,'index'])->middleware(['auth']);
    Route::post("update",[InventoryController::class,'update'])->middleware(['auth']);
    Route::get("delete/{id}",[InventoryController::class,'destroy'])->middleware(['auth']);
});


Route::group(['prefix' => 'item'], function() 
{
        Route::get("items",[ItemController::class,'index'])->middleware(['auth']);
        Route::view("add","item/store")->middleware(['auth']);
        Route::post("add",[ItemController::class,'store'])->middleware(['auth']);
        Route::get("edit/{id}",[ItemController::class,'edit'])->middleware(['auth']);
        Route::post("update",[ItemController::class,'update'])->middleware(['auth']);
        Route::get("delete/{id}",[ItemController::class,'destroy'])->middleware(['auth']);
});


