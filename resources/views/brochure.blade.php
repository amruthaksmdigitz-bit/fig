@include('includes.header')
 <style>
 @media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
.borchure_pad
{
	border: 1px solid var(--border-color);
    padding: 20px;
	margin-left: 20px;
    width: 265px;
}
.a_tag
{
	margin-left: 50px !important;
   
    color: white !important;
	
}
</style> 
 <main class="main__content_wrapper">
         <?php $servername= request()->getHttpHost();
			$brochurebanner = 'http://'.$servername.'/public/uploads/'.$brochure_banner->image;						
						?>
        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg" style="background: url({{$brochurebanner}});background-repeat: no-repeat;background-size: cover;">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Brochure</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Brochure</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start blog section -->
        <section class="blog__section section--padding">
            <div class="container">
                <div class="section__heading text-center mb-50">
                    <h2 class="section__heading--maintitle">Brochure</h2>
                </div>
				
				<div class="row">   
   <div class="col-xl-3 col-lg-4">                      
   <div class="shop__sidebar--widget widget__area d-lg-block">                            
   <div class="single__widget widget__bg">                                
   <h2 class="widget__title h3">Brands</h2>                              
   
   
					 <ul class="widget__categories--menu">                                                                                  
					 
					 @foreach ($product_brands as $values)         

<?php $servername= request()->getHttpHost();
									
	$categoryimage = 'http://'.$servername.'/public/uploads/brands.png';?>
    
<li class="widget__categories--menu__list">          
    <a class="widget__categories--sub__menu--link d-flex align-items-center" href="{{route('home.productbrandsbrochure', ['id' => $values->id])}}">   
	<img class="widget__categories--sub__menu--img" src="{{$categoryimage}}" alt="categories-img">  
	<span class="widget__categories--sub__menu--text">{{$values->name}}</span>   
	</a>                                          
	</li>                                       
	@endforeach                                                      
	
</ul>

 </div>  
  </div>                    
  </div>    <div class="col-xl-9 col-lg-8">   
                <div class="blog__section--inner">
                    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-sm-u-2 row-cols-1 mb--n30">
                          @foreach($brochure as $value)
                        
                          <?php $servername= request()->getHttpHost();
							$brochureimage = 'http://'.$servername.'/public/uploads/'.$value->image;						
						    $brochurepdf = 'http://'.$servername.'/public/uploads/'.$value->pdf;						
						
						?>
						<div class="col-md-3 mb-30 borchure_pad">
                            <div class="blog__items">
                                <div class="blog__thumbnail">
                                    <a class="blog__thumbnail--link"><img class="blog__thumbnail--img" src="{{$brochureimage}}" alt="blog-img"></a>
                                </div>
                                <div class="blog__content">
                                  
                                    <h3 class="blog__content--title">{{$value->title}}</h3>
                                    <a class="blog__content--btn primary__btn a_tag" target="blank" href="{{$brochurepdf}}">Download</a>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>
                   
                </div>
				</div>
				</div>
            </div>
        </section>
        <!-- End blog section -->

        <!-- End shipping section -->
    </main>
	
	 @include('includes.footer')