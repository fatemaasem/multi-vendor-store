<x-layouts.layout-component title="Home">
    <div class="container mt-5">
        <div class="row">
            <!-- Billing and Shipping Details -->
            <div class="col-md-12 mb-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h5>Checkout Details</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf

                            <!-- Billing Details -->
                            <h6>Billing Details</h6>
                            <div class="mb-3">
                                <label for="billingName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="billingName" name="address[billing][full_name]" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="billingAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="billingAddress" name="address[billing][address]" placeholder="Enter your address" required>
                            </div>
                            <div class="mb-3">
                                <label for="billingCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="billingCity" name="address[billing][city]" placeholder="Enter your city" required>
                            </div>
                            <div class="mb-3">
                                <label for="billingPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="billingPhone" name="address[billing][phone]" placeholder="Enter your phone number" required>
                            </div>

                            <hr class="my-4">
                            
                            <!-- Shipping Details -->
                            <h6>Shipping Details</h6>
                            <div class="mb-3">
                                <label for="shippingName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="shippingName" name="address[shipping][full_name]" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="shippingAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="shippingAddress" name="address[shipping][address]" placeholder="Enter your address" required>
                            </div>
                            <div class="mb-3">
                                <label for="shippingCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="shippingCity" name="address[shipping][city]" placeholder="Enter your city" required>
                            </div>
                            <div class="mb-3">
                                <label for="shippingPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="shippingPhone" name="address[shipping][phone]" placeholder="Enter your phone number" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-success text-white text-center">
                        <h5>Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center total-price">
                                <span>Total Price</span>
                                <span class="fw-bold">$100.00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.layout-component>
