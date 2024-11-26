@extends('layout')

@section('title') 
Trashed Category 
@endsection

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- Search and Navigation Buttons -->
            <div class="col-lg-12 text-center mb-4">
                <x-alert type="success" alert="success"/>
                <x-alert type="danger" alert="error"/>

                <!-- Enhanced Search Form -->
                <form action="{{ route('categories.trash') }}" method="get" class="form-inline justify-content-center mb-3">
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

                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
            </div>
            <!-- /.col-lg-12 -->

            <div class="col-lg-12">
                <!-- Trashed Category Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                                    <td>
                                        <!-- Restore Link -->
                                        <form action="{{ route('categories.restore', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT') <!-- Spoofing the PUT method -->
                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                        </form>
                                        
                                        <!-- Delete Form -->
                                        <form action="{{ route('categories.forceDelete', $category->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to permanently delete this category?');">Delete</button>
                                        </form>

                                      
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No trashed categories found</td>
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
