<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

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

Route::controller(Homecontroller::class)->group(function () {
    Route::get('/index', 'show')->name('index');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/product', 'list')->name('product-list');
    Route::get('/product/create', 'createForm')->name('product-create-form');
    Route::post('/product/create', 'create')->name('product-create');
    Route::get('/product/{product}', 'show')->name('product-view');
    Route::get('/product/{product}/update','updateForm')->name('product-update-form');
    Route::post('/product/{product}/update','update')->name('product-update');
    Route::get('/product/{product}/delete','delete')->name('product-delete');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/category', 'list')->name('category-list');
    Route::get('/category/{category}', 'show')->name('category-view');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/auth/login', 'loginForm')->name('login');
    Route::post('/auth/login', 'authenticate')->name('authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});

Route::controller(CartController::class)->group(function (){
    Route::get('/cart/product', 'list')->name('cart-product-list');
    Route::get('/cart/add/{product}', 'addProduct')->name('cart-add-product');
    Route::get('/cart/remove/{product}', 'removeProduct')->name('cart-remove-product');
    Route::post('/cart/update', 'update')->name('cart-update');
    Route::get('/cart/confirm', 'confirm')->name('cart-confirm');
    Route::get('/cart/completed', 'listCompleted')->name('cart-completed');
    Route::get('/cart/completed/{cart}', 'cartDetail')->name('cart-detail');
    Route::get('/cart/completed/{cart}/export', 'cartExport')->name('cart-export');
});