<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use Illuminate\Database\MySqlConnection;
use App\Http\Controllers\stockController;
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
})->name('dashboard');

require __DIR__.'/auth.php';

Route::get('ali', function () {
        if ( Gate::allows('update-customer')) {
        return view('ali');
    }
    else{
        return'You are Not Eligible';
    }  
});

Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function() 
{ 
    Route::get("/",[supplierController::class,'index']);
    Route::get("supplier",[supplierController::class,'suppliers']);
    Route::get("purchaser",[supplierController::class,'purchasers']);
    Route::view("add","customer/add");
    Route::post("add",[supplierController::class,'add']);
    Route::get("edit/{supplier}",[supplierController::class,'edit']);
    Route::post("update",[supplierController::class,'update']); 
    Route::get("delete/{supplier}",[supplierController::class,'delete']);
    Route::get("/search",[supplierController::class,'search']);
    
});





// Route::view("order","order");

Route::group(['prefix' => 'stock', 'middleware' => 'auth'], function() 
{
    Route::get("/",[InventoryController::class,'index']);
    Route::get('/create', [InventoryController::class,'create']);
    Route::get('edit/{inventory}', [InventoryController::class,'edit']);
    Route::post("store",[InventoryController::class,'store']);
    Route::post("update",[InventoryController::class,'update']);
    Route::get("delete/{inventory}",[InventoryController::class,'destroy']);
    // Route::view("home","stock/home");
    Route::get('home', [InventoryController::class,'RemainingStock']);
});


Route::group(['prefix' => 'item', 'middleware' => 'auth'], function() 
{
        Route::get("/",[ItemController::class,'index']);
        Route::view("add","item/store");
        Route::post("add",[ItemController::class,'store']);
        Route::get("edit/{item}",[ItemController::class,'edit']);
        Route::post("update",[ItemController::class,'update']);
        Route::get("delete/{item}",[ItemController::class,'destroy']);
});


