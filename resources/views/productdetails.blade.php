
 @include('includes.header')
     <div id="smooth-content">

            <main class="main-bg">
     
                <header class="page-header-cerv bg-img section-padding" data-background="/public/uploads/{{ $productbanner->image}}"
                    data-overlay-dark="2">
                    <div class="container pt-100 ontop">
                        <div class="text-center">
                            <h1 class="fz-100">Product Detail</h1>
                            <div class="mt-15">
                                <a href="#">Home</a>
                                <span class="padding-rl-20">|</span>
                                <span class="main-color">Product Detail</span>
                            </div>
                        </div>
                    </div>
                </header>
                    
                       <section class="page-intro section-padding">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-5">
                                <div class="img md-mb50">
                                    <img src="/public/uploads/{{$single_product->image}}" alt="" class="radius-30">
                                    <div class="curv-title main-bg">
                                      
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="content full-width">
                                    <div class="sec-head mb-30">
                                        <h2>{{$single_product->title}}</h2>
                                    </div>
                                     <div class="row ">
                                        <div class="col-lg-12">
                                            <div class="text" style="font-size:20px;">
                                              {{ $single_product->description}}
                                            </div>
                                           
                                        </div>
                                    </div><br/>
                                     @if(isset($value->price) && !empty($value->price))
                                    <div class="item mb-30">
                                            <span class="opacity-8 mb-5">Size :</span>
                                            <h6> {{ $single_product->price}}</h6>
                                        </div>
                                   @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                
                <section class="blog-list-half section-padding">
                    <div class="container">
                        <div class="row">
                            	@foreach($subproducts as $value)
                            <div class="col-lg-6">
                                <div class="item mb-50">
                                    <div class="row rest">
                                        <div class="col-lg-6 col-md-5 img rest">
                                            <img src="/public/uploads/{{$value->image}}" alt="" class="img-post">
                                           
                                        </div>
                                        <div class="col-lg-6 col-md-7 sub-bg cont valign">
                                            <div class="full-width">
                                                
                                                <h5  style="font-size:22px;">
                                                    <a href="{{ route('home.productdetails', ['id' => $value->id]) }}">{{$value->title}}</a>
                                                </h5>
                                                   @if(isset($value->price) && !empty($value->price))
                                                                 

                                                  <div class="tags ">
                                                    <a href="#">Sizes</a>
                                                </div>
                                                <span class="date fz-12 ls1 text-u opacity-7 ">{{$value->price}}</span>
                                                @endif
                                                    @if(isset($value->description) && !empty($value->description))
                                               <a style="margin-top:10px;" href="{{ route('home.productdetails', ['id' => $value->id]) }}">More Details   <img src="https://ui-themez.smartinnovates.net/items/infolio/Infolio/assets/imgs/arrow-right.png" alt="" class="icon-img-20 ml-5"></a>
                                                  @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                            
                        </div>
                    </div>
                </section>
                

                <!-- ==================== End Skills ==================== -->
                
             

</main>
  
 @include('includes.footer')    </div>