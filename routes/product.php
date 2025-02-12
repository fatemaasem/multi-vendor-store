<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function(){
    Route::controller(ProductController::class)->group(function(){
        Route::get('products/trashed','trashed')->name('products.trashed');
        Route::put('products/restore/{id}','restore')->name('products.restore');
        Route::delete('products/forceDelete/{id}','forceDelete')->name('products.forceDelete');
        
    });
   

    });
    
   // Apply auth middleware to all routes except 'product.index'
Route::middleware('auth')->group(function () {
    
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Allow public access to 'product.index'
});

