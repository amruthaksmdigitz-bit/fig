@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h3 class="mb-0">Product Details</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $product->id }}</p>
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            
            @if($product->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail mb-3" width="150">
            @else
                <p><strong>Image:</strong> N/A</p>
            @endif

            <p><strong>Barcode:</strong> {{ $product->barcode ?? 'N/A' }}</p>
            <p><strong>Serial Number:</strong> {{ $product->serial_number ?? 'N/A' }}</p>
            <p><strong>Category:</strong> {{ $product->category?->name ?? 'N/A' }}</p>
            <p><strong>Category ID:</strong> {{ $product->product_category_id }}</p>
            <p><strong>Created At:</strong> {{ $product->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $product->updated_at }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

@endsection
