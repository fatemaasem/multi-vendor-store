<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Repository\CartFacade;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmptyCart
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
       //CartFacade::deleteAll();
    }
}
