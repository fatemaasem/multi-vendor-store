<?php

namespace App\Models;

use App\Models\Scopes\CartScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
class Cart extends Model
{
    use HasFactory;
  // Indicates that the primary key is not auto-incrementing
  public $incrementing = false;

  protected $fillable = ['id', 'user_id', 'product_id', 'quantity', 'cookie_id', 'options'];

  protected static function boot()
  {
      parent::boot();
      static::addGlobalScope(CartScope::class);
      
  }
  public function product(){
    return $this->belongsTo(Product::class)->withDefault();
  }
  public function user(){
    return $this->belongsTo(User::class)->withDefault();
  }

}
