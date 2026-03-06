@extends('layouts.admin')

@section('content')
<h3>Edit Warranty</h3>

<form action="{{ route('admin.warranty.update', $warranty->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="serial_number" class="form-control mb-2" 
           value="{{ old('serial_number', $warranty->serial_number) }}" placeholder="Serial Number">

    <input type="text" name="phone_number" class="form-control mb-2" 
           value="{{ old('phone_number', $warranty->phone_number) }}" placeholder="Phone Number">

    <input type="text" name="vehicle_number" class="form-control mb-2" 

@endsection