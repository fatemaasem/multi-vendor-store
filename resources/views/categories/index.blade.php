@extends('layout')

@section('title') 
Category Dashboard 
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Add Category Button -->
            <div class="col-lg-12 text-center mb-4">
                <x-alert type="success" alert="success"/>
                <x-alert type="danger" alert="error"/>

                <!-- Enhanced Search Form -->
                <form action="{{ route('categories.index') }}" method="get" class="form-inline justify-content-center mb-3">
                    <div class="form-group mr-2">
                        <label for="name" class="sr-only">Search by name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Search by name" value="{{ request('name') }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="status" class="sr-only">Select status</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="">Select status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>

                <!-- Add and Trashed Category Buttons -->
                <div>
                    <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
                    <a href="{{ route('categories.trash') }}" class="btn btn-secondary">Trashed Categories</a>
                </div>
            </div>
            <!-- /.col-lg-12 -->

            <div class="col-lg-12">
                <!-- Category Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Category Name</th>
                                <th>Product Count</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                                    <td>{{ $category->products->count() }}</td>
                                    <td>
                                        <!-- Edit Link -->
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                        </form>

                                        <!-- Show Link -->
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-primary">Show</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No categories defined</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    {{ $categories->withQueryString()->links() }}
</div>

@endsection
