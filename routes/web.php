<?php

use App\Http\Controllers\AjaxController;
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
    Route::get('/men-clothing', [PageController::class, 'product'])->name('men-product');
    Route::get('/women-clothing', [PageController::class, 'product'])->name('women-product');
    Route::get('/children-clothing', [PageController::class, 'product'])->name('chilren-product');
    Route::get('/sales', [PageController::class, 'saleproduct'])->name('sale-product');
    Route::get('/product/{slug}', [PageController::class, 'productdetail'])->name('productdetail');
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
});
