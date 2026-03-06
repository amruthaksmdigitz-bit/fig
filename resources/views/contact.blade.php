 @extends('layouts.main')


 @section('content')
     <main>

         <!-- Hero Start-->
         <div class="hero-area2  slider-height2 hero-overly2 d-flex align-items-center "
             style="background-image:url('{{ asset($slider->image) }}')">
             <div class="container">
                 <div class="row">
                     <div class="col-xl-12">
                         <div class="hero-cap text-center pt-50">
                             <h2>Contact Us</h2>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!--Hero End -->
         <!-- ================ contact section start ================= -->


         <section class="contact-section">
             <div class="container">
                 <div class="d-block mb-5 pb-4">


                     <div class="row">
                         <div class="col-12">
                             <h2 class="contact-title">Get in Touch</h2>
                         </div>
                         <div class="col-lg-8">
                             <form action="/contact-submit" method="post">

                                 @csrf
                                 <div class="row">
                                     <div class="col-12">
                                         <div class="form-group">
                                             <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                                 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Write your notes or questions here'"
                                                 placeholder=" Write your notes or questions here"></textarea>
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input class="form-control valid" name="name" id="name" type="text"
                                                 onfocus="this.placeholder = ''"
                                                 onblur="this.placeholder = 'Enter your name'"
                                                 placeholder="Enter your name">
                                         </div>
                                     </div>
                                     <div class="col-sm-6">
                                         <div class="form-group">
                                             <input class="form-control valid" name="email" id="email" type="email"
                                                 onfocus="this.placeholder = ''"
                                                 onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                         </div>
                                     </div>
                                     <div class="col-12">
                                         <div class="form-group">
                                             <input class="form-control" name="subject" id="subject" type="text"
                                                 onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                                 placeholder="Enter Subject">
                                         </div>
                                     </div>

                                     <form method="POST" action="{{ route('login.post') }}">
                                         @csrf

                                         <input type="hidden" name="captcha_generated" id="captchaGenerated">




                                         {{-- IMAGE CAPTCHA START --}}
                                         <div class="mb-3">

                                             <div class="d-flex align-items-center">

                                                 <img src="{{ route('captcha.generate') }}?{{ time() }}"
                                                     id="captchaImage"
                                                     style="height:50px;border:1px solid #ccc;border-radius:5px;">

                                                 <button type="button" onclick="refreshCaptcha()"
                                                     class="btn btn-light ms-2">
                                                     ↻
                                                 </button>

                                             </div>

                                             <input type="text" name="captcha" class="form-control mt-2"
                                                 placeholder="Enter Captcha" required>

                                         </div>
                                         {{-- IMAGE CAPTCHA END --}}

                                 </div>



                                 <div class="form-group mt-3">
                                     <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                                 </div>
                             </form>
                             @if (session('success'))
                                 <div id="success-alert">
                                     <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                         {{ session('success') }}
                                     </div>
                                 </div>
                                 <script>
                                     setTimeout(function() {
                                         var alert = document.getElementById('success-alert');
                                         if (alert) {
                                             alert.style.display = 'none';
                                         }
                                     }, 3500);
                                 </script>
                             @endif
                         </div>
                         <div class="col-lg-3 offset-lg-1">
                             <div class="media contact-info">
                                 <span class="contact-info__icon"><i class="ti-home"></i></span>
                                 <div class="media-body">
                                     <h3>Address</h3>
                                     <p>{{ $address->body }}</p>

                                 </div>
                             </div>
                             <div class="media contact-info">
                                 <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                                 <div class="media-body">
                                     <h3>Phone</h3>
                                     <p>{{ $phone->title }}</p>

                                 </div>
                             </div>
                             <div class="media contact-info">
                                 <span class="contact-info__icon"><i class="ti-email"></i></span>
                                 <div class="media-body">
                                     <h3>{{ $email->title }}</h3>
                                     <p>Send us your query anytime!</p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
         </section>
         <!-- ================ contact section end ================= -->

     </main>

     <script>
         function refreshCaptcha() {
             document.getElementById('captchaImage').src =
                 "{{ route('captcha.generate') }}?" + new Date().getTime();
         }
     </script>
 @endsection
