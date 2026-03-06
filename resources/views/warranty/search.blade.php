@extends('layouts.main')

@section('content')
<style>
    .card {
        padding: 30px;
        margin: 30px 0;
    }
    .card-custom-border {
             border: 2px solid #794E2B !important;
        }
.borderbottom
{
    margin-bottom:75px;
}


   

  
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


              <section id="contact" class="contact section py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="form-box shadow-lg p-4 rounded-4 bg-white" data-aos="fade-up" data-aos-delay="200">
          <h2 class="text-center mb-4 fw-bold ">Search Warranty</h2>

            <form action="{{ route('warranty.search.form') }}" method="GET">
                <div class="mb-3">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control"
                           placeholder="Enter Serial Number">
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                           placeholder="Enter Phone Number">
                </div>

                <div class="mb-3">
                    <label for="vehicle_number" class="form-label">Vehicle Number</label>
                    <input type="text" name="vehicle_number" id="vehicle_number" class="form-control"
                           placeholder="Enter Vehicle Number">
                </div>

                <div class="mb-3">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" name="barcode" id="barcode" class="form-control"
                           placeholder="Enter Barcode">
                </div>

                <button type="submit" class="btn btn-success">Search</button>
            </form>
           </div>
      </div>
    </div>
  </div>
</section>


    {{-- Search Results --}}
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
                Serial: {{ $warranty->serial_number }}
            </h5>

            <p class="d-flex justify-content-between fs-5 mb-3">
                <span><strong>📞 Phone</strong></span>
                <span>{{ $warranty->phone_number }}</span>
            </p>

            <p class="d-flex justify-content-between fs-5 mb-3">
                <span><strong>🚘 Vehicle</strong></span>
                <span>{{ $warranty->vehicle_number }}</span>
            </p>

            <p class="d-flex justify-content-between fs-5 mb-3">
                <span><strong>🏠 Address</strong></span>
                <span>{{ $warranty->address }}</span>
            </p>

            <p class="d-flex justify-content-between fs-5 mb-0">
                <span><strong>⏳ Expiry Date</strong></span>
                <span class="fw-bold text-danger">{{ $warranty->expiry_date }}</span>
            </p>
        </div>
    </div>
</div>

                        @endforeach
                    </div>
                @else
                    <p class="text-center text-danger fw-semibold mb-0">❌ No results found.</p>
                @endif

            </div>
        </div>
    </div>
@endif

</div>
@endsection
