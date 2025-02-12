<?php

namespace App\Http\Controllers\user;

use App\DTO\ProductDTO;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index($category_id = null){
        
        $categories=Category::all();
        if ($category_id) {
            $category = Category::findOrFail($category_id); // Ensure the category exists
            $products = $category->products; // Assuming a `products` relationship exists
        } else {
            $products = Product::all(); // Fetch all products if no category is specified
        }
      
        return view('home',['products'=>$products,"categories"=>$categories]);
    }

    public function show($slug){
      
        $product=ProductRepository::first($slug);
     
        if(!$product) redirect()->route('home');
        $product=ProductDTO::toArray($product);
      
        return view('user.products.show',['product'=>$product]);
    }
    public function updateCurrency(Request $request)
    {
       
        $request->validate([
            'currency' => 'required|string|in:USD,EGP,SAR'
        ]);

        // Set the currency in the config
        config(['service.currency' => $request->currency]);

        // Optionally save to the session or database if needed
        session(['currency' => $request->currency]);
        $rate=CurrencyService::convert('EGP', session('currency'));
      
        session(['rate' => $rate]);
        return response()->json([
            'currency' => session('currency'), 
            'rate' => session('rate')
        ]);
    }
}
