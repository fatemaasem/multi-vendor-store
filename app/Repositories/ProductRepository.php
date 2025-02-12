<?php
namespace App\Repositories;

use App\DTO\ProductDTO;
use App\DTO\SearchDTO;
use App\Models\Category;
use App\Models\Product;

class ProductRepository{
  public static function all($category_id){
    if($category_id)
    return Product::where('category_id',$category_id)->get();
   else return   Product::all();
    
  }
   public static function search($request,$id){
  
       // Create a search DTO from the request
    $searchDTO = SearchDTO::create($request);
   if($id){
    // Apply the 'marchent' local scope and perform the search, then paginate
    return Product::where('category_id',$id)
        ->marchent() // Apply the local scope for filtering by merchant
        ->search($searchDTO) // Apply the search functionality
        ->paginate(2); // Paginate the results with 2 items per page
   }
   else{
    return Product::query()
        ->marchent() // Apply the local scope for filtering by merchant
        ->search($searchDTO) // Apply the search functionality
       ->paginate(2); // Paginate the results with 2 items per page
   }
   
  }

   public static function find($value,$column="*"){

        return Product::find($value,$column)??false;
   }
   public static function first($value,$column='slug'){
   // Product::where($column,'=',$value)->dd();
    return Product::where($column,'=',$value)->first()??'';
   }
   
   public static function create($dataToDatabase){
    
     return Product::marchent()->create($dataToDatabase);
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