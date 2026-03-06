@include('includes.header')
 <div class="container-fluid bg-breadcrumb">
                <div class="container text-center py-5" style="max-width: 900px;">
                    <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Products</h4>
                    <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active text-primary">Products</li>
                    </ol>    
                </div>
            </div><br/>
 <div class="container-fluid blog pb-5">
            <div class="container pb-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Products</h4>
                    <h1 class="display-5 mb-4">Quality Prodcuts At Reasonable Prices</h1>
                    </p>
                </div>
                <div class="owl-carousel blog-carousel wow fadeInUp" data-wow-delay="0.2s">
                      @foreach($product as $value)
                    <div class="blog-item p-4">
                        <div class="blog-img mb-4">
                            <img src="public/uploads/{{ $value->image}}" class="img-fluid w-100 rounded" alt="">
                            <div class="blog-title">
                                <a href="#" class="btn">{{$value->title}}</a>
                            </div>
                        </div>
                        <p class="mb-4">{{$value->description}}
                        </p>
                        
                    </div>
                     @endforeach
                 
                  
               
                </div>
            </div>
        </div>
        <!-- Blog End -->


  



    @include('includes.footer')
    </div>