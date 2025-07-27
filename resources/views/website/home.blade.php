@extends('layouts.website')

@section('title')
    Home
@endsection

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Home" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('_css')
    <style>
        .btn-home {
            padding: 3px 10px!important;
            margin-top: 17px!important;
            font-size: 12px!important;
        }

       
        .carousel-control-prev,
.carousel-control-next {
  top: 50%;
  transform: translateY(-50%);
  width: 45px;
  height: 45px;
  background-color: rgba(0, 0, 0, 0.4);
  border-radius: 50%;
  transition: background-color 0.2s, transform 0.1s;
}

.carousel-control-prev:active,
.carousel-control-next:active {
  background-color: rgba(0, 0, 0, 0.7);
  transform: translateY(-50%) scale(0.95);
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
  background-color: rgba(0, 0, 0, 0.6);
}
.card:hover .product-actions {
    opacity: 1 !important;
    transform: translateY(0);

}

.product-actions {
    
    transition: opacity 0.3s ease, transform 0.3s ease;
    display: flex;
    flex-direction: column;
    gap: 5px;
    position: absolute;
    top: 50%;
    left: 80%;
    
    opacity: 0;
    z-index: 10;
    
}
    </style>
@endsection



@section('content')

@include('website.share.user-custom-feature')
<!-- Title-slider -->
@if(!empty($sliders))
    <div class="home-slider margin-bottom-0">
        @foreach($sliders as $slider)
            <a href="{{ $slider->link ?? 'categories' }}"> {{-- Make image clickable --}}
                <div data-background-image="{{ asset('storage/sliders/' . $slider->image) }}" 
                     class="item" 
                     style="cursor: pointer;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="home-slider-container">
                                    <div class="home-slider-desc">
                                        <div class="home-slider-title mb-4 text-black">
                                            <h1 class="mb-1 ft-bold lg-heading">{{ $slider->title }}</h1>
                                            <span class="trending home-slider-text">{{ $slider->sub_title }}</span>
                                            <span class="trending home-slider-text">{{ $slider->description }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif



<!-- Featured Categories Section -->
<h6 class="mt-2 fw-semibold text-dark text-center" style="font-size: 2rem;">
  {{ $category->name ?? 'Featured Categories' }}
</h6>


<section >
        <div class="container" style="justify-content: center;">
            @if(!empty($categories))
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                            <div class="cats_side_wrap text-center mx-auto bg-white shadow mb-3">
                                <div class="sl_cat_01">
                                    <div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">
                                        <a href="{{ route('web.categories.products', $category->slug) }}" class="d-block">
                                            <img src="{{ asset('storage/categories/'. $category->image) }}" class="img-fluid" width="40" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="{{ route('web.categories.products', $category->slug) }}">{{ $category->name }}</a></h6></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
     </section>

    
<!-- Featured Categories Section End -->





   
    <!-- New Arrival Section -->
    @if(!empty($new_arrival_products))
<section >
    <div class="container">
        <div class="row justify-content-center">
            @foreach($new_arrival_products->take(3) as $product)
                <div class="col-6 col-md-3 mb-4">
                    <div class="card border-0 shadow-sm position-relative"
                        style="width: 100%; height: 380px; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 0.5rem 1rem rgba(0,0,0,0.15)'"
                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">

                        <!-- Badge -->
                        <div class="position-absolute top-0 start-0 ms-2 mt-2 bg-info text-white px-2 py-1 rounded" style="z-index: 10;">
                            <small class="fw-bold text-uppercase">
                                {{ $product->stock > 0 ? 'Staff Pick' : 'Out of Stock' }}
                            </small>
                        </div>

                        <!-- Image -->
                        @if(!empty($product->slug))
                            <a href="{{ route('web.products.details', $product->slug) }}" style="flex-shrink: 0;">
                                <img class="card-img-top"
                                    src="{{ asset('storage/products/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    style="height: 200px; width: 100%; object-fit: cover;">
                            </a>
                        @else
                            <img class="card-img-top"
                                src="{{ asset('storage/products/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                style="height: 200px; width: 100%; object-fit: cover;">
                        @endif

                        <!-- Content -->
                        <div class="card-body text-center p-2" style="flex-grow: 1;">
                            <h6 class="fw-semibold mb-2">{{ $product->name }}</h6>

                            <!-- Rating (optional, remove if not needed) -->
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!--Hot Deals Section -->
<section >
    <div class="container">
        <div class="row justify-content-between" >
            <div class="col-12 text-center">
                <div class="sec_title position-relative">
                    <!-- <h2 class="off_title">Hot deals</h2> -->
                    <h6 class="mt-2 fw-semibold text-dark " style="font-size: 2rem; justify-content: center;">
  {{ 'Hot Deals of the month' }}
</h6>

                </div>
            </div>
           
        </div>

        <!-- Carousel -->
        <div id="carouselExample" class="carousel slide mt-3">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="d-flex justify-content-start flex-wrap gap-3">

                        <!-- Product Card Dummy -->
                        <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm position-relative mb-4" style="width: 280px; height: 380px;">
                                <!-- Badge -->
                                <div class="position-absolute top-0 start-0 bg-info text-white px-2 py-1 m-2 rounded">
                                    <small class="fw-bold text-uppercase">Staff Pick</small>
                                </div>

                                <!-- Dummy Action Buttons -->
                                <div class="product-actions position-absolute start-0 ms-1 mt-5 d-flex flex-column gap-2" style="top: 10px; opacity: 0;">
                                    <button type="button"><i class="fas fa-heart text-danger"></i></button>
                                    <button type="button"><i class="fas fa-shopping-cart text-success"></i></button>
                                    <button type="button"><i class="fas fa-exchange-alt text-primary"></i></button>
                                </div>

                                <!-- Product Image -->
                                <a href="#">
                                    <img src="https://via.placeholder.com/280x200" class="card-img-top" alt="Product" style="object-fit: cover; height: 200px;">
                                </a>

                                <!-- Card Body -->
                                <div class="card-body text-center p-2">
                                    <h6 class="fw-semibold mb-2">Smartphone X</h6>

                                    <!-- Price -->
                                    <div class="mb-1">
                                        <span class="fw-bold fs-5 text-danger">Tk. 800</span>
                                        <span class="text-muted text-decoration-line-through small">Tk. 1000</span>
                                    </div>
                                    <span class="badge bg-danger">Save 20%</span>

                                    <!-- Free Shipping -->
                                    <div class="d-flex align-items-center justify-content-center small mt-2">
                                        <i class="fas fa-shipping-fast text-dark me-1"></i> Free Shipping
                                    </div>

                                    <!-- Rating -->
                                    <div class="mt-1">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="far fa-star text-muted"></i>
                                        <span class="small text-muted">(4.0/5)</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Repeat above card 3 more times to simulate 4-card carousel -->
                        <!-- ...copy/paste above card block 3 more times... -->

                    </div>
                </div>

            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    <div class="col-12 text-center mb-4">
        <a href="#" class="btn  px-4 py-2 fw-semibold" style="background-color:#fa4c06; color:white;">
          SHOP NOW
        </a>
      </div>
</section>

<!-- Hot Deals Section End -->

<!--card visually section -->


@if(!empty($new_arrival_products) && !empty($feature_categories))
<div class="container my-5">
    <div class="row align-items-start">

        {{-- LEFT: New Product --}}
        <div class="col-md-6"> <!-- Changed to col-md-6 for better layout -->
            
            @foreach($new_arrival_products->take(1) as $product)
                <div class="card border-0 shadow-sm position-relative"
                    style="transition: 0.3s ease;">
                    <div class="position-absolute top-0 start-0 ms-2 mt-2 bg-info text-white px-2 py-1 rounded z-1">
                        <small class="fw-bold text-uppercase">
                            {{ $product->stock > 0 ? 'Staff Pick' : 'Out of Stock' }}
                        </small>
                    </div>

                    <a href="{{ route('web.products.details', $product->slug) }}">
                        <img class="card-img-top"
                            src="{{ asset('storage/products/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            style="height: 300px; object-fit: cover;">
                    </a>

                    <div class="card-body">
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="fw-semibold mb-0">{{ $product->name }}</h6>
        <a href="#" class="btn px-4 py-2 fw-semibold" style="background-color:#fa4c06; color:white;">
            SHOP NOW
        </a>
    </div>
</div>

                </div>
            @endforeach
        </div>

        {{-- RIGHT: Featured Products --}}
        <div class="col-md-6"><!-- Changed to col-md-6 for better layout -->
            
            @foreach($feature_categories->take(1) as $category)
                <div class="row">
                    @foreach($category->products->take(2) as $product)

                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm position-relative"
                                style="height: 100%; transition: 0.3s ease;">
                                <div class="position-absolute top-0 start-0 ms-2 mt-2 bg-info text-white px-2 py-1 rounded z-1">
                                    <small class="fw-bold text-uppercase">
                                        {{ $product->stock > 0 ? 'Staff Pick' : 'Out of Stock' }}
                                    </small>
                                </div>

                                @if (!empty($product->slug))
                                    <a href="{{ route('web.products.details', $product->slug) }}">
                                        <img class="card-img-top"
                                            src="{{ asset('storage/products/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            style="height: 200px; object-fit: cover;">
                                    </a>
                                
                                @endif
                                <div class="card-body text-center">
                                  {{-- Price Section --}}
                                    <div>
                                        @if($product->discount_value > 0)
                                            <div class="mb-1">
                                                <span class="fw-bold fs-5 text-danger">
                                                    Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                                                </span>
                                                <span class="text-muted text-decoration-line-through small">
                                                    Tk. {{ $product->price }}
                                                </span>
                                            </div>
                                            <span class="badge bg-danger">
                                                Save {{ $product->discount_type === 'Taka' ? $product->discount_value . ' Tk' : $product->discount_value . '%' }}
                                            </span>
                                        @else
                                            <div class="mb-2 fw-bold fs-5 text-dark">Tk. {{ $product->price }}</div>
                                        @endif
                                    </div>
                                    
                                               <!-- Shipping -->
                                        <div class="d-flex align-items-center justify-content-center small mt-2">
                                            <i class="fas fa-shipping-fast text-dark me-1"></i> Free Shipping
                                        </div>

                                        <!-- 👇 Added Rating Section -->
                                        <div class="mt-1">
                                            @php $rating = $product->rating ?? 4; @endphp
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= $rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span class="small text-muted">({{ number_format($rating, 1) }}/5)</span>
                                        </div>
                                        <!-- ☝️ End Rating Section -->

                                                  
                                </div>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
                
            @endforeach
        </div>

    </div>
</div>
@endif
</section>

<!-- End single card section -->

<!--featured card section -->


 <!--Brand Section -->
 <h6 class="mt-2 fw-semibold text-dark text-center" style="font-size: 2rem;">
  {{ $brand->name ?? 'Brand Categories' }}
</h6>
<section class="gray">
    <div class="container">
        <div class="row justify-content-center">
            @if(!empty($brands))
                @foreach($brands as $brand)
                    <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                        <div class="cats_side_wrap text-center mx-auto bg-white shadow mb-3">
                            <div class="sl_cat_01">
                                <div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">

                                    <a>
                                            <img src="{{ asset('storage/brands/'. $brand->image) }}" class="img-fluid" width="40" alt="">
                                        </a>
                                    
                                    
                                </div>
                            </div>
                          
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

    <!-- Categories Section -->
    @if(!empty($feature_categories))
        @foreach($feature_categories as $key => $category)
            <section class="{{ $key % 2 == 0 ? 'middle' : 'gray' }}">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                            <div class="sec_title position-relative">
{{--                               <h2 class="off_title">{{ $category->name }}</h2>--}}
                                <h3 class="ft-bold pt-3">
                                    <span style="border: 2px solid #ccc; padding: 5px">
                                        {{ $category->name }}
                                    </span>
                                </h3>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                            <div class="position-relative text-right">
                                <a href="{{ route('web.categories.products', $category->slug) }}" class="btn btn-sm btn-outline-info btn-home">Details<i class="lni lni-arrow-right ml-2"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel for Category Products -->
                    <div id="carouselCategory{{ $key }}" class="carousel slide">

                <div class="carousel-inner">
                    @php
                        $chunks = $category->products->chunk(4); // Group by 4
                    @endphp
                    @foreach($chunks as $chunkIndex => $productChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            @foreach($productChunk as $product)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    <div class="card border-0 shadow-sm position-relative mb-4"
                                        style="width: 280px; height: 380px; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                        onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 0.5rem 1rem rgba(0,0,0,0.15)'"
                                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">

                                        <!-- Badge -->
                                        <div class="position-absolute top-0 start-0 ms-2 mt-2 bg-info text-white px-2 py-1 rounded" style="z-index: 10;">
                                            <small class="fw-bold text-uppercase">
                                                {{ $product->stock > 0 ? 'Staff Pick' : 'Out of Stock' }}
                                            </small>
                                        </div>

                                        <!-- Action buttons (hover only) -->
                                        <div class="product-actions position-absolute start-0 ms-1 mt-5 d-flex flex-column gap-2"
                                            style="top: 10px; opacity: 0; transition: opacity 0.3s ease; z-index: 11;">
                                            <form id="wishlist-form-{{ $product->id }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                            <button
                                                type="button"
                                                onclick="document.getElementById('wishlist-form-{{ $product->id }}').submit();"
                                               
                                            >

                                                <i class="fas fa-heart text-danger"></i>
                                            </button>
                                      
                                            @if (!empty($product->slug))
                                            <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" >
                                                <i class="fas fa-shopping-cart text-success"></i>
                                            </button>
                                            @endif
                                            <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0 flex-fill">
                                                @csrf
                                                <button type="submit" >
                                                <i class="fas fa-exchange-alt text-primary"></i>

                                                </button>
                                            </form>


                                            
                                           
                                        </div>

                                        <!-- Image -->
                                        @if(!empty($product->slug))
                                            <a href="{{ route('web.products.details', $product->slug) }}" style="flex-shrink: 0;">
                                                <img class="card-img-top"
                                                     src="{{ asset('storage/products/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        style="height: 200px; width: 100%; object-fit: cover;">
                                            </a>
                            
                        @else
                            <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                        @endif
                    {{-- content Body --}}
                    <div class="card-body text-center p-2">
                        <h6 class="fw-semibold mb-2">{{ $product->name }}</h6>

                        {{-- Price Section --}}
                        <div>
                            @if($product->discount_value > 0)
                                <div class="mb-1">
                                    <span class="fw-bold fs-5 text-danger">
                                        Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                                    </span>
                                    <span class="text-muted text-decoration-line-through small">
                                        Tk. {{ $product->price }}
                                    </span>
                                </div>
                                <span class="badge bg-danger">
                                    Save {{ $product->discount_type === 'Taka' ? $product->discount_value . ' Tk' : $product->discount_value . '%' }}
                                </span>
                            @else
                                <div class="mb-2 fw-bold fs-5 text-dark">Tk. {{ $product->price }}</div>
                            @endif
                        </div>

                        {{-- Free Shipping --}}
                        <div class="d-flex align-items-center justify-content-center small mt-2">
                            <i class="fas fa-shipping-fast text-dark me-1"></i> Free Shipping
                        </div>

                        {{-- Rating --}}
                        <div class="mt-1">
                            @php $rating = $product->rating ?? 4; @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if($i <= $rating)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-muted"></i>
                                @endif
                            @endfor
                            <span class="small text-muted">({{ number_format($rating, 1) }}/5)</span>
                                      </div>
                                    </div>
                                </div>
                             </div>
                          @endforeach

                      </div>
                    </div>
                    @endforeach
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategory{{ $key }}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselCategory{{ $key }}" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
                </div>
                    
                </div>
            </section>
        @endforeach

    @endif

    @if(!empty($new_arrival_products))
    <section class="gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <div class="sec_title position-relativer">
                        <h3 class="ft-bold pt-3">
                            <span style="border: 2px solid #ccc; padding: 5px">All Products</span>
                        </h3>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                    <div class="position-relative text-right">
                        <a href="{{ route('web.products.index') }}" class="btn btn-sm btn-outline-info btn-home">All Products<i class="lni lni-arrow-right ml-2"></i></a>
                    </div>
                </div>
            </div>
<!-- Carousel for New Arrival Products -->
<div id="carouselNewArrivals" class="carousel slide">
                <div class="carousel-inner">

                    @php
                        $chunks = $new_arrival_products->chunk(4); // Group by 4
                    @endphp

                    @foreach($chunks as $chunkIndex => $productChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                        @foreach($productChunk as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                            <div class="card border-0 shadow-sm position-relative mb-4"
                                style="width: 280px; height: 380px; display: flex; flex-direction: column; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 0.5rem 1rem rgba(0,0,0,0.15)'"
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0.125rem 0.25rem rgba(0,0,0,0.075)'">

                                <!-- Badge -->
                                <div class="position-absolute top-0 start-0 ms-2 mt-2 bg-info text-white px-2 py-1 rounded" style="z-index: 10;">
                                    <small class="fw-bold text-uppercase">
                                        {{ $product->stock > 0 ? 'Staff Pick' : 'Out of Stock' }}
                                    </small>
                                </div>

                                <!-- Action buttons (hover only) -->
 <div class="product-actions position-absolute start-0  ms-1 mt-5 d-flex flex-column gap-2"
     style="top: 10px; opacity: 0; transition: opacity 0.3s ease; z-index: 11;">

                                        <form id="wishlist-form-{{ $product->id }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                            <button
                                                type="button"
                                                onclick="document.getElementById('wishlist-form-{{ $product->id }}').submit();"
                                               
                                            >

                                                <i class="fas fa-heart text-danger"></i>
                                            </button>
                                            @if (!empty($product->slug))
                                            <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" >
                                                <i class="fas fa-shopping-cart text-success"></i>
                                            </button>
                                            @endif
                                              <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0 flex-fill">
                                                @csrf
                                                <button type="submit" >
                                                <i class="fas fa-exchange-alt text-primary"></i>

                                                </button>
                                            </form>
                                        </div>
  
                                <!-- Image -->
                             
                                    @if(!empty($product->slug))
                                    <a href="{{ route('web.products.details', $product->slug) }}" style="flex-shrink: 0;">
                                        <img class="card-img-top"
                                        src="{{ asset('storage/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                    </a>
                                    @else
                                    <img class="card-img-top"
                                        src="{{ asset('storage/products/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        style="height: 200px; width: 100%; object-fit: cover;">
                                    @endif
                                  
                                  


                                <!-- Content -->
                                <div class="card-body text-center p-2" style="flex-grow: 1;">
                                <h6 class="fw-semibold mb-2">{{ $product->name }}</h6>

                                <!-- Price -->
                                <div>
                                    @if($product->discount_value > 0)
                                    <div class="mb-1">
                                        <span class="fw-bold fs-5 text-danger">
                                        Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                                        </span>
                                        <span class="text-muted text-decoration-line-through small ms-1">
                                        Tk. {{ $product->price }}
                                        </span>
                                    </div>
                                    <span class="badge bg-danger">
                                        Save {{ $product->discount_type === 'Taka' ? $product->discount_value . ' Tk' : $product->discount_value . '%' }}
                                    </span>
                                    @else
                                    <div class="mb-2 fw-bold fs-5 text-dark">
                                        Tk. {{ $product->price }}
                                    </div>
                                    @endif
                                </div>

                                <!-- Free Shipping -->
                                <div class="text-muted mt-1">
                                    <i class="fas fa-shipping-fast me-1"></i> Free Shipping
                                </div>

                                <!-- Rating -->
                                <div class="mt-1">
                                    @php $rating = $product->rating ?? 4; @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                    @endfor
                                    <span class="small text-muted">({{ number_format($rating, 1) }}/5)</span>
                                </div>
                             </div>
                              </div>
                         </div>
                          @endforeach
                        </div>
                    </div>
                    @endforeach

             </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewArrivals" data-bs-slide="prev" >
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselNewArrivals"data-bs-slide="next" >
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                            </button>
                         </div>
                    </div>
                 </div>
    </section>
    @endif

    
    

@endsection



