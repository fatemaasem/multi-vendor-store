<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    // Define the primary key
    protected $primaryKey = 'user_id';

    // Disable auto-incrementing, because the primary key is not an integer (it's a foreign key)
    public $incrementing = false;

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'f_name',
        's_name',
        'street',
        'city',
        'country',
        'postal_code',
        'lang',
        'gender',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
