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
        return redirect()->route('cart.index');
    }

    public function store(Request $request){
       // Validate the product_id
            $validatedData = $request->validate([
                'product' => 'required|integer|exists:products,id',
            ]);


// Retrieve the product based on the validated product_id
$product = \App\Models\Product::find($validatedData['product']);

// Validate the quantity with a dynamic max value
$request->validate([
    'quantity' => 'required|integer|min:1|max:' . $product->quantity,
]);

       $this->cartContract->insert($request->product,$request->quantity);
        Session::flash('success','cart added successfally');
       ;
        return redirect()->route('cart.index');
          
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
            return redirect()->route('cart.index');
    }

   public function deleteAll(){
        
        $this->cartContract->deleteAll();
        return redirect()->route('cart.index');
   } 
   public function total(){
       
        $this->cartContract->total();
   }
}
