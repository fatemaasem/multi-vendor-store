<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
Route::controller(CheckoutController::class)->group(function(){
    Route::get('checkout','checkout')->name('checkout');
    Route::post('checkout/store','store')->name('checkout.store');
});
