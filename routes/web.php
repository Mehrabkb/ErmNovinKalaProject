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
});

Route::prefix('user')->group(function(){
    Route::get('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
    Route::post('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
});
