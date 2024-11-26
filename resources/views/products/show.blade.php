@extends('layout')

@section('title')
Product Details
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-box-open"></i> Product Details
                    </h3>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Product Name -->
                    <h4 class="mb-3"><i class="fas fa-tag"></i> Name: {{ $product['name'] }}</h4>

                    <!-- Product Description -->
                    <p class="mb-4"><strong><i class="fas fa-align-left"></i> Description:</strong> {{ $product['description'] }}</p>

                    <!-- Product Image -->
                    @if($product['image'])
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid rounded" style="max-height: 300px;">
                        </div>
                    @else
                        <p class="text-muted"><i class="fas fa-image"></i> <em>No image available for this product.</em></p>
                    @endif

                    <!-- Store Information -->
                    @if($product['storeName'])
                        <p><i class="fas fa-store"></i> Store: 
                            <a href="{{ route('stores.show', $product['store_id']) }}" class="text-decoration-none">{{ $product['storeName'] }}</a>
                        </p>
                    @else
                        <p class="text-muted"><strong><i class="fas fa-store-alt"></i> Store:</strong> <em>No store available</em></p>
                    @endif

                    <!-- Category Information -->
                    @if($product['categoryName'])
                        <p><i class="fas fa-list-alt"></i> Category: 
                            <a href="{{ route('categories.show', $product['category_id']) }}" class="text-decoration-none">{{ $product['categoryName'] }}</a>
                        </p>
                    @else
                        <p class="text-muted"><strong><i class="fas fa-list"></i> Category:</strong> <em>No category assigned</em></p>
                    @endif

                    <!-- Back Button -->
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-4">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
