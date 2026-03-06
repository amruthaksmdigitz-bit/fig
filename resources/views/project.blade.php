@include('includes.header')
<style>.widget__categories--sub__menu--img{	width:50px;}.whatsapp {    width: 27% !important;}.contact_me_whatapp{	position: absolute;}.mobile_whatsapp{	display:none;}@media only screen and (max-width: 600px) {	.web_whatsapp{	display:none !important;	}.mobile_whatsapp{	display:inline !important;	}.call_number_li{width: 107px;margin-right: 10px;}}.contact_me_whatapp{	color:#000 !important;margin-left: 7px;}

.call_number_li
{
    width: 107px;
}
.callnumber
{
    width: 152%;
}
.qick_link
{
	color:#fff !important;
}
.mobile_whatsapp
{
padding-top: 6px !important;
    padding-bottom: 10px !important;
}
@media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
</style> 
<?php
$servername= request()->getHttpHost();
$call_number = App\Http\Controllers\HomeController::getcallnumber();
$call= 'http://'.$servername.'/public/uploads/dock-phone-pictures-26.png';

?>


  <div class="st-content">
    <!-- START: Banner Section -->
    <div class="st-height-b80 st-height-lg-b80"></div>
    <section class="st-page-head st-bg st-style1 text-center st-overlay wow fadeIn" data-wow-duration="1s" data-wow-delay="0.3s" data-src="public/uploads/{{ $project_banner->image}}">
      <div class="container">
        <h1 class="st-page-title">{{$project_banner->title}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Project</li>
        </ol>
      </div>
    </section>
    <!-- END: Banner Section -->
	
	

    <!-- START: Product List Section -->
    <section class="product-list-section">
      <div class="st-height-b120 st-height-lg-b80"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
           
            
            <div class="st-height-b30 st-height-lg-b30"></div>
            <div class="st-product-list st-three-column active">
			
			@foreach($project as $value)
              <div class="st-product st-style1 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeIn;">
                <div class="st-product-in">
                  <!-- Product Image -->
                  <div class="st-product-thumb">
                    <a href="product-details.html"><img src="public/uploads/{{$value->image}}" alt="Product"></a>
                   
                  </div>
                  <!-- Product Name and Price -->
                  <div class="st-product-details">
                  
                    <h4 class="st-product-title"><a href="{{ route('home.projectdetails', ['id' => $value->id]) }}">{{$value->title}}</a></h4>
                   <div class="st-product-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</div>
                  
				  </div>
                </div>
              </div>
            
            </div><!-- .row -->
            <div class="st-height-b40 st-height-lg-b40"></div>
            <!-- Product List Pagination -->
          @endforeach
         
		   
		   
            <div class="st-height-b40 st-height-lg-b40"></div>
            <!-- Product List Pagination -->
         
          </div>
        </div>
      </div>
      <div class="st-height-b120 st-height-lg-b80"></div>
    </section>
    <!-- END: Product List Section -->
  </div>
    @include('includes.footer')