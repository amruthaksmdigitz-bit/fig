@extends('layouts.admin')

@section('content')
<h3>Add Variations</h3>
<form action="{{ route('admin.variations.store') }}" method="POST">
    @csrf
   <div class="form-group mb-2">
        <label for="serial_number">Serial Number</label>
        <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Serial Number" required>
    </div>
    
     {{-- Product Dropdown --}}
    <div class="form-group mb-2">
        <label for="product_id">Select Product</label>
        <select name="product_id" id="product_id" class="form-control" required>
            <option value="">-- Select Product --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
