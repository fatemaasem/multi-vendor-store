<?php
namespace App\Repositories;

use App\DTO\CategoryDTO;
use App\DTO\SearchDTO;
use App\Models\Category;

class CategoryRepository{
    public function categoryFilter($request){
       // dd($request->username);
    return Category::with('products')->categoryFilter(SearchDTO::create($request))->paginate(2);
    }
    public static function all($key=["*"]){
        return Category::all($key);
    }
    public function find($id){
        return Category::find($id);
    }
    public function categoryParents($id){
        return Category::categoryParents($id)->get();
    }
    public function trash(){
        return Category::onlyTrashed()->paginate(2);
    }
    public function create($category){
        return Category::create($category);
    }
    public function update($id,$data){
        return $this->find($id)->update($data);
    }
    public function destroy($id){
        return $this->find($id)->delete();
    }
    public static function getRandemId(){
        return Category::first()?  Category::inRandomOrder()->first()->id :null;
    }
}
   