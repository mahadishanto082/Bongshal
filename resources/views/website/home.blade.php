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
    </style>
@endsection



@section('content')<<!-- Title-slider -->
    @if(!empty($sliders))
        <div class="home-slider margin-bottom-0">
            @foreach($sliders as $slider)
                <div data-background-image="{{ asset('storage/sliders/'. $slider->image) }}" class="item">
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
            @endforeach
        </div>
    @endif

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
                     @if(count($category->products) > 0)
                       <div class="row">
                         @foreach($category->products as $product)
                         <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                              <div class="card border-0 shadow-sm position-relative" style="width: 100%;">
                    {{-- Horizontal Staff Pick Badge --}}
                       <div class="position-absolute top-0 end-0 me-2 mt-2 bg-info text-white px-2 py-1 rounded">
                            <small class="fw-bold text-uppercase">Staff Pick</small>
                         </div>

                         @if(!empty($product->slug))
                            <a href="{{ route('web.products.details', $product->slug) }}">
                                <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                            </a>
                        @else
                            <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                        @endif
                    {{-- Card Body --}}
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
                    @endif
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
            <div id="carouselExampleAutoplaying" class="carousel slide" >
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
                <div class="position-absolute top-0 end-0 me-2 mt-2 bg-info text-white px-2 py-1 rounded" style="z-index: 10;">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"></span>
            </button>
</div>


              
            </div>
            
        </div>
    </section>
    @endif

    @include('website.share.user-custom-feature')
    

@endsection



