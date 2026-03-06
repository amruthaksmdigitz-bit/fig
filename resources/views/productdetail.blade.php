 @extends('layouts.main')


@section('content') 
 <style>
   # Blog Details Section
--------------------------------------------------------------*/
.blog-details {
  padding-bottom: 30px;
}

.blog-details .article {
  background-color: var(--surface-color);
  padding: 30px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.blog-details .post-img {
  margin: -30px -30px 20px -30px;
  overflow: hidden;
}

.blog-details .title {
  color: var(--heading-color);
  font-size: 28px;
  font-weight: 700;
  padding: 0;
  margin: 30px 0;
}

.blog-details .content {
  margin-top: 20px;
}

.blog-details .content h3 {
  font-size: 22px;
  margin-top: 30px;
  font-weight: bold;
}

.blog-details .content blockquote {
  overflow: hidden;
  background-color: color-mix(in srgb, var(--default-color), transparent 95%);
  padding: 60px;
  position: relative;
  text-align: center;
  margin: 20px 0;
}

.blog-details .content blockquote p {
  color: var(--default-color);
  line-height: 1.6;
  margin-bottom: 0;
  font-style: italic;
  font-weight: 500;
  font-size: 22px;
}

.blog-details .content blockquote:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 3px;
  background-color: var(--accent-color);
  margin-top: 20px;
  margin-bottom: 20px;
}

.blog-details .meta-top {
  margin-top: 20px;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-details .meta-top ul {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  align-items: center;
  padding: 0;
  margin: 0;
}

.blog-details .meta-top ul li+li {
  padding-left: 20px;
}

.blog-details .meta-top i {
  font-size: 16px;
  margin-right: 8px;
  line-height: 0;
  color: color-mix(in srgb, var(--default-color), transparent 40%);
}

.blog-details .meta-top a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  font-size: 14px;
  display: inline-block;
  line-height: 1;
}

.blog-details .meta-bottom {
  padding-top: 10px;
  border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
}

.blog-details .meta-bottom i {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  display: inline;
}

.blog-details .meta-bottom a {
  color: color-mix(in srgb, var(--default-color), transparent 40%);
  transition: 0.3s;
}

.blog-details .meta-bottom a:hover {
  color: var(--accent-color);
}

.blog-details .meta-bottom .cats {
  list-style: none;
  display: inline;
  padding: 0 20px 0 0;
  font-size: 14px;
}

.blog-details .meta-bottom .cats li {
  display: inline-block;
}

.blog-details .meta-bottom .tags {
  list-style: none;
  display: inline;
  padding: 0;
  font-size: 14px;
}

.blog-details .meta-bottom .tags li {
  display: inline-block;
}

.blog-details .meta-bottom .tags li+li::before {
  padding-right: 6px;
  color: var(--default-color);
  content: ",";
}

.blog-details .meta-bottom .share {
  font-size: 16px;
}

.blog-details .meta-bottom .share i {
  padding-left: 5px;
}

 </style>
 
<div class="container-fluid page-header mb-5 p-0" style="background:#794E2B">
            <div class="container-fluid page-header-inner py-5">
                <div class="container text-center pb-5">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">{{$product->name}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">{{$product->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        
        <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{ asset($product->image) }}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{$product->name}}</h2>

               

                <div class="content">
                    {!! $product->description !!}

                

                </div>

                

              </article>

            </div>
          </section>

 

@endsection