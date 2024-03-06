<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/panel' , function(){
    return view('panel/master');
});

Route::prefix('panel')->group(function(){
    Route::get('home' , [\App\Http\Controllers\AdminPanelController::class , 'index'])->name('panel.home');
    Route::get('logout/{id}' , [\App\Http\Controllers\AdminPanelController::class , 'logout'])->name('logout');
    Route::prefix('product')->group(function(){
        Route::get('/' , [\App\Http\Controllers\AdminPanelController::class , 'product'])->name('products');
        Route::get('add' , [\App\Http\Controllers\AdminPanelController::class , 'addProduct'])->name('add.product');
        Route::get('importExport' , [\App\Http\Controllers\AdminPanelController::class , 'importExport'])->name('importexport.product');
        Route::get('feature' , [\App\Http\Controllers\AdminPanelController::class , 'feature'])->name('feature.product');
        Route::get('category' , [\App\Http\Controllers\AdminPanelController::class , 'category'])->name('category.product');
        Route::get('unit' , [\App\Http\Controllers\AdminPanelController::class , 'unit'])->name('unit.product');
        Route::post('unit/add' , [\App\Http\Controllers\AdminPanelController::class , 'addUnit'])->name('add.unit.product');
        Route::post('unit/delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteUnit'])->name('delete.unit.product');
        Route::get('/unit/get' , [\App\Http\Controllers\AdminPanelController::class , 'getUnit'])->name('get.unit.product');
        Route::post('/unit/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editUnit'])->name('edit.unit.product');
    });
});

Route::prefix('user')->group(function(){
    Route::get('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
    Route::post('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
});
