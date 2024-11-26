<?php
namespace App\Services;

use App\DTO\ProductDTO;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Tag;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductService{
    
   
    public function checkProduct($product){
       $tags=implode(',',$product->tags->pluck('name')->toArray()) ;
      
        $product=ProductDTO::toArray($product,$tags);
        if(!$product){
            Session::flash('error','Product not found');
            return false;
        }
       
        return $product;
    }
    
    public function show($id){
        dd(Product::whereIn('category_id', function($query) {
            $query->select('id')
                  ->from('categories');
        })->get());
        $product=$this->checkProduct(ProductRepository::find($id));
       
        return $product;
    }

    public function store(ProductRequest $request){
       $dtoData= ProductDTO::create($request);
      
      //check image 
      if($dtoData['image']){
        $dtoData['image']=$this->storeImage($dtoData['image']);
      }
    
      $filterProduct=array_filter($dtoData, function($key)  {
        return $key != 'tags';
    },ARRAY_FILTER_USE_KEY);
  
      $product=ProductRepository::create($dtoData);
     
      $tags=$this->tagIds($dtoData['tags']);

      $product->tags()->sync($tags);
      Session::flash('success','Product added successfully');

    }
    public function tagIds($tags){
        $tag_ids=[];
        foreach($tags as $tag){
            
            $tagModel=Tag::where('slug',Str::slug($tag))->first();
            if(!isset($tagModel->id)){
                $tagModel= Tag::create([
                    'name'=>$tag,
                    'slug'=>Str::slug($tag)
                ]);
                
            }
            
            $tag_ids[]=$tagModel->id;
        }
         return  $tag_ids;
       
    }
    public function storeImage($image){
        return $image->store('products',['disk'=>'public']);
    }
    
    public function edit($id){
        
        return $this->checkProduct(ProductRepository::find($id));
       
    }
    public function update(ProductRequest $request, $id){
       $productDto=ProductDTO::create($request);
      
       $oldProduct=(ProductRepository::find($id));
        
       $pathImage=$oldProduct['image'];
       if($productDto['image']){
            //delete old image image
            Storage::disk('public')->delete($oldProduct['image']);
            //store new image
            $pathImage=$this->storeImage($productDto['image']);
            
       }
       $productDto['image']=$pathImage;
      
       $productWithoutTags=array_filter($productDto, function($key)  {
        return $key != 'tags';
        },ARRAY_FILTER_USE_KEY);
      
        $oldProduct->update($productWithoutTags);
        $oldProduct->tags()->sync($this->tagIds($productDto['tags']));
       Session::flash('success','Product updated successfully');
       return $productDto;

    }
    public function destroy($id){
       $product=ProductRepository::find($id);
       $product->delete();
       Session::flash('success','Product deleted successfully');
    }
    public function trashed($request){
        return ProductRepository::trashed($request);
    }
    public function restore($id){
        $product=ProductRepository::findTrashed($id);
        if(! $product){
            Session('error','Product not found');
            return false;
        }
        return  $product;
    }
    public function forceDelete($id){
        $product=ProductRepository::findTrashed($id);
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        Session::flash('success','Product deleted force successfully');
        ProductRepository::forceDelete($id);
    }
}