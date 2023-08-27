<?php

use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'panelsetting', 'prefix'=>'panel'], function(){
    Route::get('/', [DashboardController::class, 'index'])->name('panel');
});
