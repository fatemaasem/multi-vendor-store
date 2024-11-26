<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable=['full_name','phone','city','address','order_id','type'];
    public function order(){
        return $this->hasOne(Order::class);
    }
}
