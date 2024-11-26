@extends('layout')

@section('title')
Edit categories
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf <!-- CSRF token for form protection -->
                        @method('PUT')
                        @include('categories._form',['category','parents'])
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Edit Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
