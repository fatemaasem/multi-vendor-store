<?php

namespace App\Models;

use App\Models\Scopes\ProductStoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','slug','status','store_id','category_id','description','price','image','quantity'];
    protected static function booted()
    {
        static::addGlobalScope(new ProductStoreScope);
    }
     // Automatically generate slug when creating a product
     protected static function boot()
     {
         parent::boot();
 
         static::creating(function ($product) {
             $product->slug = Str::slug($product->name);
         });
         // Automatically update slug when product name is updated
        static::updating(function ($product) {
            if ($product->isDirty('name')) { // Check if 'name' is changed
                $product->slug = Str::slug($product->name);
            }
        });
     }

    public function store():BelongsTo{
        return $this->belongsTo(Store::class,'store_id');
    }
    public function category(){
       
        return $this->belongsTo(category::class)->withDefault('');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'products_tags','product_id','tag_id','id','id');
    }
    public function scopeSearch(Builder $builder,$datDto){
        if($name=$datDto['name']){
            $builder->where('name','like',"%$name%");
        }
        if($status=$datDto['status']){
            $builder->where('status','=',$status);
        }
    }
    // Create an accessor for image_url
    public function getImageUrlAttribute(){
         // Check if the image path starts with "http://" or "https://"
        if(isset($this->image)&& filter_var($this->image, FILTER_VALIDATE_URL) && (strpos($this->image, 'http://') === 0 || strpos($this->image, 'https://') === 0)){
            
                return $this->image;
        }
        else if(isset($this->image)){
            return "asset('storage/'.$this->image)";
        }
        else{
            return "data:image/jpeg;base64,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";
        }
        
    }

    // Define the scope
    public function scopeFilter(Builder $query, $filters)
    {
        if(isset($filters['categoy'])){
            $query->where('category_id','=',$filters['category']);
        }
        if(isset($filters['store'])){
            $query->where('store_id','=',$filters['store']);
        }
        $query->when(isset($filters['tag']),function($query) use ($filters) {

            $query->whereIn('id',function($query) use ($filters){
                $query->select('product_id')->from('products_tags')->where('tag_id',$filters['tag']);
            });
        });
    }


}
