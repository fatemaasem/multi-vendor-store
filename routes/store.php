<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
Route::middleware(['auth','verified'])->group(function(){
    Route::controller(StoreController::class)->group(function(){
        Route::get("stores/trash",'trashed')->name('stores.trash');
        Route::put('stores/restore/{id}','restore')->name('stores.restore');
        Route::delete('stores/forceDelete/{id}','forceDelete')->name('stores.forceDelete');
        
    });
    Route::resource('stores',StoreController::class);
});
