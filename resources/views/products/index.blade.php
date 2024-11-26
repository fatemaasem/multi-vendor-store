@extends('layout')

@section('title') Product Dashboard @endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Add product Button -->
            <div class="col-lg-12 text-center mb-4">

            <x-alert type="success" alert="success"/>
            <x-alert type="danger" alert="error"/>

            <!-- Enhanced Search form -->
            <form action="{{ route('products.index') }}" method="get" class="form-row justify-content-center">
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
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
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

            <!-- Add and Trashed product buttons -->
            <div class="mt-3">
                <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>
                <a href="{{ route('products.trashed') }}" class="btn btn-secondary">Trashed Products</a>
            </div>
            </div>

            <!-- /.col-lg-12 -->

            <div class="col-lg-12">
                <!-- Bootstrap table -->
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
                                <td><a href="{{route('products.show', $product->id)}}">{{ $product->name }}</a></td>
                                <td>{{ $product->status }}</td>
                                <td>
                                    <!-- Edit link -->
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                                    
                                    <!-- Delete form -->
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                    </form>

                                    <!-- Show link -->
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-primary">Show</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No products defined</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Pagination links -->
<div class="d-flex justify-content-center">
    {{ $products->withQueryString()->links() }}
</div>

@endsection
