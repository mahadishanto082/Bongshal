@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Products | {{ $product->name }}" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ $product->name }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('storage/products/' . $product->image) }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="{{ $product->name }}, Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('_css')
    <link rel="stylesheet" href="{{ asset('assets/website/css/smoothproducts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/product-details.css') }}">

    
    <style>
        .wishlist-btn,
        .compare-btn {
            background-color: transparent !important;
            color: black !important;
            border: none !important;
            box-shadow: none !important;
            padding: 0.3rem 0.6rem;
            font-weight: 500;
        }

        .wishlist-btn:hover,
        .compare-btn:hover {
            color: #000;
        }

       /* Ensure carousel parent is relative */
#carouselRelatedProducts {
  position: relative;
  min-height: 180px;
}

/* Carousel controls styling */
.carousel-control-prev,
.carousel-control-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  width: 45px;
  height: 45px;
  background-color: rgba(0, 0, 0, 0.4);
  border-radius: 50%;
  z-index: 10;
  transition: background-color 0.2s, transform 0.1s;
}

/* Hover effect */
.carousel-control-prev:hover,
.carousel-control-next:hover {
  background-color: rgba(0, 0, 0, 0.6);
}

/* Active click effect */
.carousel-control-prev:active,
.carousel-control-next:active {
  background-color: rgba(0, 0, 0, 0.7);
  transform: translateY(-50%) scale(0.95);
}

/* Carousel icon size */
.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-size: 60% 60%;
  filter: invert(1); /* makes the icon white */
}

.card:hover .product-actions {
    opacity: 1 !important;
    transform: translateY(0);

}

    </style>
@endsection

@section('title')
    Products | {{ $product->name }}
@endsection

