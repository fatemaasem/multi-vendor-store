<?php

use App\Http\Controllers\Cart\CartController;
use Illuminate\Support\Facades\Route;

Route::controller(CartController::class)->group(function(){
    Route::get('carts','index')->name('carts.index');
    Route::post('/carts/store','store')->name('carts.store');
    Route::put('/carts/update','update')->name('carts.update');
    Route::delete('carts/delete/{id}','delete')->name('carts.delete');
    Route::delete('carts/deleteAll','deleteAll')->name('carts.deleteAll');
});
