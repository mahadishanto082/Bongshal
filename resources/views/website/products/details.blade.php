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
                                        <h5 class="text-center">Product Details</h5>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" >
                                                    </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" >Part Number</a>
                                            </li>
                                            
                                           
                                        </ul>
                                    </div>
                                    
                                </div>

                                <!-- RIGHT COLUMN: RELATED PRODUCTS -->

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
                            </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
