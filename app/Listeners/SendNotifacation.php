<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreated as NotificationsOrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotifacation
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $users=User::where('store_id',$event->order->store_id)->get() ; 
      
        foreach($users as $user){
         
          $user->notify(new NotificationsOrderCreated($event->order));
           
        }
      
    }
}
