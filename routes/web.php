<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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
    Route::get('/product/create', 'createForm')->name('product-create-form')->middleware('auth');
    Route::post('/product/create', 'create')->name('product-create')->middleware('auth');
    Route::get('/product/{product}', 'show')->name('product-view');
    Route::get('/product/{product}/update','updateForm')->name('product-update-form')->middleware('auth');
    Route::post('/product/{product}/update','update')->name('product-update')->middleware('auth');
    Route::get('/product/{product}/delete','delete')->name('product-delete')->middleware('auth');
});

Route::controller(CategoryController::class)->group(function (){
    Route::get('/category', 'list')->name('category-list');
    Route::get('/category/create', 'createForm')->name('category-create-form')->middleware('auth');
    Route::post('/category/create', 'create')->name('category-create')->middleware('auth');
    Route::get('/category/{category}', 'show')->name('category-view');
    Route::get('/category/{category}/update','updateForm')->name('category-update-form')->middleware('auth');
    Route::post('/category/{category}/update','update')->name('category-update')->middleware('auth');
    Route::get('/category/{category}/delete','delete')->name('category-delete')->middleware('auth');

});

Route::controller(LoginController::class)->group(function(){
    Route::get('/auth/login', 'loginForm')->name('login');
    Route::post('/auth/login', 'authenticate')->name('authenticate');
    Route::get('/auth/logout', 'logout')->name('logout');
});

Route::controller(CartController::class)->middleware('auth')->group(function (){
    Route::get('/cart/product', 'list')->name('cart-product-list');
    Route::get('/cart/add/{product}', 'addProduct')->name('cart-add-product');
    Route::get('/cart/remove/{product}', 'removeProduct')->name('cart-remove-product');
    Route::post('/cart/update', 'update')->name('cart-update');
    Route::get('/cart/confirm', 'confirm')->name('cart-confirm');
    Route::get('/cart/completed', 'listCompleted')->name('cart-completed');
    Route::get('/cart/completed/{cart}', 'cartDetail')->name('cart-detail');
    Route::get('/cart/completed/{cart}/export', 'cartExport')->name('cart-export');
});

Route::controller(UserController::class)->middleware('auth')->group(function(){
    Route::get('/user', 'list')->name('user-list');
    Route::get('/user/create', 'createForm')->name('user-create-form');
    Route::post('/user/create', 'create')->name('user-create');
    Route::get('/user/{user}', 'show')->name('user-view');
    Route::get('/user/{user}/update','updateForm')->name('user-update-form');
    Route::post('/user/{user}/update','update')->name('user-update');
    Route::get('/user/{user}/delete','delete')->name('user-delete');
});