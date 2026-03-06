@extends('layouts.main')
 
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
@section('content')
<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-8">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">2Year Protection Plan</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">2Year Protection Plan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>



    
  
              <section id="contact" class="contact section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="form-box shadow-lg p-4 rounded-4 bg-white" data-aos="fade-up" data-aos-delay="200">
          <h2 class="text-center mb-4 fw-bold ">Renew Your Warranty</h2>  
    
    
    
    
  <form action="{{ route('warranty.renewal') }}" method="GET">
      <div class="mb-3">
        <label for="serial_number" class="form-label">Serial Number</label>
        <input
          type="text"
          name="serial_number"
          id="serial_number"
          class="form-control"
          placeholder="Enter Serial Number"
        />
      </div>

      <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input
          type="text"
          name="phone_number"
          id="phone_number"
          class="form-control"
          placeholder="Enter Phone Number"
        />
      </div>

      <div class="mb-3">
        <label for="vehicle_number" class="form-label">Vehicle Number</label>
        <input
          type="text"
          name="vehicle_number"
          id="vehicle_number"
          class="form-control"
          placeholder="Enter Vehicle Number"
        />
      </div>

      <div class="mb-3">
        <label for="barcode" class="form-label">Barcode</label>
        <input
          type="text"
          name="barcode"
          id="barcode"
          class="form-control"
          placeholder="Enter Barcode"
        />
      </div>

      <button type="submit" class="btn btn-success">Search</button>
    </form>
 </div>
      </div>
    </div>
  </div>
</section>




 @if($searched)
   <div class="mt-5 row justify-content-center">
        <div class="col-lg-7">
            <div class="form-box shadow-lg p-4 rounded-4 bg-white" data-aos="fade-up" data-aos-delay="200">
                
                <h3 class="text-center mb-4 fw-bold">Search Results</h3>
    @if($results->isNotEmpty())
   <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
        @foreach($results as $warranty)
             <div class="col-12 col-md-8 col-lg-6 d-flex justify-content-center">
    <div class="card  border-0 rounded-4 w-100" style="max-width: 600px;">
        <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-success mb-4 text-center">
      {{ $warranty->product_name ?? 'Product' }}
    </h5>

    <p class="d-flex justify-content-between fs-5 mb-3">
      <span><strong>🔑 Serial</strong></span>
      <span>{{ $warranty->serial_number }}</span>
    </p>

    <p class="d-flex justify-content-between fs-5 mb-3">
      <span><strong>🏷️ Barcode</strong></span>
      <span>{{ $warranty->barcode }}</span>
    </p>

    <p class="d-flex justify-content-between fs-5 mb-3">
      <span><strong>📞 Phone</strong></span>
      <span>{{ $warranty->phone_number }}</span>
    </p>

    <p class="d-flex justify-content-between fs-5 mb-3">
      <span><strong>🚘 Vehicle</strong></span>
      <span>{{ $warranty->vehicle_number }}</span>
    </p>

    <p class="d-flex justify-content-between fs-5 mb-0">
      <span><strong>⏳ Warranty Upto</strong></span>
      <span class="fw-bold text-danger">{{ $warranty->warranty_reg_upto ?? 'Not Set' }}</span>
    </p><br/>

                        {{-- Extend Warranty button --}}
                        <button type="button" class="btn btn-success extend-btn" data-id="{{ $warranty->id }}">
                            Extend Warranty
                        </button><br/><br/>

{{-- Extend form (hidden by default) --}}
<form method="POST" 
      action="{{ route('warranty.extend.submit', $warranty->id) }}" 
      class="mt-3 extend-form" 
      id="extend-form-{{ $warranty->id }}" 
      style="display: none;">
    @csrf
    
    <div class="mb-3">
        <label for="warranty_reg_upto_{{ $warranty->id }}" class="form-label">
            ⏳ Warranty Upto
        </label>
        <input type="date" 
               id="warranty_reg_upto_{{ $warranty->id }}"
               name="warranty_reg_upto" 
               class="form-control" 
               value="{{ old('warranty_reg_upto', $warranty->warranty_reg_upto) }}">
    </div>

    <button type="submit" class="btn btn-primary w-100">
        ✅ Update Warranty
    </button>
</form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
@endif
</div>
</div></div>
@endsection	
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(".extend-btn").on("click", function () {
        let id = $(this).data("id");
        $("#extend-form-" + id).slideToggle(); // toggle show/hide with animation
    });
});
</script>
