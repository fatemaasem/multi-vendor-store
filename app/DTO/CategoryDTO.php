<?php
namespace App\DTO;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

 class CategoryDTO{
   
    
   
    public static function create(CategoryRequest $request){
        return[
            'name'=>$request->username,
            'parent_cat_id'=>$request->parent_cat_id??null,
            'description'=>$request->description??null,
            'image'=>$request->image??null,
            'status'=>$request->status,];
    }
    public static function toArray($dataFromDataBase){
     
        return[
            'id'=>$dataFromDataBase->id,
            'name'=>$dataFromDataBase->name,
            'slug'=>$dataFromDataBase->slug,
            'parent_cat_id'=>$dataFromDataBase->parent_cat_id??'',
            'description'=>$dataFromDataBase->description??'',
            'image'=>$dataFromDataBase->image??'',
            'status'=>$dataFromDataBase->status,
            'parentName'=>$dataFromDataBase->parentCategory->name
        ];
    }
 }