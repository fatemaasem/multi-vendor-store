<?php

namespace App\Providers;

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ProductCntroller;
use App\Http\Requests\searchRequest;
use App\Models\Cart;
use App\Observers\CartObserver;
use App\Repositories\Contracts\CartContract;
use App\Repositories\Models\CartRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


        $this->app->bind('category-service',function($app){
           return  new CategoryService();
        });
        $this->app->bind('product-service',function($app){
            return new ProductService();
        });

        $this->app->bind(CartContract::class,function($app){
            return new CartRepository();
        });
         
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('count_words',function($attribute, $value, $count_word){
            $count=str_word_count($value);
          
            if($count!=$count_word[0]){
                return false;
            }
            
        return true;
        },'Number of words in :attribute is false');

        paginator::useBootstrap();
        Cart::observe(CartObserver::class);
        
    }
   
}
