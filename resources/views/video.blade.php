
 @include('includes.header')
      
		<style>
.mobile_whatsapp
{
	display:none;
}
</style>	
	<style>
.portfolio__items--thumbnail::before {
	background:none;
	
}	
@media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
	   </style>
 <main class="main__content_wrapper">                <!-- Start breadcrumb section -->        <section class="breadcrumb__section breadcrumb__bg"style="background: url(public/uploads/{{$gallerybanner->image}});background-repeat: no-repeat;background-size: cover;">            <div class="container">                <div class="row row-cols-1">                    <div class="col">                        <div class="breadcrumb__content text-center">                            <h1 class="breadcrumb__content--title text-white mb-25">Portfolio Video</h1>                            <ul class="breadcrumb__content--menu d-flex justify-content-center">                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>                                <li class="breadcrumb__content--menu__items"><span class="text-white">Portfolio</span></li>                            </ul>                        </div>                    </div>                </div>            </div>        </section>        <!-- End breadcrumb section -->        <!-- Start portfolio section -->        <section class="portfolio__section section--padding">            <div class="container">                <div class="section__heading text-center mb-40">                    <h2 class="section__heading--maintitle">Watch Our Portfolio</h2>                </div>                <div class="portfolio__section--inner">                    <div class="row row-cols-lg-3 row-cols-md-3 row-cols-sm-2 row-cols-2 mb--n30">										@foreach($videos as $value)					                        <div class="col-md-3 mb-30">                            <div class="portfolio__items">                                <div class="portfolio__items--thumbnail position__relative">    <a class="portfolio__items--thumbnail__link glightbox"  data-gallery="portfolio"><iframe class="card-img-top" src="https://www.youtube.com/embed/{{$value->title}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>                                                                       </a>                                </div>                            </div>                        </div>                        @endforeach                    </div>                </div>            </div>        </section>        <!-- End portfolio section -->        <!-- Start brand logo section -->   <div class="brand__logo--section bg__secondary section--padding">            <div class="container-fluid">                <div class="row row-cols-1">                    <div class="col">                        <div class="brand__logo--section__inner d-flex justify-content-center align-items-center">                         @foreach($fashionbrands as $value)						 <div class="brand__logo--items">                                <img class="brand__logo--items__thumbnail--img display-block" width="150"  src="public/uploads/{{$value->image}}" alt="brand logo">                            </div>                          @endforeach                        </div>                    </div>                </div>            </div>        </div>        <!-- End brand logo section -->         </main>
     @include('includes.footer')