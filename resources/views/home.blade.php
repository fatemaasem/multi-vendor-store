
<x-layouts.layout-component title="home" :categories="$categories">
     

    <!-- Start Trending Product Area -->
    <section class="trending-product section" style="margin-top: 12px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Products</h2>
                      
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{asset('storage/'.$product->image) }}" height="300px" class="img" alt="x">
                            <div class="button">
                                <a href="{{route('user.product_details',$product['slug'])}}" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                        <div class="product-info">
                           
                            <h4 class="title">
                                <a href="product-grids.html">{{$product['description']}}</a>
                            </h4>
                            <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="l
                                ni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star"></i></li>
                                <li><span>4.0 Review(s)</span></li>
                            </ul>
                            <div class="price">
                            <span class="price-currency product-price" data-price="{{ $product['price'] }}">
                                {{ session('rate')? session('rate') * $product['price'] : $product['price'] }}
                            </span>
                                                            <!-- @if (session('currency'))
                                <span class="price-currency">{{(float)(App\Services\CurrencyService::convert('EGP', session('currency')) *  $product['price'] )}}</span>
                                @else
                                <span >{{ $product['price']}}</span>
                                @endif
                                -->
                                <span class="symple-currency">{{session('currency')??"EGP"}}</span> 
                            </div>
                            <div class="quantity d-flex align-items-center gap-2 p-2 border rounded bg-light">
                                <span class="fw-bold text-muted">Available Quantity:</span>
                                <span class="badge bg-primary fs-6">{{ $product['quantity'] }}</span>
                            </div>

                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
               
             @endforeach
                
                
               
               
            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    

    <!-- Start Shipping Info -->
    <section class="shipping-info">
        <div class="container">
            <ul>
                <!-- Free Shipping -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-delivery"></i>
                    </div>
                    <div class="media-body">
                        <h5>Free Shipping</h5>
                        <span>On order over $99</span>
                    </div>
                </li>
                <!-- Money Return -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-support"></i>
                    </div>
                    <div class="media-body">
                        <h5>24/7 Support.</h5>
                        <span>Live Chat Or Call.</span>
                    </div>
                </li>
                <!-- Support 24/7 -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="media-body">
                        <h5>Online Payment.</h5>
                        <span>Secure Payment Services.</span>
                    </div>
                </li>
                <!-- Safe Payment -->
                <li>
                    <div class="media-icon">
                        <i class="lni lni-reload"></i>
                    </div>
                    <div class="media-body">
                        <h5>Easy Return.</h5>
                        <span>Hassle Free Shopping.</span>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <!-- End Shipping Info -->
@push('script')
<script type="text/javascript">
        //========= Hero Slider 
        tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });

        //======== Brand Slider
        tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });
    </script>
@endpush
  
</x-layouts.layout-component>