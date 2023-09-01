<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['panelsetting', 'auth'], 'prefix'=>'panel', 'as'=>'panel.'], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('panel');
    // slider route
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/add', [SliderController::class, 'create'])->name('slider.create');
    Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider/{id}/update', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('/slider/destroy', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::post('/slider-status/update', [SliderController::class, 'status'])->name('slider.status');
    // category route
    // Route::resource('/category', CategoryController::class); // tüm kategori rotalarını kapsar
    // Route::resource('/category', CategoryController::class)->only('destroy'); // sadece destroy kabul edilirdi
    // Route::resource('/category', CategoryController::class)->only(['index', 'store', 'destroy']); // sadece belirtilen rotalar olsun
    Route::resource('/category', CategoryController::class)->except('destroy'); // destroy çıkartılır.
    Route::delete('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('/category-status/update', [CategoryController::class, 'status'])->name('category.status');
    // about route
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about/update', [AboutController::class, 'update'])->name('about.update');
    // contact route
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{id}/update', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/destroy', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contact-status/update', [ContactController::class, 'status'])->name('contact.status');
});
