  @include('includes.header')

<style>
@media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
.whatsapp {
    width: 27% !important;
	margin-left: -80px;
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
	.contact_me_whatapps {
     display: block;
margin-top: -41px;
    margin-left: 40px;	 
}
.mobile_whatsapp .whatsapps {
    width: 32% !important;
    margin-left: -113px;
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
.callnumber{
	width: 32px;
}
.callnumber_span

{
	color: #fff;
    margin-left: 10px;
}
</style>
@php
$servername= request()->getHttpHost();
$img= 'http://'.$servername.'/public/uploads/whatsapp.png';
$call= 'http://'.$servername.'/public/uploads/dock-phone-pictures-26.png';
@endphp
  <main class="main__content_wrapper">
        
        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg" style="background: url(public/uploads/{{$branches_banner->image}});background-repeat: no-repeat;background-size: cover;">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Branches</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Branches</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start shop section -->
        <section class="shop__section section--padding">
            <div class="container">
          
                <div class="row">
                    <div class="col-12">
                        <div class="shop__product--wrapper">
                            <div class="tab_content">
                              
                                <div id="product_list" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row row-cols-1 mb--n30">
										@foreach($branches as $value)
                                            <div class="col mb-30">
                                                <div class="product__items product__list--items d-flex">
                                                    <div class="product__items--thumbnail product__list--items__thumbnail">
                                                        <a class="product__items--link" href="product-details.html">
                                                            <img class="product__items--img product__primary--img" src="public/uploads/{{$value->image}}" alt="product-img">
                                                            <img class="product__items--img product__secondary--img" src="public/uploads/{{$value->image}}" alt="product-img">
                                                        </a>
                                                        <div class="product__badge">
                    
                                                        </div>
                                                    </div>
                                                    <div class="product__list--items__content">
                                                        
                                                        <h3 class="product__list--items__content--title h4 mb-10"><a href="{{route('home.branchdetails', ['id' => $value->id])}}">{{$value->title}}</a></h3>
                                                       <span class="product__items--content__subtitle mb-5">{{$value->job_title}}</span>
                                          
                                                        <p class="product__list--items__content--desc mb-15">{{$value->description}}</p>
                                                        <ul class="product__items--action d-flex">
														<div class="row">
														<div class="col-md-6">
                                       	 <button class="quickview__cart--btn primary__btn" type="submit">
                                       <a class="variant__wishlist--icon mb-15" href="tel:{{$value->phone1}}" >
                                            <img class="callnumber" src="{{$call}}"><span class="callnumber_span">Call me</span>
                                                    
                                        </a>
										</button>
										</div>
										<div class="col-md-6">
                                        <button class="quickview__cart--btn primary__btn" type="submit">
										 <a class="web_whatsapp" target="blank" href="https://web.whatsapp.com/send?phone={{$value->phone2}}&text=Hi, I am interested in this product. Please send me the details.&app_absent=0">
                                                        <img class="whatsapp  whatsapps" src="{{$img}}"><span class="contact_me_whatapp contact_me_whatapps">Contact me</span>
                                                    </a>
													
													 <a class="mobile_whatsapp" target="blank" href="https://wa.me/{{$value->phone2}}?text=Hi, I am interested in this product. Please send me the details.">
                                                        <img class="whatsapp whatsapps" src="{{$img}}"><span class="contact_me_whatapp contact_me_whatapps">Contact me</span>
                                                    </a>
										</button> 
                                             </div>
</div>											 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                           @endforeach
                                        
                                       
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
      
    </main>
	
	@include('includes.footer')