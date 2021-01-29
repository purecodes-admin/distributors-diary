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
Route::get("supplier",[supplierController::class,'index']);
Route::get("purchaser",[supplierController::class,'index1']);
Route::post("addsupplier",[supplierController::class,'addsupplier']);
Route::get("edit/{id}",[supplierController::class,'edit']);
Route::post("update",[supplierController::class,'update']);
Route::get("delete/{id}",[supplierController::class,'delete']);
Route::view("add","addsupplier");
// Route::view("order","order");
Route::get("addStock",[supplierController::class,'index2']);
Route::post("store",[InventoryController::class,'store']);
Route::get("inventory",[InventoryController::class,'index']);
Route::get("editstock/{id}",[InventoryController::class,'edit']);
Route::post("updatestock",[InventoryController::class,'update']);
Route::get("deletestock/{id}",[InventoryController::class,'destroy']);

Route::get("items",[ItemController::class,'index']);
Route::view("additem","additem");
Route::post("additem",[ItemController::class,'store']);
Route::get("edititem/{id}",[ItemController::class,'edit']);
Route::post("updateitem",[ItemController::class,'update']);
Route::get("deleteitem/{id}",[ItemController::class,'destroy']);


