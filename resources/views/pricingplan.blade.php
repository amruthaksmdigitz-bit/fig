
 @include('includes.header')

     
        <section class="page-header padding" style="background-image: url(public/uploads/{{ $pricing_plan_banner->image}});">
            <div class="container">
                <div class="page-content text-center">
                    <h2>{{ $pricing_plan_banner->title}}</h2>
                    <p>{{ $pricing_plan_banner->description}}</p>
                </div>
            </div>
        </section><!-- /.page-header -->

  <section class="pricing-section padding">
            <div class="container">
                <div class="row">
				 @foreach ($planing_rate as $value) 
                    <div class="col-lg-4 col-sm-6 sm-padding">
                        <div class="pricing-item">
                            <div class="pricing-head">
                                <h2><span>{{ $value->title}}</span>{{ $value->feature1}}</h2>
                                <svg viewBox="0 0 1920 479.1">
                                <path class="st0" fill="#fff" d="M1562.5,260.9c-284.2,92.3-282.6,324-778.9,108.7C304.8,161.9,19.5,335.7,0,348.3v120.8v10h1920v-10V0
                                C1715.4,15.3,1846.7,168.6,1562.5,260.9z"></path>
                                </svg>
                            </div>
                            <ul class="pricing-list">
								 @foreach ($plans as $value) 
                                <li><i class="fa fa-check"></i>{{ $value->title}}</li>
                                @endforeach
                            </ul>
                            <div class="pricing-footer">
                                <a href="#" class="default-btn">Book Plan Now <span></span></a>
                            </div>
                        </div>
                    </div>
          @endforeach
                </div>
            </div>
        </section><!-- /.pricing-section -->
       <section class="cta-section padding"style="background-image: url(public/uploads/{{ $appoinment_background->image}});" >
            <svg viewBox="0 0 1920 479.1">
            <path class="st0" fill="#f9fafa" d="M1562.5,260.9c-284.2,92.3-282.6,324-778.9,108.7C304.8,161.9,19.5,335.7,0,348.3v120.8v10h1920v-10V0
            C1715.4,15.3,1846.7,168.6,1562.5,260.9z"></path>
            </svg>
            <div class="container">
                <div class="cta-content">
                   <img class="wow fadeInUp" data-wow-delay="0" src="public/uploads/{{ $appoinment->image}}" alt="icon">
                    <h2 class="wow fadeInUp" data-wow-delay="300ms">{{ $appoinment->title}}</h2>
                    <p class="wow fadeInUp" data-wow-delay="400ms">{{ $appoinment->description}}</p>
                    <a href="#" class="default-btn wow fadeInUp" data-wow-delay="500ms">Make An Appointment<span></span></a>
                </div>
            </div>
        </section><!-- /.cta-section -->

     @include('includes.footer')