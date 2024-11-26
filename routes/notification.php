<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::controller(NotificationController::class)->group(function(){
    
    Route::get('notifications', 'index')->name('notifications.index');
    Route::get('notifications/{notification}', 'show')->name('notifications.show');
});