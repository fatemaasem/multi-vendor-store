<?php

use App\Http\Controllers\category\CategoryController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','verified'])->group(function(){
    Route::controller(CategoryController::class)->group(function(){
        Route::get("categories/trash",'trashed')->name('categories.trash');
        Route::put('categories/restore/{id}','restore')->name('categories.restore');
        Route::delete('categories/forceDelete/{id}','forceDelete')->name('categories.forceDelete');
        
    });
    Route::resource('categories',CategoryController::class);
});
