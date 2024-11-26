<?php

namespace App\Http\Controllers\user;

use App\DTO\ProductDTO;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index(){
        $products=ProductRepository::all();
       
        return view('home',['products'=>$products]);
    }
    public function show($slug){
      
        $product=ProductRepository::first($slug);
       
        if(!$product) redirect()->route('home');
        $product=ProductDTO::toArray($product);
      
        return view('user.products.show',['product'=>$product]);
    }
}
