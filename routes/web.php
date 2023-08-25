<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\PageHomeController;
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

Route::group(['middleware' => 'sitesetting'], function(){
    Route::get('/', [PageHomeController::class, 'index'])->name('index');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact/save', [AjaxController::class, 'contactsave'])->name('contact.save');
    Route::get('/product', [PageController::class, 'product'])->name('product');
    Route::get('/men/{slug?}', [PageController::class, 'product'])->name('menproduct');
    Route::get('/women/{slug?}', [PageController::class, 'product'])->name('womenproduct');
    Route::get('/children/{slug?}', [PageController::class, 'product'])->name('childrenproduct');
    Route::get('/sales', [PageController::class, 'saleproduct'])->name('sale-product');
    Route::get('/product/{slug}', [PageController::class, 'productdetail'])->name('productdetail');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cartadd');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cartremove');
});
