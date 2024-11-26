<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CartContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

use function Pest\Laravel\delete;

class CartController extends Controller
{
    protected $cartContract;
    public function __construct(CartContract $cartContract)
    {
        $this->cartContract=$cartContract;   
    }
    //for retrive all corts for this user
    public function index(){
    
        return view('user.cart.all',['cartOpject'=>$this->cartContract]);
    }

   

    public function update(Request $request){

     
       
        $request->validate([
            'cart_id' => 'exists:carts,id', // Correct rule is 'exists'
            'quantity' => 'integer|min:1'   // Correct 'int' to 'integer'
        ]);
        
        if(!$this->cartContract->update($request->cart_id,$request->quantity)){
            Session::flash('error','No cart found to update');
            return redirect()->route('carts.index');
        }
        Session::flash('success','Carts save successfully');
        return redirect()->route('carts.index');
    }

    public function store(Request $request){
  
        $request->validate([
            
            'quantity'=>'int|min:1',
        ]);
       
       
       $this->cartContract->insert($request->product,$request->quantity);
        Session::flash('success','cart added successfally');
        return redirect()->route('carts.index');
          
    }

    public function delete($id){
       
        $delete=$this->cartContract->delete($id);
      
        if(!$delete)
            {
                Session::flash('error','cart not avilable for delteting');
              
            }
            else{
                Session::flash('success','cart  delteted successfully');
            }
            return redirect()->route('carts.index');
    }

   public function deleteAll(){
        
        $this->cartContract->deleteAll();
        return redirect()->route('carts.index');
   } 
   public function total(){
       
        $this->cartContract->total();
   }
}
