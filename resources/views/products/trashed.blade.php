@extends('layout')

@section('title') Trashed Products @endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Search Form and Back Button -->
            <div class="col-lg-12 text-center mb-4">
           
                <!-- Alerts -->
                <x-alert type="success" alert="success"/>
                <x-alert type="danger" alert="error"/>

                <!-- Enhanced Search Form -->
                <form action="{{ route('products.trashed') }}" method="get" class="form-row justify-content-center mb-4">
                    <!-- Username filter -->
                    <div class="col-md-4 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Search by username" aria-label="Username" aria-describedby="inputGroup-sizing-default" value="{{ request('username') }}">
                        </div>
                    </div>

                    <!-- Status filter -->
                    <div class="col-md-3 mb-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="statusSelect">
                                    <i class="fas fa-filter"></i>
                                </label>
                            </div>
                            <select class="custom-select" name="status" id="statusSelect">
                                <option value="">Select status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search button -->
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </form>

                <!-- Back Button -->
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>

            <!-- /.col-lg-12 -->

            <div class="col-lg-12">
                <!-- Bootstrap Table for Products -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <!-- Product Name -->
                                <td><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                                
                                <!-- Product Status -->
                                <td>{{ $product->status }}</td>
                                
                                <!-- Actions -->
                                <td>
                                    <!-- Restore button -->
                                    <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            Restore
                                        </button>
                                    </form>

                                    <!-- Force Delete Form -->
                                    <form action="{{ route('products.forceDelete', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to permanently delete this item?');">
                                            Delete
                                        </button>
                                    </form>

                                   
                                    
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No products found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center">
    {{ $products->withQueryString()->links() }}
</div>

@endsection
