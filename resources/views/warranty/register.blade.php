@extends('layouts.main')

@section('content')
<style>
  .form-box {
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
  }
  .form-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
  }
  .form-label {
    color: #333;
  }
  .btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    border: none;
    transition: all 0.3s ease;
  }
  .btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #003f88);
    transform: scale(1.05);
  }
</style>

<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
  <div class="container-fluid page-header-inner py-8">
    <div class="container text-center pb-5">
      <h1 class="display-3 text-white mb-3 animated slideInDown">Warranty Registration</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center text-uppercase">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Pages</a></li>
          <li class="breadcrumb-item text-white active" aria-current="page">Warranty Registration</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<section id="contact" class="contact section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="form-box shadow-lg p-4 rounded-4 bg-white" data-aos="fade-up" data-aos-delay="200">
          <h2 class="text-center mb-4 fw-bold">Warranty Registration</h2>

          <form action="#" method="POST" class="php-email-form">
            @csrf

            <div class="row">
              <!-- Product -->
              <div class="col-md-6 mb-3">
                <label for="product_val" class="form-label fw-semibold">Select Product</label>
                <select name="product_val" id="product_val" class="form-select" disabled>
                  <option value="">-- Select Product --</option>
                  @foreach ($products as $value)
                    <option value="{{ $value->id }}" 
                      @if($value->name == 'Veloskin PPF') selected @endif>
                      {{ $value->name }}
                    </option>
                  @endforeach
                </select>
              </div>

              <!-- Hidden Product ID -->
              <input type="hidden" name="product_id" id="product_id">

              <!-- Serial Number -->
              <div class="col-md-6 mb-3">
                <label for="serial_number" class="form-label fw-semibold">Serial Number</label>
                <input type="text" name="serial_number" id="serial_number" class="form-control" placeholder="Enter Serial Number" required>
              </div>
            </div>

            <div class="row">
              <!-- Dealer Name -->
              <div class="col-md-6 mb-3">
                <label for="dealer_name" class="form-label fw-semibold">Dealer Name</label>
                <input type="text" name="dealer_name" id="dealer_name" class="form-control" placeholder="Dealer Name" required>
              </div>

              <!-- Dealer Phone -->
              <div class="col-md-6 mb-3">
                <label for="dealer_phone_number" class="form-label fw-semibold">Dealer Phone Number</label>
                <input type="text" name="dealer_phone_number" id="dealer_phone_number" class="form-control" placeholder="Dealer Phone Number" required>
              </div>
            </div>

            <div class="row">
              <!-- Customer Name -->
              <div class="col-md-6 mb-3">
                <label for="customer_name" class="form-label fw-semibold">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Customer Name" required>
              </div>

              <!-- Area -->
              <div class="col-md-6 mb-3">
                <label for="area" class="form-label fw-semibold">Area</label>
                <input type="text" name="area" id="area" class="form-control" placeholder="Area" required>
              </div>
            </div>

            <div class="row">
              <!-- Body Parts -->
              <div class="col-md-6 mb-3">
                <label for="body_parts" class="form-label fw-semibold">Body Parts</label>
                <input type="text" name="body_parts" id="body_parts" class="form-control" placeholder="Body Parts">
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label fw-semibold">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
              </div>
            </div>

            <div class="row">
              <!-- Vehicle Number -->
              <div class="col-md-6 mb-3">
                <label for="vehicle_number" class="form-label fw-semibold">Vehicle Number</label>
                <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" placeholder="Enter Vehicle Number" required>
              </div>

              <!-- Phone Number -->
              <div class="col-md-6 mb-3">
                <label for="phone_number" class="form-label fw-semibold">Phone Number</label>
                <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number" required>
              </div>
            </div>

            <div class="row">
              <!-- Address -->
              <div class="col-md-6 mb-3">
                <label for="address" class="form-label fw-semibold">Address</label>
                <textarea name="address" id="address" rows="3" class="form-control" placeholder="Enter Address" required></textarea>
              </div>

              <!-- Expiry Date -->
              <div class="col-md-6 mb-3">
                <label for="expiry_date" class="form-label fw-semibold">Purchase Date / To Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
              </div>
            </div>

            <!-- Button -->
            <div class="text-center">
              <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill fw-semibold shadow-sm">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('#product_id').val($('#product_val').val());

    if ($('#product_val').val()) {
      $('#product_id').val($('#product_val').val());
    }
  });
</script>
