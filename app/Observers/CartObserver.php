<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
class CartObserver 
{
    /**
     * Handle the Cart "created" event.
     */
    public function created(Cart $cart): void
    {
        //
    }
    public function creating(Cart $cart): void
    
    {
        if (empty($cart->id)) {
           
            $cart->id = Str::uuid();
        }
        if(empty($cart->cookie_id)){
            // Attempt to get the cookie
           $cookie_id = Cookie::get('cookie_id');

           // If the cookie doesn't exist, create it
           if (!$cookie_id) {
               $cookie_id = Str::uuid();
             
               // Return the cookie in the response
               Cookie::queue(Cookie::make('cookie_id', $cookie_id, 30*24*60));
               }
           $cart->cookie_id=$cookie_id;

         }
    }

    /**
     * Handle the Cart "updated" event.
     */
    public function updated(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "deleted" event.
     */
    public function deleted(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "restored" event.
     */
    public function restored(Cart $cart): void
    {
        //
    }

    /**
     * Handle the Cart "force deleted" event.
     */
    public function forceDeleted(Cart $cart): void
    {
        //
    }
}
