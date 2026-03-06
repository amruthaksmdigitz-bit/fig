@extends('layouts.admin')

@section('content')
<h3>Edit Warranty</h3>

<form action="{{ route('admin.variations.update', $variation->id) }}" method="POST">
    @csrf
    @method('PUT')

   {{-- Serial Number --}}
    <div class="form-group mb-2">
        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" 
               class="form-control"
               value="{{ old('serial_number', $variation->serial_number) }}" 
               placeholder="Serial Number" required>
    </div>

   {{-- Product Dropdown --}}
    <div class="form-group mb-2">
        <label for="product_id">Select Product</label>
        <select name="product_id" id="product_id" class="form-control" required>
            <option value="">-- Select Product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" 
                    {{ old('product_id', $variation->product_id) == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

@endsection