<?php


use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\ProductController as Admin;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Route;


Route::get('marchant-dashboard/{id?}',[Admin::class,'index'])->name("products.index")->middleware('auth');;

Route::controller(ProductController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('home/{id?}', 'index')->name('home');
   
    Route::get('/user-products/{slug}', 'show')->name('user.product_details');
    Route::post('/update-currency',  'updateCurrency');
});



Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile/edit','edit')->name('profile.edit');
        Route::put('profile/update','update')->name('profile.update');
    });
});



 Route::controller(CartController::class)->group(function(){
    Route::get('/cart','index')->name('cart.index');
    Route::post('/carts/store','store')->name('carts.store');
    Route::put('/carts/update','update')->name('carts.update');
    Route::delete('carts/delete/{id}','delete')->name('carts.delete');
    Route::delete('carts/deleteAll','deleteAll')->name('carts.deleteAll');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/category.php';
include __DIR__.'/product.php';
include __DIR__.'/store.php';
include __DIR__.'/cart.php';
include __DIR__.'/checkout.php';
include __DIR__.'/notification.php';
include __DIR__.'/order.php';
Route::get('/convert-currency', [CurrencyController::class, 'convert']);