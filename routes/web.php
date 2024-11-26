<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\user\ProductController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
Route::get('test2',function(){
return view('test2');
});
Route::controller(ProductController::class)->group(function(){
    Route::get('/', 'index')->name('home');
    Route::get('/user-products/{slug}', 'show')->name('user.product_details');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'verified'])->group(function(){
    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile/edit','edit')->name('profile.edit');
        Route::put('profile/update','update')->name('profile.update');
    });
});

Route::view('2-factor','auth.two-factor')->middleware('auth')->name('2-factor');
Route::prefix('admin')->name('admin.')->group(function () {

    Route::view('/login', 'auth.admin-login')->middleware('guest:admin')->name('login');
    
    // $limiter = config('fortify.limiters.login');

    // Route::post('/login', [AuthenticatedSessionController::class, 'store'])

    //     ->middleware(array_filter([

    //         'guest:admin',

    //         $limiter ? 'throttle:' . $limiter : null,

    //     ]));

    // Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])

    //     ->middleware('auth:admin')

    //     ->name('logout');

    //Route::view('/home', 'admin.home')->middleware('auth:admin')->name('home');

});


//require __DIR__.'/auth.php';
//require __DIR__.'/admin-auth.php';
require __DIR__.'/category.php';
include __DIR__.'/product.php';
include __DIR__.'/store.php';
include __DIR__.'/cart.php';
include __DIR__.'/checkout.php';
include __DIR__.'/notification.php';
include __DIR__.'/order.php';