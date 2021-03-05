<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\userController;
use Illuminate\Database\MySqlConnection;
use App\Http\Controllers\stockController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\InventoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


require __DIR__.'/auth.php';

Route::get('ali', function () {
        if ( Gate::allows('update-customer')) {
        return view('ali');
    }
    else{
        return'You are Not Eligible';
    }  
});

Route::view("admin-login","users/admin-login");
Route::post("admin-login",[userController::class,'AdminLogin']);

Route::group(['middleware' => ['auth', 'verified']], function() {

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'users'], function() 
{ 
    Route::get("/",[userController::class,'index']);
    Route::get("add",[userController::class,'create']);
    Route::post("add",[userController::class,'store']);
    Route::get("send-email",[userController::class,'store']);
    Route::get("set-password",[userController::class,'UpdatePassword']);
    Route::get("logout",[userController::class,'destroy']);
    Route::post("set",[userController::class,'SetPassword']);
    Route::get("image",[userController::class,'UpdateImage']);
    Route::post("upload",[userController::class,'UploadImage']);
    
});  

    Route::group(['prefix' => 'customers'], function() 
    { 
        Route::get("/",[supplierController::class,'index']);
        Route::get("suppliers",[supplierController::class,'suppliers']);
        Route::get("purchasers",[supplierController::class,'purchasers']);
        Route::get("add",[supplierController::class,'create']);
        Route::post("add",[supplierController::class,'add']);
        Route::get("edit/{supplier}",[supplierController::class,'edit']);
        Route::post("update",[supplierController::class,'update']); 
        Route::get("delete/{supplier}",[supplierController::class,'delete']);
        
    });





    // Route::view("order","order");

    Route::group(['prefix' => 'inventories'], function() 
    {
        Route::get("/",[InventoryController::class,'index']);
        Route::get('/create', [InventoryController::class,'create']);
        Route::get('edit/{inventory}', [InventoryController::class,'edit']);
        Route::post("store",[InventoryController::class,'store']);
        Route::post("update",[InventoryController::class,'update']);
        Route::get("delete/{inventory}",[InventoryController::class,'destroy']);
        Route::get("payment/{inventory}",[InventoryController::class,'payment']);
        Route::get('prices', [InventoryController::class,'GetPrices']);
    });


    Route::group(['prefix' => 'items'], function() 
    {
            Route::get("/",[ItemController::class,'index']);
            Route::get("add",[ItemController::class,'create']);
            Route::post("add",[ItemController::class,'store']);
            Route::get("edit/{item}",[ItemController::class,'edit']);
            Route::post("update",[ItemController::class,'update']);
            Route::get("delete/{item}",[ItemController::class,'destroy']);
            Route::get('home', [ItemController::class,'RemainingStock']);
            Route::get('timeline/{item}', [ItemController::class,'timeline']);
            // Route::get('prices', [ItemController::class,'GetPrices']);
            // Route::get('dues', [ItemController::class,'dues']);
    });

});


