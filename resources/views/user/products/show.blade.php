<x-layouts.layout-component title="home">
  
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                 
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                       
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid rounded" style="max-height: 300px;">
                        
                            <h2 class="title">Name:{{$product['name']}}</h2>
                            <p class="category"><i class="lni lni-tag"></i> Category : <a href="javascript:void(0)">{{$product['categoryName']}}</a></p>
                            <h3 class="d-inline-block  price-currency product-price" data-price="{{ $product['price'] }}">
                                    {{ session('rate') ? session('rate') * $product['price'] : $product['price'] }}{{" "}}
                                </h3>
                                <h3 class=" d-inline-block symple-currency">{{ session('currency') ?? 'EGP' }}</h3>

                           
                          
                            <p class="info-text">Description: {{$product['description']}}</p>
                            <div class="row">
                               
                            <form action="{{route('carts.store')}}" method="post">
                            @csrf
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-group quantity">
                                        <label for="color">Quantity</label>
                                        <div class="wish-button">
                                        <input class="btn" name="quantity" value="{{ $product['quantity'] }}" type="number"/><br>
                                        @error('quantity')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror

                                        <input name="product" value="{{ $product['id'] }}" type="hidden"/>
                                          @error('product')
                                        <div class="alert alert-danger mt-2" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        </div>
                                    </div>
                                </div><br>
                                <button type="submit" >Add to Cart</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
          
        </div>
    </section>
    <!-- End Item Details -->
@push('script')
    
@endpush
    </x-layouts.layout-component>