@section('content')
        <div class="gray py-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('web.products.index') }}">All Products</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

                    <section class="middle">
                        <div class="container">
                            <div class="row">
                                <!-- LEFT COLUMN -->
                                <div class="col-lg-8 col-md-12">
                                    <div class="row">
                                        <!-- Product Image -->
                                        <div class="col-md-6">
                                            <div class="sp-loading">
                                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                <br>LOADING IMAGES
                                            </div>
                                            <div class="sp-wrap">
                                                <a href="{{ asset('storage/products/' . $product->image) }}">
                                                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                </a>
                                                @if(count($product->images))
                                                    @foreach($product->images as $image)
                                                        <a href="{{ $image->url }}"><img src="{{ $image->url }}" alt="{{ $product->name }}"></a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Product Details -->
                                        <div class="col-md-6">
                                            <div class="prd_details">
                                                @if($product->stock > 0)
                                                    <span class="text-success bg-light-success rounded px-2 py-1">Stock Available</span>
                                                @else
                                                    <span class="text-danger bg-light-danger rounded px-2 py-1">Out Of Stock</span>
                                                @endif

                                                <h2 class="ft-bold mt-2">{{ $product->name }}</h2>
                                                <p class="mb-1">Product Code: <strong>{{ $product->code }}</strong></p>

                                                <div class="text-left">
                                                    @if($product->discount_value > 0 && $product->discount_type)
                                                        <div class="elis_rty">
                                                            <span class="text-muted ft-medium line-through mr-2">Tk. {{ $product->price }}</span>
                                                            <span class="ft-bold theme-cl fs-md">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                                            <span class="badge bg-green text-white ml-2">
                                                                @if($product->discount_type == 'Taka')
                                                                    -{{ $product->discount_value }} Tk
                                                                @else
                                                                    -{{ $product->discount_value }}%
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="elis_rty">
                                                            <span class="ft-bold text-dark fs-sm">Tk. {{ $product->price }}</span>
                                                        </div>
                                                    @endif

                                                    
                                                    <ul class="list-inline mb-0" style="font-size: 0.75rem; white-space: nowrap;">
                                                        <li class="list-inline-item">
                                                            <div class="mt-0 mb-0">
                                                                @php $rating = $product->rating ?? 4; @endphp
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $rating)
                                                                        <i class="fas fa-star text-warning"></i>
                                                                    @else
                                                                        <i class="far fa-star text-muted"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                        </li>
                                                        <li class="list-inline-item px-1">|</li>
                                                        <li class="list-inline-item text-danger" style="color:#fa4c06;">Read Reviews</li>
                                                        <li class="list-inline-item px-1">|</li>
                                                        <li class="list-inline-item" style="color:#fa4c06;">
                                                             Q&As
                                                        </li>
                                                        <li class="list-inline-item px-1">|</li>
                                                        <li class="list-inline-item" style="color:#fa4c06;">
                                                             Write Review
                                                        </li>
                                                    </ul>

                                                    
                                                </div>

                                                <!-- Additional product info (category, brand, merchant, etc.) -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="mb-1">Category: <strong>{{ $product->category->name }}</strong></p>
                                                        @if($product->brand)
                                                            <p class="mb-1">Brand: <strong>{{ $product->brand->name }}</strong></p>
                                                        @endif
                                                        @if($product->merchant)
                                                            <p class="mb-1">Merchant: <strong>{{ $product->merchant->name }}</strong></p>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- Size, Color, Fabrics Options -->
                                                @if($product->size)
                                                    @php $sizes = json_decode($product->size); @endphp
                                                    <p class="mt-3 mb-1">Size:</p>
                                                    @foreach($sizes as $key => $size)
                                                        <label class="mr-2">
                                                            <input type="radio" name="size" value="{{ $size }}" {{ $key == 0 ? 'checked' : '' }}> {{ $size }}
                                                        </label>
                                                    @endforeach
                                                @endif

                                                @if($product->color)
                                                    @php $colors = json_decode($product->color); @endphp
                                                    <p class="mt-3 mb-1">Color:</p>
                                                    @foreach($colors as $key => $color)
                                                        <label class="mr-2">
                                                            <input type="radio" name="color" value="{{ $color }}" {{ $key == 0 ? 'checked' : '' }}> {{ $color }}
                                                        </label>
                                                    @endforeach
                                                @endif

                                                <div class="prt_05 mb-4">
                                                    <div class="form-row mb-4">
                                                        <div class="col-4 col-lg-auto">
                                                            <div class="input-group input-group-sm">
                                                                <div @click="decrement()" class="qty-input-btn" >
                                                                    <span class="input-group-text px-2 py-1">-</span>
                                                                </div>
                                                                <div class="qty-input px-2" style="font-size: 0.85rem; min-width: 30px; ">@{{ qty }}</div>
                                                                <div @click="increment('{{ $product->stock }}')" class="qty-input-btn" >
                                                                    <span class="input-group-text px-2 py-1">+</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <!-- Add to cart form -->
                                                        <div class="col-6">
                                                            <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-dark btn-block" style="height: 65px;">
                                                                <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                                                            </button>
                                                        </div>
                                                    </div>
                                                 </div>





                                                <!-- Add to cart -->
                                                <div class="form-row mt-3 d-flex justify-content-start gap-2">

                                                    <!-- Wishlist Button -->
                                                    <form id="wishlist-form-{{ $product->id }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <button type="button"
                                                            onclick="document.getElementById('wishlist-form-{{ $product->id }}').submit();"
                                                            class="btn btn-sm wishlist-btn me-1">
                                                        <i class="lni lni-heart mr-1"></i> Wishlist
                                                    </button>

                                                    <!-- Compare Button -->
                                                    <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm compare-btn text-white" style="border-radius: 10px;">
                                                            <i class="fas fa-exchange-alt text-primary"></i> Add to Compare
                                                        </button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div>
                                    <div class="container mt-4">
                                        <h5 class="text-center mb-3">Product Details</h5>

                                        <!-- Tabs Navigation -->
                                        <ul class="nav nav-tabs justify-content-start" id="productTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                                    Description
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">
                                                    Specification
                                                </button>
                                            </li>
                                        </ul>

                                        <!-- Tabs Content -->
                                        <div class="tab-content border p-3 border-top-0" id="productTabContent">
                                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                                {!! $product->description !!}
                                            </div>
                                            <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                                                {!! $product->specification ?? 'No specification provided.' !!}
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                    
                                </div>

                                <!-- RIGHT COLUMN: RELATED PRODUCTS

                                <div class="col-lg-2 mt-4 mt-lg-0 ms-auto" style="position: sticky; top: 100px; z-index: 1;">

                                    @if(count($relatedProducts) > 0)
                                        <div class="text-center mb-3">
                                            <h5 class="mb-3" style="font-weight: bold; font-size:larger">You May Also Like</h5>
                                        </div>
                                        <div class="row ">
                                            @foreach($relatedProducts->take(3) as $product)
                                                <div class="col-12 mb-3">
                                                    <div class="rounded p-1 text-center h-100" style="max-width: 150px; margin: 0 auto;">
                                                        {{-- Product image --}}
                                                        @if (!empty($product->slug))

                                                            <a href="{{ route('web.products.details', $product->slug) }}">
                                                                <img src="{{ asset('storage/products/' . $product->image) }}" 
                                                                    alt="{{ $product->name }}" 
                                                                    class="img-fluid rounded mb-2" 
                                                                    style="max-height: 100px; object-fit: contain;">
                                                            </a>
                                                        @endif

                                                        {{-- Product name --}}
                                                        <h6 class="fw-bold mb-1 text-end" style="word-break: break-word;">
                                                          @if (!empty($product->slug))
                                                            <a href="{{ route('web.products.details', $product->slug) }}" class="text-dark text-decoration-none">
                                                                {{ Str::limit($product->name, 20) }}
                                                            </a>

                                                          @endif
                                                        </h6>

                                                        {{-- Pricing --}}
                                                        @if($product->discount_value > 0 && $product->discount_type)
                                                            <div class="elis_rty">
                                                                <span class="text-muted text-decoration-line-through">Tk. {{ $product->price }}</span><br>
                                                                <span class="text-danger fw-bold">
                                                                    Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <div class="elis_rty">
                                                                <span class="text-dark fw-bold">Tk. {{ $product->price }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                            </div> -->
<!-- All products details-->
<div class="row justify-content-center">
            <div class="col-md-8 col-sm-10 col-12">
                <div class="sec_title text-center mb-2">
                    <h5 class="ft-bold mb-0">Related Products</h5>
                </div>
            </div>
        </div>


        @if(count($relatedProducts) > 0)
<section class=" pt-2 pb-2">
    <div class="container">
        

        <div id="carouselRelatedProducts" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @php $chunks = $relatedProducts->chunk(4); @endphp

                @foreach($chunks as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row justify-content-start">
                            @foreach($chunk as $product)
                                <div class="col-auto mb-3">
                                    <div class="border rounded p-2 text-center" style="width: 130px;">
                                        {{-- Product image --}}
                                        <a href="{{ route('web.products.details', $product->slug) }}">
                                            <img src="{{ asset('storage/products/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="img-fluid rounded mb-1"
                                                style="max-height: 90px; object-fit: contain;">
                                        </a>

                                        {{-- Product name --}}
                                        <h6 class="fw-semibold mb-1" style="font-size: 0.75rem;">
                                            <a href="{{ route('web.products.details', $product->slug) }}" class="text-dark text-decoration-none">
                                                {{ Str::limit($product->name, 18) }}
                                            </a>
                                        </h6>

                                        {{-- Pricing --}}
                                        @if($product->discount_value > 0 && $product->discount_type)
                                            <div style="font-size: 0.7rem;">
                                                <span class="text-muted text-decoration-line-through">Tk. {{ $product->price }}</span><br>
                                                <span class="text-danger fw-bold">
                                                    Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                                                </span>
                                            </div>
                                        @else
                                            <div style="font-size: 0.75rem;">
                                                <span class="text-dark fw-bold">Tk. {{ $product->price }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Controls --}}
            @if($relatedProducts->count() > 4)
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselRelatedProducts" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselRelatedProducts" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>
@endif

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection