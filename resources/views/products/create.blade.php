@extends('layout')

@section('title')
Add products
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for form protection -->
                        
                        @include('products._form',['stores','categories'])
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Add product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
