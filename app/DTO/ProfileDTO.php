<?php
namespace App\DTO;
class ProfileDTO{
    public static function create($request){
        return [
            'f_name'=>$request->f_name,
            's_name'=>$request->s_name,
            'postal_code'=>$request->postal_code??null,
            'city'=>$request->city??null,
            'country'=>$request->country,
            'street'=>$request->street??null,
            'gender'=>$request->gender,
            'lang'=>$request->lang??null,
        ];
    }
}