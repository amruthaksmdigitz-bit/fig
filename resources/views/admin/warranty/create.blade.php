@extends('layouts.admin')

@section('content')
<h3>Add Warranty</h3>
<form action="{{ route('admin.warranty.store') }}" method="POST">
    @csrf
    <input type="text" name="serial_number" class="form-control mb-2" placeholder="Serial Number">
    <input type="text" name="phone_number" class="form-control mb-2" placeholder="Phone Number">
    <input type="text" name="vehicle_number" class="form-control mb-2" placeholder="Vehicle Number">
    <input type="text" name="address" class="form-control mb-2" placeholder="Address">
    <input type="date" name="expiry_date" class="form-control mb-2">
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
