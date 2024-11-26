<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','store_id','number','payment_method','price'];

    public function addresses(){
        return $this->hasMany(Address::class,'address_id','id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'order_product','order_id','product_id','id','id')->withPivot(
            'quantity','price'
        );
    }
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    //return only shipping adrress
    public function shippingAdrresses(){
        return $this->hasOne(Address::class,'order_id','id')->where('type','=','shipping');
    }

     //return only shipping adrress
     public function pillingAdrresses(){
        return $this->hasOne(Address::class,'order_id','id')->where('type','=','billing');
    }
    protected static function booted(){

        static::creating(function (Order $order) {
            $order->number= date('Y');
            //Get the max number for this year if not found, use 0
            //You can implement the logic to fetch the maximum order number for the current year.
           
             $maxNumber = self::whereYear('created_at', date('Y'))->max('number');
            $order->number =(string) $maxNumber ? $maxNumber + 1 : date('Y');
        });
    } 
}
