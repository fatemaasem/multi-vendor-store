<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['verified','user.rule'])->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('products/trashed','trashed')->name('products.trashed');
        Route::put('products/restore/{id}','restore')->name('products.restore');
        Route::delete('products/forceDelete/{id}','forceDelete')->name('products.forceDelete');
    });
   

    });
    Route::resource('products',ProductController::class);