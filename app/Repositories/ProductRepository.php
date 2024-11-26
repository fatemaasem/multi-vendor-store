<?php
namespace App\Repositories;

use App\DTO\ProductDTO;
use App\DTO\SearchDTO;
use App\Models\Product;

class ProductRepository{
  public static function all(){
    $products = Product::all();
    // Transform each product to ProductDTO
    $productDTOs = $products->map(function($product) {
        return ProductDTO::toArray($product);
    });
    return  $productDTOs;
  }
   public static function search($request){
  
        return Product::search(SearchDTO::create($request))->paginate(2);
   }
   public static function find($value,$column="id"){

        return Product::find($value,$column)??false;
   }
   public static function first($value,$column='slug'){
   // Product::where($column,'=',$value)->dd();
    return Product::where($column,'=',$value)->first()??'';
   }
   
   public static function create($dataToDatabase){
     return Product::create($dataToDatabase);
   } 
   public static function update($productFromDatabase,$productDto){
     return $productFromDatabase->update($productDto);
   }
   public static function trashed($request){
    // First, create the search data transfer object and check its contents
    $searchDto = SearchDTO::create($request);
    
    return Product::onlyTrashed()->search($searchDto)->paginate(2);
   }
   public static function restore($id){
  
    return Product::withTrashed()->find($id)->restore();
   }
   public static function findTrashed($id){
    return Product::withTrashed()->find($id)??false;
   }
   public static function forceDelete($id){
    return ProductRepository::findTrashed($id)->forceDelete();
   } 
}