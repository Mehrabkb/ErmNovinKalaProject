<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\customerAuthenticateController;
use App\Http\Controllers\customerPanel;
use App\Http\Controllers\customerPanelController;
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
    Route::get('users' , [AdminPanelController::class , 'users'])->name('panel.users');
    Route::get('logout/{id}' , [\App\Http\Controllers\AdminPanelController::class , 'logout'])->name('logout');
    Route::post('user/add' , [AdminPanelController::class , 'addUser'])->name('user.add');
    Route::post('user/delete' , [AdminPanelController::class , 'deleteUser'])->name('user.delete');
    Route::get('user/data' , [AdminPanelController::class , 'getSingleUser'])->name('user.data');
    Route::post('user/edit' , [AdminPanelController::class , 'editUser'])->name('user.edit');
    Route::prefix('product')->group(function(){
        Route::get('/' , [\App\Http\Controllers\AdminPanelController::class , 'product'])->name('products');
        Route::get('add' , [\App\Http\Controllers\AdminPanelController::class , 'addProduct'])->name('add.product');
        Route::post('add' , [\App\Http\Controllers\AdminPanelController::class , 'addProduct'])->name('add.product');
        Route::get('importExport' , [\App\Http\Controllers\AdminPanelController::class , 'importExport'])->name('importexport.product');
        Route::post('delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteProduct'])->name('delete.product');
        Route::get('edit/{id}' , [\App\Http\Controllers\AdminPanelController::class , 'editProduct'])->name('edit.product');
        Route::post('edit' , [\App\Http\Controllers\AdminPanelController::class , 'editProductSingle'])->name('edit.product.single');
        Route::get('feature' , [\App\Http\Controllers\AdminPanelController::class , 'feature'])->name('feature.product');
        Route::get('category' , [\App\Http\Controllers\AdminPanelController::class , 'category'])->name('category.product');
        Route::get('unit' , [\App\Http\Controllers\AdminPanelController::class , 'unit'])->name('unit.product');
        Route::post('unit/add' , [\App\Http\Controllers\AdminPanelController::class , 'addUnit'])->name('add.unit.product');
        Route::post('unit/delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteUnit'])->name('delete.unit.product');
        Route::get('/unit/get' , [\App\Http\Controllers\AdminPanelController::class , 'getUnit'])->name('get.unit.product');
        Route::post('/unit/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editUnit'])->name('edit.unit.product');
        Route::get('/category' , [\App\Http\Controllers\AdminPanelController::class , 'category'])->name('category.product');
        Route::post('/category/add' , [\App\Http\Controllers\AdminPanelController::class , 'addCategory'])->name('add.category.product');
        Route::get('category/single' , [\App\Http\Controllers\AdminPanelController::class , 'getCategorySingle'])->name('get.category.product');
        Route::post('category/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editCategory'])->name('edit.category.product');
        Route::post('category/importer' , [\App\Http\Controllers\AdminPanelController::class , 'importerCategory'])->name('import.category.product');
        Route::get('/tag' , [\App\Http\Controllers\AdminPanelController::class , 'tag'])->name('tag.product');
        Route::post('/tag/add' , [\App\Http\Controllers\AdminPanelController::class , 'addTag'])->name('add.tag.product');
        Route::post('/tag/delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteTag'])->name('delete.tag.product');
        Route::get('/tag/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editTag'])->name('edit.tag.product');
        Route::post('/tag/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editTag'])->name('edit.tag.product');
        Route::post('category/delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteCategory'])->name('delete.category.product');
        Route::get('brand' , [\App\Http\Controllers\AdminPanelController::class , 'brand'])->name('brand.product');
        Route::post('brand/add' , [\App\Http\Controllers\AdminPanelController::class , 'addBrand'])->name('add.brand.product');
        Route::post('/brand/delete' , [\App\Http\Controllers\AdminPanelController::class , 'deleteBrand'])->name('delete.brand.product');
        Route::get('brand/single' , [\App\Http\Controllers\AdminPanelController::class , 'getBrandSingle'])->name('get.brand.single');
        Route::post('brand/edit' , [\App\Http\Controllers\AdminPanelController::class , 'editBrand'])->name('edit.brand.product');
        Route::post('import' , [\App\Http\Controllers\AdminPanelController::class , 'importProduct'])->name('import.product');
        Route::get('product/edit/price' , [AdminPanelController::class , 'editProductPrice'])->name('product.edit.price');
        Route::post('product/edit/price' , [AdminPanelController::class , 'editProductPrice'])->name('product.edit.price');
        Route::get('product/edit/brand' , [AdminPanelController::class , 'editBrandPrice'])->name('product.edit.brand');
        Route::post('product/edit/brand' , [AdminPanelController::class , 'editBrandPrice'])->name('product.edit.brand');

    });
});

Route::prefix('user')->group(function(){
    Route::get('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
    Route::post('login' , [\App\Http\Controllers\UserController::class , 'login'])->name('login');
});
Route::prefix('customer')->group(function(){
    Route::get('login' , [customerAuthenticateController::class , 'login'])->name('customer.login');
    Route::post('login' , [customerAuthenticateController::class , 'login'])->name('customer.login');
    Route::post('request/code' , [customerAuthenticateController::class , 'verifyCode'])->name('request.code.verify');
    Route::get('home' , [customerPanelController::class , 'home'])->name('customer.panel.home');
    Route::get('logout/{id}',  [customerPanelController::class , 'logout'])->name('customer.logout');
    Route::get('factor/add' , [customerPanelController::class , 'addFactor'])->name('customer.factor.add');
    Route::get('product/search/result' , [customerPanelController::class , 'productSearchResult'])->name('product.search.result');
    Route::post('basket/add/item' , [customerPanelController::class , 'basketItemAdder'])->name('basket.add.item');
    Route::post('basket/delete/item' , [customerPanelController::class , 'deleteBasketItem'])->name('basket.delete.item');
    Route::get('prefactor/add/{id}' , [customerPanelController::class , 'addPreFactor'])->name('customer.prefactor.add');
    Route::get('factors' , [customerPanelController::class , 'factors'])->name('customer.factors');
});

