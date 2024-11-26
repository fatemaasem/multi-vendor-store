<?php

namespace App\Http\Controllers;

use App\DTO\ProductDTO;
use App\Facades\ProductFacade;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository=$productRepository;
    }
    public function index(SearchRequest $request){
  
        $products=$this->productRepository->search($request);
       $notifications=Auth::guard('admin')->user()->notifications;
     
        return view('products.index',compact('products','notifications'));
    }
    
    public function show($id){
       $product=ProductFacade::show($id);
        if(!$product){
            return redirect()->route('products.index');
        }
        return view("products.show",['product'=>$product]);
    }

    public function create(){
        return view('products.create',['categories'=>CategoryRepository::all(['id','name'])]);
    }
    public function store(ProductRequest $request){
       ProductFacade::store($request);
      return  redirect()->route('products.index');
    }
    public function edit($id){
        $product=ProductFacade::edit($id);
        if(!$product)
            return redirect()->route('products.index');
        return view('products.edit',['product'=>$product,'categories'=>CategoryRepository::all(['id','name'])]);
    }
    public function update(ProductRequest $productRequest,$id){
       ProductFacade::update($productRequest,$id);
       return  redirect()->route('products.index');
    }
   public function destroy($id){
    ProductFacade::destroy($id);
    return  redirect()->route('products.index');
   }
   public function trashed(SearchRequest $request){
   $products=ProductFacade::trashed($request);
   return view('products.trashed',compact('products'));
   }
   public function restore($id){
  
   $product=ProductFacade::restore($id);

   if(!$product)
        return redirect()->route('products.trashed');

     ProductRepository::restore($id);
     Session('success','Product restor successfully');
     return redirect()->route('products.trashed');
    }
    public function forceDelete($id){
        ProductFacade::forceDelete($id);
        return redirect()->route('products.trashed');
    }

   }
   
