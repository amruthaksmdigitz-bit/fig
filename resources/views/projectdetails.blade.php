
 @include('includes.header')
 <style>
 @media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
.whatsapp {
    width: 27% !important;
	
}
.contact_me_whatapp
{
	position: absolute;
}
.mobile_whatsapp
{
	display:none;
}
@media only screen and (max-width: 600px) {
	
.web_whatsapp
{
	display:none !important;
	
}
.mobile_whatsapp
{
	display:inline !important;
	
}
}
.contact_me_whatapp
{
	color:#fff !important;
}
.quickview__cart--btn
{
	width: 175px;
}
.whatsapp_product {
    width: 25% !important;
}
.contact_me_whatapp_product
{
	position: absolute;
}
.mobile_whatsapp_product
{
	display:none;
}
@media only screen and (max-width: 600px) {

.contact_me_whatapps
{
	display:block;
	    margin-top: -41px;
    margin-left: 36px;
}
.mobile_whatsapp .whatsapps {
    width: 41% !important;
	margin-left: -22px;
}
.mobile_whatsapp_product
{
	    padding-top: 8px;
    padding-bottom: 10px;
}
.whatsapp_product {
    width: 63% !important;
}
.contact_me_whatapp_product
{
	display:none !important; 
}
.web_whatsapp_product
{
	display:none !important;
	
}
.mobile_whatsapp_product
{
	display:inline !important;
	
}
}
.contact_me_whatapp_product
{
	color:#000 !important;
	margin-left: 7px;
	
}
</style>
<style>
.product-tab
{
   margin: 0;
    padding: 0;
    border: 0;
   
    font: inherit;
    vertical-align: baseline;
    outline: none;
	}

.tab {
    margin-bottom: 30px;
    margin-top: 20px;
}
.main-ul {
    background: #4c4c4c none repeat scroll 0 0;
    overflow: hidden;
    width: 100%;
}
ul {
    list-style: none;
	 margin: 0;
    padding: 0;
    border: 0;
   
    font: inherit;
    vertical-align: baseline;
    outline: none;
}
.tab ul li {
    color: #999999;
    cursor: pointer;
    float: left;
    font-size: 14px;
    margin-right: 0;
    padding: 13px 20px;
    text-transform: uppercase;
    border-right: 1px solid #555555;
}
li,tbody {
    display: inline-block;
	 list-style: none;
	 margin: 0;
    padding: 0;
    border: 0;
   
    font: inherit;
    vertical-align: baseline;
    outline: none;
}
.tab ul li.active {
    color: #FFF;
}
.tab-container {
    background: #fff none repeat scroll 0 0;
    color: #1f1f1f;
    font-size: 12px;
    line-height: 20px;
    padding: 14px;
    clear: both;
}
.respon {
    background: #fceacb none repeat scroll 0 0;
    border-bottom: 1px solid #f1ce9a;
    box-sizing: border-box;
    display: none;
    padding: 8px;
    position: relative;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
.specification-table tr:first-child {
    background: #f5f5f5;
}
.specification-table tr td:first-child {
    text-transform: uppercase;
    color: #000;
}
.specification-table td {
    border: 1px solid #e5e5e5;
    padding: 10px 18px;
   
}
.callnumber{
	width: 32px;
}
.callnumbers{
	width: 70px;
}
.callnumber_span

{
	color: #fff;
    margin-left: 10px;
}
.specif_row
{
	border: 1px solid gray;
}
.specif_td
{
	border: 1px solid gray;
	padding: 8px;
}

.callnumber_call
{
    width: 152%;
}
.fa-arrow-left,.fa-arrow-right
{
	color: white;
    margin-left: 10px;
}
.image_sizeer
{
	width: 315px !important;
}
</style>
@php
$servername= request()->getHttpHost();
$img= 'http://'.$servername.'/public/uploads/whatsapp.png';
$call= 'http://'.$servername.'/public/uploads/dock-phone-pictures-26.png';
$project_single_banner = 'http://'.$servername.'/public/uploads/'.$project_single_banners->image;
$project_single_image = 'http://'.$servername.'/public/uploads/'.$single_project->image;

$call_number = App\Http\Controllers\HomeController::getcallnumber();
$whatsapp_number = App\Http\Controllers\HomeController::getwhatsappnumber();	
@endphp
 
  <div class="st-content">
    <!-- START: Banner Section -->
    <div class="st-height-b80 st-height-lg-b80"></div>
    <section class="st-page-head st-bg st-style1 text-center st-overlay wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s" data-src="{{$project_single_banner}}">
      <div class="container">
        <h1 class="st-page-title">{{$project_single_banners->title}}</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Project Details</li>
        </ol>
      </div>
    </section>
    <!-- END: Banner Section -->

    <!-- START: Product List Section -->
    <section class="product-list-section">
      <div class="st-height-b120 st-height-lg-b80"></div>
      <div class="container">
        <div class="row">
          <!-- Product Details Image -->
          <div class="col-md-5 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <div class="st-tabs st-fade-tabs st-style4">
             <div class="tab-content st-lightgallery">
				

					<div id="" class="st-tab active">
						<img src="{{ $project_single_image }}" alt="">
						<a href="{{ $project_single_image }}" class="st-product-preview-btn st-lightbox-item"><i class="fa fa-eye"></i></a>
						
					</div>
				
			</div>
             
            </div><!-- .st-tabs -->
            <div class="st-height-b0 st-height-lg-b30"></div>
          </div>
          <!-- Product Details Description -->
          <div class="col-md-7 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <div class="st-product-info">
              <!-- Product Details Title -->
              <h2 class="st-product-details-title"><a href="#">{{$single_project->title}}</a></h2>
              <!-- Product Details Review -->
              <ul class="st-mp0 st-product-info-list">
           
                <li>
                  <b>Project description</b> </li>
                  <li> <p>{{$single_project->description}}</p>
                </li>
                
                
              </ul>
              
            </div>
          </div>
        </div>
        <div class="st-height-b45 st-height-lg-b45"></div>
       
      
      </div>
	  
      
    </section>
    <!-- END: Product List Section -->

   
    <section>
      <div class="st-height-b120 st-height-lg-b80"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="st-heading-section text-center">
              <h3 class="st-heading-title">Multiple Images</h3>
               </div>
          </div>
        </div>
        <div class="st-slider st-style2">
          <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"  data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
            <div class="slick-wrapper">
			  @foreach($multiple_image as $value)
			   @php
			    $project_multi_image ='http://'.$servername.'/public/uploads/'.$value->image;
               @endphp
              <div class="slick-slide-in">
                <div class="st-product st-style1">
                  <div class="st-product-in">
                    <!-- Product Image -->
                    <div class="st-product-thumb">
                      <a href="product-details.html"><img src="{{$project_multi_image}}" alt="Product"></a>
                      <div class="st-product-tools">
                     
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div><!-- .slick-slide-in -->
              @endforeach
            </div>
          </div><!-- .slick-container -->
         <div class="swipe-arrow st-style1"> <!-- If dont need navigation then add class .st-hidden -->
            <div class="slick-arrow-left"><i class="fa fa-chevron-left"></i></div>
            <div class="slick-arrow-right"><i class="fa fa-chevron-right"></i></div>
          </div>
        </div><!-- .st-slider -->
      </div>
      <div class="st-height-b120 st-height-lg-b80"></div>
    </section>
    <!-- END: Product Section -->

 
  </div>

 @include('includes.footer')