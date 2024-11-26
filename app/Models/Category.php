<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','slug','parent_cat_id','description','image','status'];
    public $timestamps = false; // Disable timestamps
   
    public function scopeCategoryFilter(Builder $builder,$search){
        if($search['name']){
            $name=$search['name'];
            $builder->where('name','like',"%{$name}%");
        }
        if($search['status']){
            $status=$search['status'];
            $builder->where('status','=',$status);
        }
    }
       //id!=$id and (parent_cat_id is null  Or parent_cat_id!=$id)
    public function scopeCategoryParents(Builder $builder,$id){
        $builder->where('id','!=',$id)->where(function ($query) use($id){
            $query->whereNull('parent_cat_id')
            ->orWhere('parent_cat_id','!=',$id);
        });
    }
    public function parentCategory(): BelongsTo
    {
        // Specify the foreign key 'parent_cat_id'
        return $this->belongsTo(Category::class, 'parent_cat_id')->withDefault(['name'=>'_']);
    }
    public function childCategory(): HasMany
    {
        // Specify the foreign key 'parent_cat_id'
        return $this->hasMany(Category::class, 'parent_cat_id');
    }
    public function products (){
        return $this->hasMany(Product::class,'category_id');
    }
}
