<x-layouts.layout-component title="home">
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            
            <!-- Alert Message -->
            <x-alert type="success" alert='success'/>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title text-primary fw-bold">Shopping Cart</h4>
                        
                        @foreach($cartOpject->index() as $cart)
                        <div class="border rounded p-3 my-3 bg-light">
                            <div class="row align-items-center">
                                
                                <!-- Product Image -->
                                <div class="col-2">
                                    <img class="img-fluid rounded shadow" src="{{ asset('storage/'.$cart->product->image) }}" alt="Item image">
                                </div>
                                
                                <!-- Store Name -->
                                <div class="col">
                                    <div class="text-muted small">Store: <span class="fw-bold">{{ $cart->product->store->name }}</span></div>
                                </div>
                                
                                <!-- Category -->
                                <div class="col-2 text-center">
                                    <label class="fw-bold">Category</label>
                                    <div class="text-muted">{{ $cart->product->category->name }}</div>
                                </div>
                                
                                <!-- Price -->
                                <div class="col-2 text-center">
                                    <label class="fw-bold">Price</label><br>
                                    <div class="d-inline-block text-muted price-currency product-price" data-price="{{ $cart->product->price }}">
                                    {{ session('rate') ? session('rate') * $cart->product->price : $cart->product->price }}{{" "}}
                                </div>
                                <span class="symple-currency">{{ session('currency') ?? 'EGP' }}</span>

                                    
                                </div>
                                
                                <!-- Quantity and Total Price inside a Box -->
                                <div class="col-3 text-center ms-3 p-3 border rounded bg-white">
                                    <label class="fw-bold">Quantity</label>
                                    <form action="{{ route('carts.update') }}" method="POST" class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('PUT')
                                        <x-form.input type="number" name="quantity" :value="$cart->quantity" min="1" class="form-control form-control-sm w-50"/>
                                        <x-form.input type="hidden" name="cart_id" :value="$cart->id"/>
                                      
                                    </form>
                                    <div class="mt-2">
                                        <h6 class="fw-bold">Total</h6>
                                        <span class=" text-muted price-currency product-price" data-price="{{ $cart->product->price * $cart->quantity }}">
                                        {{ session('rate')? session('rate') * $cart->product->price * $cart->quantity : $cart->product->price * $cart->quantity }}{{" "}}
                                        
                                    </span><span class="symple-currency">{{ session('currency')??'EGP'  }}</span>
                                        
                                    </div>
                                </div>
                                
                                <!-- Remove Button (X) in Main Row -->
                                <div class="col-1 text-center">
                                    <form action="{{ route('carts.delete', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" aria-label="Remove">&times;</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Delete All Button -->
                        <form action={{ route("carts.deleteAll") }} method="POST" class="text-center mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Delete All</button>
                        </form>
                        
                        <!-- Back to Shop Button -->
                        <a href="{{ route('home') }}" class="btn btn-link mt-3">&larr; Back to shop</a>
                    </div>
                    
                    <!-- Checkout Button -->
                    <a href="{{ route('checkout') }}" class="btn btn-primary mt-3 w-100">CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout-component>
