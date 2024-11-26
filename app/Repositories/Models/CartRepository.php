<?php
namespace App\Repositories\Models;

use App\Models\Cart;
use App\Models\Product;
use App\Repositories\Contracts\CartContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartRepository implements CartContract{
    public $cart;
    public function __construct()
    {
        $this->cart=collect();
    }
    public function index(){
       if(!$this->cart->count())
            return Cart::with('product')->get();
        else
        return  $this->cart;
    }

    public function insert($productId,$quantity){
       $checkProductFound=Cart::where('product_id','=',$productId)->first();
      
        if($checkProductFound){
            
           $this->cart->map(function($cart)use ($checkProductFound,$quantity){
                if($cart->id==$checkProductFound->id){
                    $cart->quantity=$quantity + $checkProductFound->quantity;
                    $cart->user_id=(Auth::user())?Auth::user()->id:null;
                }
            });

        return  $checkProductFound->update([
            'quantity'=>$quantity + $checkProductFound->quantity,
            'user_id'=>(Auth::user())?Auth::user()->id:null,
        ]);

        }
        
        $cart=Cart::create([
            'user_id'=>(Auth::user())?Auth::user()->id:null,
            'product_id'=>$productId,
            'quantity'=>$quantity,
            // 'price'=>Product::find($productId)->price
        ]);
        $this->cart->push( $cart);
        return $cart;
    }
    
    public function update($cartId,$quantity){
        $cart=Cart::where('id','=',$cartId)->first();
        if(!$cart){
            return false;
        }
        
        return $cart->update([
            'quantity'=>$quantity
        ]);
    }
    public function delete($cartId){
        $cart=Cart::where('id','=',$cartId)->first();
       
        if(!$cart){
            return false;
        }
        
        
        return $cart->delete();
    }
    public function deleteAll()
    {
       
       
        return Cart::query()->delete();;
    }
    public function total (){
      
        $totalPrice = Cart::join('products', 'products.id', '=', 'carts.product_id')
        ->selectRaw('SUM(products.price*carts.quantity) as total_price')
        ->first()->total_price;
        
        
        return ($totalPrice)?$totalPrice:0;
    }
    
}