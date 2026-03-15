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
        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #2d3436 0%, #000000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 2rem;
            letter-spacing: -1px;
        }

        .product-card-premium {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition-smooth);
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card-premium:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .product-image-wrap {
            position: relative;
            overflow: hidden;
            height: 240px;
            background: #f8f9fa;
        }

        .product-card-premium:hover .card-img-top {
            transform: scale(1.1);
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: var(--transition-smooth);
        }

        .premium-actions {
            position: absolute;
            right: 15px;
            top: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            opacity: 0;
            transform: translateX(20px);
            transition: var(--transition-smooth);
            z-index: 10;
        }

        .product-card-premium:hover .premium-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            color: #2d3436;
            transition: var(--transition-smooth);
            border: none;
        }

        .action-btn:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .premium-badge {
            position: absolute;
            left: 15px;
            top: 15px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 5;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .badge-hot { background: linear-gradient(135deg, #ff416c, #ff4b2b); color: white; }
        .badge-new { background: linear-gradient(135deg, #2193b0, #6dd5ed); color: white; }

        .product-info-premium {
            padding: 20px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-name-premium {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .price-premium {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        .old-price-premium {
            font-size: 0.9rem;
            color: #b2bec3;
            text-decoration: line-through;
            margin-left: 8px;
        }

        .btn-add-cart-premium {
            margin-top: 15px;
            width: 100%;
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
    </style>
@endsection



@section('content')

@include('website.share.user-custom-feature')
<!-- Title-slider -->
@if(!empty($sliders))
    <div class="home-slider margin-bottom-0 shadow-lg">
        @foreach($sliders as $slider)
            <a href="{{ $slider->link ?? 'categories' }}">
                <div data-background-image="{{ asset('storage/sliders/' . $slider->image) }}" 
                     class="item" 
                     style="cursor: pointer; position: relative;">
                    <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%); z-index: 1;"></div>
                    <div class="container" style="position: relative; z-index: 2;">
                        <div class="row">
                            <div class="col-md-7 col-lg-6">
                                <div class="home-slider-container py-5">
                                    <div class="home-slider-desc">
                                        <div class="home-slider-title mb-4">
                                            <h1 class="display-3 fw-bold mb-3" style="color: #2d3436; line-height: 1.1;">{{ $slider->title }}</h1>
                                            <p class="lead mb-4" style="color: #636e72; font-size: 1.25rem;">{{ $slider->sub_title }}</p>
                                            <div class="glass-card d-inline-block px-4 py-2 mb-4">
                                                <span class="text-uppercase fw-bold small text-primary tracking-wider">{{ $slider->description }}</span>
                                            </div>
                                            <div class="mt-2">
                                                <span class="btn btn-premium px-5 py-3">Shop Now</span>
                                            </div>
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
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Shop by Category</h2>
            <p class="text-muted">Find exactly what you're looking for</p>
        </div>
        <div class="row g-4 justify-content-center">
            @if(!empty($top_categories))
                @foreach($top_categories as $category)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                        <a href="{{ route('web.categories.products', $category->slug) }}" class="text-decoration-none">
                            <div class="glass-card p-4 text-center h-100 d-flex flex-column align-items-center justify-content-center">
                                <div class="category-icon-wrap mb-3" style="transition: var(--transition-smooth);">
                                    <img src="{{ asset('storage/categories/' . $category->image) }}" 
                                         class="img-fluid rounded-circle shadow-sm" 
                                         alt="{{ $category->name }}"
                                         style="width: 70px; height: 70px; object-fit: cover; border: 2px solid white;">
                                </div>
                                <h6 class="fw-bold text-dark mb-1 small">{{ $category->name }}</h6>
                                <span class="badge bg-light text-muted fw-normal">View All</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Featured Categories Section End -->





   
    <!-- New Arrival Section -->
    @if(!empty($new_arrival_products))
<section >
    <div class="container">
        <div class="row justify-content-center">
            @foreach($new_arrival_products->take(4) as $product)
                <div class="col-6 col-md-3 mb-4">
                    <div class="product-card-premium">
                        <!-- Badge -->
                        @if($product->stock > 0)
                            <div class="premium-badge badge-new shadow-sm">New</div>
                        @else
                            <div class="premium-badge bg-secondary shadow-sm text-white">Out of Stock</div>
                        @endif

                        <!-- Image Section -->
                        <div class="product-image-wrap">
                            @if(!empty($product->slug))
                                <a href="{{ route('web.products.details', $product->slug) }}">
                                    <img class="card-img-top"
                                        src="{{ asset('storage/products/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                </a>
                            @else
                                <img class="card-img-top"
                                    src="{{ asset('storage/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            @endif

                            <!-- Floating Actions -->
                            <div class="premium-actions">
                                <form id="wishlist-form-{{ $product->id }}-new" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <button type="button" onclick="document.getElementById('wishlist-form-{{ $product->id }}-new').submit();" class="action-btn" title="Add to Wishlist">
                                    <i class="fas fa-heart text-danger"></i>
                                </button>
                                
                                @if (!empty($product->slug))
                                    <button type="button" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="action-btn" title="Quick View">
                                        <i class="fas fa-eye text-primary"></i>
                                    </button>
                                @endif

                                <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="action-btn" title="Compare">
                                        <i class="fas fa-exchange-alt text-info"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="product-info-premium">
                            <div>
                                <h6 class="product-name-premium">{{ $product->name }}</h6>
                                <div class="price-wrap">
                                    @if($product->discount_value > 0)
                                        <span class="price-premium">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                        <span class="old-price-premium">Tk. {{ $product->price }}</span>
                                    @else
                                        <span class="price-premium">Tk. {{ $product->price }}</span>
                                    @endif
                                </div>
                            </div>

                            @if (!empty($product->slug) && $product->stock > 0)
                                @if(auth('web')->check())
                                    <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-premium btn-add-cart-premium">
                                        <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-premium btn-add-cart-premium">
                                        <i class="fas fa-sign-in-alt me-2"></i> Login to Buy
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Hot Deals Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Hot Deals</h2>
            <p class="text-muted">Limited time offers you don't want to miss</p>
        </div>

        <!-- Carousel -->
        <div id="hotDealsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if(!empty($new_arrival_products))
                    @php
                        $hotChunks = $new_arrival_products->shuffle()->chunk(4);
                    @endphp
                    @foreach($hotChunks as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach($chunk as $product)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                        <div class="product-card-premium">
                                            <div class="premium-badge badge-hot shadow-sm">Hot Deal</div>
                                            
                                            <div class="product-image-wrap">
                                                @if(!empty($product->slug))
                                                    <a href="{{ route('web.products.details', $product->slug) }}">
                                                        <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                                    </a>
                                                @else
                                                    <img src="{{ asset('storage/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                                @endif

                                                <div class="premium-actions">
                                                    <form id="wishlist-form-{{ $product->id }}-hot-{{ $index }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <button type="button" onclick="document.getElementById('wishlist-form-{{ $product->id }}-hot-{{ $index }}').submit();" class="action-btn">
                                                        <i class="fas fa-heart text-danger"></i>
                                                    </button>
                                                    
                                                    @if (!empty($product->slug))
                                                        <button type="button" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="action-btn">
                                                            <i class="fas fa-eye text-primary"></i>
                                                        </button>
                                                    @endif

                                                    <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0">
                                                        @csrf
                                                        <button type="submit" class="action-btn">
                                                            <i class="fas fa-exchange-alt text-info"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="product-info-premium">
                                                <div>
                                                    <h6 class="product-name-premium text-truncate">{{ $product->name }}</h6>
                                                    <div class="price-wrap">
                                                        @if($product->discount_value > 0)
                                                            <span class="price-premium">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                                            <span class="old-price-premium">Tk. {{ $product->price }}</span>
                                                        @else
                                                            <span class="price-premium">Tk. {{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if (!empty($product->slug) && $product->stock > 0)
                                                    @if(auth('web')->check())
                                                        <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-premium btn-add-cart-premium">
                                                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                        </button>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn btn-premium btn-add-cart-premium">
                                                            Login to Buy
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Carousel Controls -->
            @if(isset($hotChunks) && $hotChunks->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#hotDealsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#hotDealsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('web.products.index') }}" class="btn btn-premium px-5 py-3 shadow-lg">
                Explore All Deals <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<!-- Hot Deals Section End -->

<!-- Hot Deals Section End -->

<!--card visually section -->


@if(!empty($new_arrival_products) && !empty($feature_categories))
    <div class="container my-5">
        <div class="row align-items-start">

            {{-- LEFT: New Product --}}
            <div class="col-md-6">
                
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
            <div class="col-md-6">
                
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

                                        {{-- Shipping --}}
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
                @endforeach

            </div>
        </div>
    </div>
@endif

<!-- Brand Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Trusted Brands</h2>
            <p class="text-muted">Quality products from names you know</p>
        </div>
        
        <div id="brandCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if(!empty($brands))
                    @php
                        $brandChunks = $brands->chunk(6);
                    @endphp
                    @foreach($brandChunks as $index => $chunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap py-4">
                                @foreach($chunk as $brand)
                                    <div class="brand-item" style="transition: var(--transition-smooth);">
                                        <div class="glass-card p-3 d-flex align-items-center justify-content-center" style="width: 140px; height: 80px;">
                                            <img src="{{ asset('storage/brands/' . $brand->image) }}" 
                                                 alt="{{ $brand->name }}" 
                                                 class="img-fluid" 
                                                 style="max-height: 50px; opacity: 0.7; transition: var(--transition-smooth);"
                                                 onmouseover="this.style.opacity='1'"
                                                 onmouseout="this.style.opacity='0.7'">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Controls -->
            @if(isset($brandChunks) && $brandChunks->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#brandCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#brandCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>


    <!-- Categories Section -->
    @if(!empty($feature_categories))
        @foreach($feature_categories as $key => $category)
            <section class="{{ $key % 2 == 0 ? 'middle' : 'gray' }} py-5">
                <div class="container">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h2 class="section-title mb-0">{{ $category->name }}</h2>
                        <a href="{{ route('web.categories.products', $category->slug) }}" class="btn btn-premium btn-sm">
                            View All <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>

                    <!-- Carousel for Category Products -->
                    <div id="carouselCategory{{ $key }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php
                                $chunks = $category->products->chunk(4);
                            @endphp
                            @foreach($chunks as $chunkIndex => $productChunk)
                                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                    <div class="row g-4">
                                        @foreach($productChunk as $product)
                                            <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                                                <div class="product-card-premium">
                                                    <!-- Badge -->
                                                    @if($product->stock > 0)
                                                        <div class="premium-badge badge-new shadow-sm">Hot</div>
                                                    @else
                                                        <div class="premium-badge bg-secondary shadow-sm text-white">Out</div>
                                                    @endif

                                                    <!-- Image Section -->
                                                    <div class="product-image-wrap">
                                                        @if(!empty($product->slug))
                                                            <a href="{{ route('web.products.details', $product->slug) }}">
                                                                <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                            </a>
                                                        @else
                                                            <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                        @endif

                                                        <!-- Floating Actions -->
                                                        <div class="premium-actions">
                                                            <form id="wishlist-form-{{ $product->id }}-cat-{{ $key }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                            <button type="button" onclick="document.getElementById('wishlist-form-{{ $product->id }}-cat-{{ $key }}').submit();" class="action-btn">
                                                                <i class="fas fa-heart text-danger"></i>
                                                            </button>
                                                            
                                                            @if (!empty($product->slug))
                                                                <button type="button" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="action-btn">
                                                                    <i class="fas fa-eye text-primary"></i>
                                                                </button>
                                                            @endif

                                                            <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0">
                                                                @csrf
                                                                <button type="submit" class="action-btn">
                                                                    <i class="fas fa-exchange-alt text-info"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <!-- Info Section -->
                                                    <div class="product-info-premium">
                                                        <div>
                                                            <h6 class="product-name-premium">{{ $product->name }}</h6>
                                                            <div class="price-wrap">
                                                                @if($product->discount_value > 0)
                                                                    <span class="price-premium">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                                                    <span class="old-price-premium">Tk. {{ $product->price }}</span>
                                                                @else
                                                                    <span class="price-premium">Tk. {{ $product->price }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @if (!empty($product->slug) && $product->stock > 0)
                                                            @if(auth('web')->check())
                                                                <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-premium btn-add-cart-premium">
                                                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                                </button>
                                                            @else
                                                                <a href="{{ route('login') }}" class="btn btn-premium btn-add-cart-premium">
                                                                    Login
                                                                </a>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Carousel Controls -->
                        @if($chunks->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategory{{ $key }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselCategory{{ $key }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    @endif

    @if(!empty($all_products))
    <section class="gray py-5">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="section-title mb-0">All Products</h2>
                <a href="{{ route('web.products.index') }}" class="btn btn-premium btn-sm">
                    View All <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Carousel for All Products -->
            <div id="carouselAllProducts" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $chunks = $all_products->chunk(4);
                    @endphp
                    @foreach($chunks as $chunkIndex => $productChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach($productChunk as $product)
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                                        <div class="product-card-premium">
                                            <!-- Badge -->
                                            @if($product->stock > 0)
                                                <div class="premium-badge badge-new shadow-sm">Hot</div>
                                            @else
                                                <div class="premium-badge bg-secondary shadow-sm text-white">Out</div>
                                            @endif

                                            <!-- Image Section -->
                                            <div class="product-image-wrap">
                                                @if(!empty($product->slug))
                                                    <a href="{{ route('web.products.details', $product->slug) }}">
                                                        <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                    </a>
                                                @else
                                                    <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                                @endif

                                                <!-- Floating Actions -->
                                                <div class="premium-actions">
                                                    <form id="wishlist-form-{{ $product->id }}-all" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                    <button type="button" onclick="document.getElementById('wishlist-form-{{ $product->id }}-all').submit();" class="action-btn">
                                                        <i class="fas fa-heart text-danger"></i>
                                                    </button>
                                                    
                                                    @if (!empty($product->slug))
                                                        <button type="button" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="action-btn">
                                                            <i class="fas fa-eye text-primary"></i>
                                                        </button>
                                                    @endif

                                                    <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST" class="m-0 p-0">
                                                        @csrf
                                                        <button type="submit" class="action-btn">
                                                            <i class="fas fa-exchange-alt text-info"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <!-- Info Section -->
                                            <div class="product-info-premium">
                                                <div>
                                                    <h6 class="product-name-premium text-truncate">{{ $product->name }}</h6>
                                                    <div class="price-wrap">
                                                        @if($product->discount_value > 0)
                                                            <span class="price-premium">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                                            <span class="old-price-premium">Tk. {{ $product->price }}</span>
                                                        @else
                                                            <span class="price-premium">Tk. {{ $product->price }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @if (!empty($product->slug) && $product->stock > 0)
                                                    @if(auth('web')->check())
                                                        <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-premium btn-add-cart-premium">
                                                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                                        </button>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn btn-premium btn-add-cart-premium">
                                                            Login
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Carousel Controls -->
                @if($chunks->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAllProducts" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselAllProducts" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>
    </section>
    @endif

@endsection
