<?php
namespace App\Facades\Repository;

use App\Repositories\Contracts\CartContract;

use Illuminate\Support\Facades\Facade;

class CartFacade extends Facade{
    public static function getFacadeAccessor(){
        return CartContract::class;
    }
}