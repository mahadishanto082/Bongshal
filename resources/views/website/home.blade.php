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
                                        @if($slider->category)
                                            <a href="{{ route('web.categories.products', $slider->category->slug) }}" class="btn btn-white stretched-link">Buy Now<i class="lni lni-arrow-right ml-2"></i></a>
                                        @endif
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

                    {{-- Product Image --}}
                    <a href="{{ route('web.products.details', $product->slug) }}">
                        <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </a>

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

            <div class="row align-items-center rows-products">
                @foreach($new_arrival_products as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                        <div class="product_grid card b-0 mb-0">
                            @if($product->stock > 0)
                                <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                            @else
                                <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Out Of Stock</div>
                            @endif

                            @if($product->discount_value > 0 && $product->discount_type)
                                <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                    @if($product->discount_type == 'Taka')
                                        -{{ $product->discount_value }} Tk
                                    @else
                                        -{{ $product->discount_value }}%
                                    @endif
                                </div>
                            @endif

                            <div class="card-body p-0">
                                <div class="shop_thumb position-relative">
                                    <a class="card-img-top d-block overflow-hidden" href="{{ route('web.products.details', $product->slug) }}">
                                        <img class="card-img-top" src="{{ asset('storage/products/'. $product->image) }}" alt="{{ $product->name }}">
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center bg-white">
                                <div class="text-left">
                                    <div class="text-center">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{ route('web.products.details', $product->slug) }}">{{ $product->name }}</a></h5>
                                        @if($product->discount_value > 0 && $product->discount_type)
                                            <div class="elis_rty">
                                                <span class="text-muted ft-medium line-through mr-2">Tk. {{ $product->price }}</span>
                                                <span class="ft-bold theme-cl fs-md">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                            </div>
                                        @else
                                            <div class="elis_rty">
                                                <span class="ft-bold text-dark fs-sm">Tk. {{ $product->price }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5">
                                <a href="{{ route('web.products.details', $product->slug) }}" class="btn btn-block btn-sm btn-order">
                                    <i class="lni lni-cart"></i> Order
                                </a>
                                @if($product->size || $product->color)
                                    <a href="javascript:void(0)" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')"  class="btn btn-block btn-sm btn-cart">
                                        <i class="lni lni-shopping-basket"></i> Add to cart
                                    </a>
                                @else
                                    <a href="javascript:void(0)" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-block btn-sm btn-cart">
                                        <i class="lni lni-shopping-basket"></i> Add to cart
                                    </a>
                                @endif
                                <a class="btn btn-block btn-sm btn-detail" href="{{ route('web.products.details', $product->slug) }}">
                                    <i class="lni lni-text-align-justify"></i> Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('website.share.user-custom-feature')

@endsection
