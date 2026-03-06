 
   @extends('layouts.main')


@section('content')
   <!--HEADER SECTION HERE-->
   
 <div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Portfolio</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Portfolio</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>




	<section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <div><span>Check Our</span> <span class="description-title">Portfolio</span></div>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">
 @foreach($gallery as $gallery)
          <div class="col-lg-4 col-md-4">
            <div class="gallery-item">
              <a href="{{ asset($gallery->image) }}" class="glightbox" data-gallery="images-gallery">
                <img src="{{ asset( $gallery->image) }}" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->
 @endforeach
        </div>

      </div>

    </section><!-- /Gallery Section -->

@endsection