<x-layouts.layout-component title="home">
    <div class="container mt-5">
        <div class="card">
            <x-alert type="success" alert='success'/>
            <div class="row">
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title"><b>Shopping Cart</b></h4>
                        <p class="card-text text-muted text-right">
                          
                        </p>

                        @foreach($cartOpject->index() as $cart)
                        <div class="border-top border-bottom py-3">
                            <div class="row align-items-center">
                                <div class="col-2">
                                    <img class="img-fluid" src="{{ $cart->product->image_url }}" alt="Item image">
                                </div>
                                <div class="col">
                                    <div class="text-muted">Category Name :{{$cart->product->category->name }}</div>
                                    <div>Product Name :{{ $cart->product->name }}</div>
                                </div>
                                <div class="col-3">
                                    <!-- Form for Editing Quantity -->
                                    <form action="{{ route('carts.update') }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT') <!-- Tells Laravel to treat this request as PUT -->
                                        <x-form.input type="number" name="quantity" :value="$cart->quantity" min="1"/>
                                        <x-form.input type="hidden" name="cart_id" :value="$cart->id"/>
                                        <button type="submit" class="btn btn-sm btn-primary mt-2">Save</button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <!-- Price -->
                                    <div class="text-muted">{{ App\Helper\Currency::getCurrencySymbolByCountry() . $cart->product->price * $cart->quantity }}</div>
                                </div>
                                <div class="col-1">
                                    <!-- Form for Deleting Cart Item -->
                                    <form action="{{ route('carts.delete', $cart->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" aria-label="Remove">&times;</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <form action={{route("carts.deleteAll") }} method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="alert alert-danger alert-dismissible fade show">Delete All</button>
                        </form>
                        <a href="{{ route('home') }}" class="btn btn-link mt-3">&larr; Back to shop</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-body">
                        <h5 class="card-title"><b>Summary</b></h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            
                        </div>

                        <form class="mt-3">
                            <div class="mb-3">
                                <label class="form-label" for="shipping">SHIPPING</label>
                                <select class="form-select" id="shipping">
                                    <option class="text-muted">Standard-Delivery - &euro;5.00</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="code">GIVE CODE</label>
                                <input type="text" class="form-control" id="code" placeholder="Enter your code">
                            </div>
                        </form>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <div>TOTAL PRICE</div>
                            <div>&euro; {{$cartOpject->total()}}</div>
                        </div>

                        <a  href="{{route('checkout')}}" class="btn btn-primary mt-3 w-100">CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout-component>
