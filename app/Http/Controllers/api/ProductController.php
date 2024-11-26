<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Product::filter($request->query())->with('category:id,name')->paginate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['name'=>'required|string|min:3',
            'category_id'=>'required|exists:categories,id',
            'quantity'=>'required|int'
            ]
        );
       
       return Product::create(['name'=>$request->name,
       'category_id'=>$request->category_id,
       'quantity'=>$request->quantity
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::findOrFail($id);
        if(!$product)return "not found";
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            ['name'=>'sometimes|string|min:3',
            'category_id'=>'sometimes|exists:categories,id',
            'quantity'=>'sometimes|int'
            ]
        );
        $product=Product::find($id);
        
        return $product->update([
           'name'=>$request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);
        //return $product;
      return $product->delete();
    }
    
}
