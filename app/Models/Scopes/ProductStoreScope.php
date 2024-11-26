<?php

namespace App\Models\Scopes;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class ProductStoreScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        if(Auth::check()&&Auth::user()->user_rule=='user'){
            $builder->where('status','=','active');
        }
        else if(Auth::check()&&Auth::user()->store_id) {
            $builder->where('store_id', '=', Auth::user()->store_id);
        }
        
        
    }
    
}
