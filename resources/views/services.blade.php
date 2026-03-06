
 @include('includes.header')

 
 
 
	<div class="breadcumb-wrapper background-image" style="background-image: url(public/uploads/{{ $banner->image}});">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Services</h1>
                <ul class="breadcumb-menu">
                    <li><a href="#">Home</a></li>
                    <li>Services</li>
                </ul>
            </div>
        </div>
    </div>

   @foreach($services as $value) 

<section class="space" id="{{$value->title}}">
        <div class="container">
        <div class="row align-items-center {{ $loop->iteration % 2 == 0 ? 'flex-row-reverse' : '' }}">
                <div class="col-xl-6">
                    <div class="pe-xl-4 mt-40 mt-xl-0">
                        <div class="rounded-20"><img class="w-100" src="public/uploads/{{ $value->image}}"
                                alt="Achive"></div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="title-area mb-35 text-center text-xl-start"><span
                            class="sub-title6 justify-content-xl-start justify-content-center"><span
                                class="shape left d-xl-none"><span class="dots"></span></span>Service <span
                                class="shape right"><span class="dots"></span></span></span>
                        <h2 class="sec-title">{{$value->title}}</h2>
                    </div>
                    <p class="mt-n2 mb-35 text-center text-xl-start">{{$value->description}}</p>
                    
                </div>
             
            </div>
        </div>
    </section>

 @endforeach

  
 @include('includes.footer') 