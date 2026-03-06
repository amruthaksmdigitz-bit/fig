 
   @extends('layouts.main')


@section('content')
   <!--HEADER SECTION HERE-->
 <style>
 .facilities-box h5 {
    font-size: 31px !important;
    color: #e81a20;
    line-height: 40px;
    text-transform: uppercase;
}
</style>  
 





    <header>
        <div class="container-fluid no-padding" data-scrollreveal="enter top over 3s after 0.5s">


            <div class="banner-menu">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                <a href="index.html" class="hvr-grow"><img src="{{ asset('uploads/' . $logo->image) }}" alt="mscbank-mattanchery"></a>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 logo">
                                <h1>THE Mattancherry<br>
                                    SARVAJANIK CO-OPERATIVE BANK LTD</h1>
                                <h2>(RBI licensed Urban Bank) </h2>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 logo">
                                <a href="https://www.dicgc.org.in/" target="_blank" class="hvr-grow"><img src="images/digg.png" alt="DICGC approved urban bank kerala"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 call-to">

                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                <a href="https://mscub.com/ppsform/"><b>POSITIVE PAY SYSTEM (PPS)</b></a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                                <h3>Email:</h3> 
                                <a href="mailto:{{$email->title}}?subject=Mail from MSC Site">{{$email->title}}</a>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <h3>Phone:</h3> <a href="tel:{{$phone->phone1}}">{{$phone->phone1}}</a>, <a
                                    href="tel:{{$phone->phone2}}">{{$phone->phone2}}</a>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <nav class="mobile-menu">
                                    <label for="show-menu" class="show-menu"><span>Menu</span>
                                        <div class="lines"></div>
                                    </label>
                                    <input type="checkbox" id="show-menu">
                                    <ul id="menu">
                                        <li><a href="{{route('home.index')}}" >Home</a></li>
                                        <li><a href="{{route('home.about')}}">About</a></li>
                                        <li><a href="{{route('home.management')}}">Management</a></li>
                                        <li><a href="{{route('home.facilities')}}">facilities</a></li>
                                        <li><a href="{{route('home.gallery')}}" class="active">gallery</a></li>
                                        <li><a href="{{route('home.downloads')}}">downloads</a></li>
                                        <li><a href="{{route('home.contact')}}">contact</a></li>
                                    </ul>
                                </nav>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="inner-banner" data-scrollreveal="enter top over 3s after 0.5s">
                <img src="images/inner-banner.jpg" alt="mattanchery sarvajanik">
                <div class="inner-banner-hea">
                <h1>Facilities</h1>
                <ul>
                    <li>HOME / <a href="">Facilities</a></li>
                </ul>
            </div>
            </div>
       
        </div>
    </header>
    <!--SECTION HERE-->

     <!--FACILITES SECTION HERE-->
     <section>
        <div class="custome-fluid">
            <div class="facilities-box" data-scrollreveal="enter top over 3s after 0.5s">
			
			<div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 welcome-left">
                        <h4>Exploring our</h4>
                        <h5>Facilities..</h5>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 welcome-left">
                        <p>MSC Bank Offers you..</p>
                    </div>
                   
                </div>
			
			
				
						
				
                <div class="facilities-item " data-scrollreveal="enter top over 3s after 0.5s">
                    <div class="row">

                                    @foreach ($facilities as $key => $item)
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 facilities-pic-space facilities-boxx">
                        @if (!empty($item->job_title))
                            <a href="#popup{{ $key }}" class="hvr-float">
                                <img src="{{ asset('uploads/' . $item->image) }}" alt="best crop loan banks">
                            </a>
                            <h6>
                                <a href="#popup{{ $key }}" class="hvr-float">{{ $item->title }}</a>
                            </h6>

                            <!-- Popup -->
                            <div id="popup{{ $key }}" class="overlay">
                                <div class="popup fac-cont">
                                    <h2>{{ $item->job_title }}</h2>
                                    {!! $item->description !!}
                                    <a class="close" href="#">&times;</a>
                                </div>
                            </div>
                        @else
                            <a href="javascript:void(0);" class="hvr-float">
                                <img src="{{ asset('uploads/' . $item->image) }}" alt="best crop loan banks">
                            </a>
                            <h6>
                                <a href="javascript:void(0);" class="hvr-float">{{ $item->title }}</a>
                            </h6>
                        @endif
                    </div>
                @endforeach
   
                            
                            
                            
                        
                        </div></div>  
						
						
						</div>
						
            
            </div>
    </section>
 
@endsection