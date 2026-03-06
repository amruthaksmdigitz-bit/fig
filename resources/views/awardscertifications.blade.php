 @include('includes.header')
	<div class="breadcumb-wrapper background-image" style="background-image: url(public/uploads/{{ $banner->image}});">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Awards &amp; Certificates</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li>Awards &amp; Certificates</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="space-top space-extra2-bottom">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="page-single">
                      <h2 class="h3 page-title mb-4">{{$awardscertificationsdesc->title}}<br> <span> {{$awardscertificationsdesc->job_title}}</span></h2>
                     
                      <div class="page-content">
                     
                      <div class="page-img service-image mb-25">
                        <a href="#" href="#" target="_blank">
                        <img class="w-100" src="{{$awardscertificationsdesc->image}}" alt="Service Image"></a>
                      </div>
                          <p class="mb-30">{{$awardscertificationsdesc->description}}</p>
                          
                      </div>
                  </div>
				  
				   @foreach($awardscertifications as $value) 
                  <div class="page-single">
                    <h2 class="h3 page-title mb-4  mt-4"><span>{{$value->title}}</span></h2>
                    
                    <div class="row align-items-center">
                    <div class="col-md-6">
                      <div class="page-img service-image mb-25">
                      <a href="#" href="https://www.idemia.com/advanced-plastic-card-bodies" target="_blank">
                      <img class="w-100" src="public/uploads/{{$value->image}}" alt="Service Image"></a>
                    </div>
                    <div class="page-content">
                        <p class="mb-30">{{$value->description}}</p>
                    </div>
                    </div>
                    <div class="col-md-6">
                     <div class="page-img mb-30">
                      <img src="public/uploads/{{$value->pdf}}" alt="Service Image">
                    </div>
                    </div>
                </div>
                </div>
                
				 @endforeach
				
              </div>
            </div>
          </div>
    </section>



 
@include('includes.footer')  