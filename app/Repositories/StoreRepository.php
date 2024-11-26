<?php
namespace App\Repositories;

use App\Models\Store;

class StoreRepository{
    public static function getRandemId(){
        return Store::first()?  Store::inRandomOrder()->first()->id :null;
    }
    public static function all($key=['id','name']){
        return Store::all($key);
    }
}