<?php
namespace App\DTO;

use Illuminate\Support\Facades\Auth;
use illuminate\support\Str;
class ProductDTO{
    protected $name;
    protected $description;
    protected $image;
    protected $storeName;
    protected $categoryName;
    protected $status;
    protected $price;

    public static function create($request){
        
       
        return [
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'description'=>$request->description??null,
            'image'=>$request->image??null,
            'store_id'=>Auth::user()->store_id??null,
            'category_id'=>$request->category_id??null,
            'status'=>$request->status,
            'price'=>$request->price,
           'tags'=>explode(',',$request->tags)
        ];
    }
    
    public static function toArray($productFromDatabase,$tags=''){
       
        return [
            'id'=>$productFromDatabase->id,
            'name'=>$productFromDatabase->name,
            'slug'=>Str::slug($productFromDatabase->name),
            'description'=>$productFromDatabase->description??'',
            'quantity'=>$productFromDatabase->quantity??'',
            'image'=>$productFromDatabase->image??'',
            'image_url'=>$productFromDatabase->image_url,
            'status'=>$productFromDatabase->status,
            'price'=>$productFromDatabase->price,
            'comparePrice'=>$productFromDatabase->compare_price??'',
            'category_id'=>$productFromDatabase->category_id??'',
            'categoryName'=>$productFromDatabase->category_id?$productFromDatabase->category->name :'',
            'store_id'=>$productFromDatabase->store_id??'',
            'storeName'=>$productFromDatabase->store_id?$productFromDatabase->store->name :'',
            'tags'=>$tags
        ];

    }
}