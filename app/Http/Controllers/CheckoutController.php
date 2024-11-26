<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Events\TestEvent;
use App\Facades\Repository\CartFacade;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\EventDispatcher\Event;

class CheckoutController extends Controller
{
    public function checkout(){
      
        return view('front.checkout',['totalPrice',CartFacade::total()]);
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'address.billing.*' => 'required',
            'address.shipping.*' => 'required',
        ]);

        // Get all cart items grouped by store_id
        $carts = CartFacade::index()->groupBy('product.store_id');

        // Start database transaction
        DB::beginTransaction();
        try {
            foreach ($carts as $store_id => $cart) {
                // Create an order for each store
                $order = Order::create([
                    'user_id' => Auth::check() ? Auth::user()->id : null,
                    'store_id' => $store_id,
                    'total' => $cart->sum('product.price')
                ]);

                // Create order items for each product in the cart
                foreach ($cart as $item) {
                    OrderProduct::create([
                        'product_id' => $item->product_id,
                        'order_id' => $order->id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price,
                    ]);
                }

                // Prepare and create billing address
                $billing = $this->prepareAddressData($order->id, $request->address['billing'], 'billing');
                Address::create($billing);

                // Prepare and create shipping address
                $shipping = $this->prepareAddressData($order->id, $request->address['shipping'], 'shipping');
                Address::create($shipping);

                // $user_ids=User::where('store_id',$store_id)->pluck('id')->toArray();
                // foreach($user_ids as $user_id){
                //     broadcast(new TestEvent($order,$user_id));
                // }
                $id=User::where('store_id',$store_id)->first()->id;
               
                 event(new OrderCreated($order,$id));
            }

            // Commit transaction if everything is successful
           
           
            DB::commit();

            // Redirect to home page after successful transaction
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Rollback the transaction if there's an error
            DB::rollBack();
            // You could add an error message here to notify the user about the issue
            return redirect()->route('home')->with('error', 'Failed to complete the order. Please try again.');
        }
    }

    /**
     * Prepare address data to be saved.
     *
     * @param int $orderId
     * @param array $address
     * @param string $type
     * @return array
     */
    private function prepareAddressData(int $orderId, array $address, string $type): array
    {
        // Add order_id and type (billing or shipping) to the address data
        return array_merge($address, [
            'order_id' => $orderId,
            'type' => $type,
        ]);
    }

}

