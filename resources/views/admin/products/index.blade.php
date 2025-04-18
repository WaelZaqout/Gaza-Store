
@extends('admin.master')
@section('title', 'All Products')
@section('content')

@if (session()->has('msg'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-4 text-gray-800">All Products</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<table class="table table-bordered table-hover text-center align-middle">
    <thead class="bg-dark text-white">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name </th>
            <th>Price</th>
            <th>Total Quantity</th>
            <th>Options (Size - Color - Qty)</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img width="80" src="{{ $product->img_path }}" alt=""></td>
                <td>
                    <strong>{{ $product->trans_name }}</strong><br>
                </td>
                <td>${{ number_format($product->price, 2) }}</td>
                <td>{{ $product->variants->sum('quantity') }}</td>

                {{-- عرض الحجم واللون والكمية لكل خيار --}}
                <td>
                    @forelse($product->variants as $variant)
                        <span class="badge bg-info text-dark mb-1">
                            {{ $variant->size }} - {{ $variant->color }} ({{ $variant->quantity }})
                        </span><br>
                    @empty
                        <span class="text-muted">No Variants</span>
                    @endforelse
                </td>

                <td>{{ $product->category->trans_name }}</td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.products.edit', $product->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="d-inline" method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $products->links() }}
@endsection
