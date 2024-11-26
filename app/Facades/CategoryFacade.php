<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class CategoryFacade extends Facade{
    public static function getFacadeAccessor(){
        return 'category-service';
    }
}