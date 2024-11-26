<?php
namespace App\DTO;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

 class SearchDTO{
    public $name;
    public $status;

    public static function create($request){
        return[
            'name'=>$request->username??'',
            'status'=>$request->status??'',
        ];
    }
 }