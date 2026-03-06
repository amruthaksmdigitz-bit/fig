@extends('layouts.main')
<style>
    .card {
        padding: 50px;
        margin: 50px;
    }
    .warranty-label {
        font-weight: 600;
        color: #333;
    }
    .warranty-row {
        margin-bottom: 1rem;
    }
</style>

@section('content')
<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
    <div class="container-fluid page-header-inner py-8">
        <div class="container text-center pb-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Search Warranty</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Search Warranty</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white fw-bold">
        Warranty Details
    </div>
    <div class="card-body">
        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Customer Name:</label>
                <div>{{ $warranty->customer_name }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Dealer Name:</label>
                <div>{{ $warranty->dealer_name }}</div>
            </div>
        </div>

        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Dealer Phone Number:</label>
                <div>{{ $warranty->dealer_phone_number }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Area:</label>
                <div>{{ $warranty->area }}</div>
            </div>
        </div>

        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Body Parts:</label>
                <div>{{ $warranty->body_parts }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Email:</label>
                <div>{{ $warranty->email }}</div>
            </div>
        </div>

        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Product ID:</label>
                <div>{{ $warranty->product_id }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Serial Number:</label>
                <div>{{ $warranty->serial_number }}</div>
            </div>
        </div>

        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Phone Number:</label>
                <div>{{ $warranty->phone_number }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Vehicle Number:</label>
                <div>{{ $warranty->vehicle_number }}</div>
            </div>
        </div>

        <div class="row warranty-row">
            <div class="col-md-6">
                <label class="warranty-label">Address:</label>
                <div>{{ $warranty->address }}</div>
            </div>
            <div class="col-md-6">
                <label class="warranty-label">Expiry Date:</label>
                <div>{{ $warranty->expiry_date }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
