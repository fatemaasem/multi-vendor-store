<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::controller(OrderController::class)->group(function(){
    Route::middleware('auth')->group(function(){

   
    Route::get('orders','index')->name('orders.index');
    Route::get('orders/{id}','show')->middleware('notification.read')->name('orders.show'); });
});