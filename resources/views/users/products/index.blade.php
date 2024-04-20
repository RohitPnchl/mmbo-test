@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between">
        <h4>Products</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $key => $product)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ asset('storage/'.$product->image) }}" alt="" height="50px">
                        </td>
                        <td>{{ \Str::limit($product->description, 50) }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('products.delete', $product->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="if (confirm('Are you sure you want to delete this product?')) { this.form.submit(); }">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No record found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection