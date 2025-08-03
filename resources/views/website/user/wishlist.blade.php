@extends('layouts.website')

@section('title')
    Wishlist
@endsection
@section('meta')
    <meta name="description" content="Your wishlist items">
    <meta name="keywords" content="wishlist, products, user, ecommerce">
@endsection

@section('content')
<!-- @include('website.share.user-custom-feature') -->
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row justify-content-center justify-content-between">
                <!-- Left Menu -->
                <!-- Left Menu Wrapped in Proper Column -->
                <div class="col-xl-3 col-lg-4 col-md-5 mb-4">
                                    <div class="rounded p-3 h-100" style="min-height: 100%; overflow-x: auto;">
                                        @include('website.share.user-menu')
                                    </div>
                </div>


                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <div class="row align-items-center">

                        @forelse($wishlistItems as $item)
                            @php $product = $item->product; @endphp

                            @if($product)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <div class="product_grid card b-0 position-relative">

                                        @if($product->is_sale)
                                            <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                        @endif

                                        <form action="{{ route('web.user.wishlist.remove', $product->id) }}" method="POST" class="position-absolute ab-right">
                                            @csrf
                                            <button type="submit" 
        class="position-absolute" 
        style="top: 10px; right: 10px; background: none; border: none; padding: 0;">
    <i class="lni lni-close" style="color: red; font-size: 16px;"></i>
</button>

                                            </button>
                                         </form>


                                         <div class="card border-0 shadow-sm mb-4"
     style="width: 280px; height: 420px; display: flex; flex-direction: column;">

    <!-- Product Image -->
    @if(!empty($product->slug))
        <a href="{{ route('web.products.details', $product->slug) }}">
            <img class="card-img-top"
                 src="{{ asset('storage/products/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 style="height: 200px; width: 100%; object-fit: contain;">
        </a>
    @else
        <img class="card-img-top"
             src="{{ asset('storage/products/' . $product->image) }}"
             alt="{{ $product->name }}"
             style="height: 200px; width: 100%; object-fit: contain;">
    @endif

    <!-- Card Body -->
    <div class="card-body text-center d-flex flex-column justify-content-between px-2 pt-2 pb-3" style="flex: 1;">
        <!-- Product Name -->
        <h6 class="fw-semibold mb-2 text-truncate">{{ $product->name }}</h6>

        <!-- Price -->
        <div class="mb-3">
            @if($product->discount_value > 0)
                <div>
                    <span class="fw-bold fs-5 text-danger">
                        Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}
                    </span>
                    <span class="text-muted text-decoration-line-through small">
                        Tk. {{ $product->price }}
                    </span>
                </div>
            @else
                <div class="fw-bold fs-5 text-dark">Tk. {{ $product->price }}</div>
            @endif
        </div>

        <!-- 3 Buttons -->
        <div class="d-flex flex-column gap-2">
            <!-- Order Button -->
            

            <!-- Add to Cart -->
            @if($product->size || $product->color)
                <a href="javascript:void(0)"
                   onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}"
                   class="btn btn-outline-dark btn-sm w-100 d-flex align-items-center justify-content-center"
                   style="transition: 0.3s;color :blue">
                    <i class="lni lni-shopping-basket me-2" style="color:blue"></i> Add to cart
                </a>
            @else
                <a href="javascript:void(0)"
                   @click="addToCart('{{ route('web.cart.add', $product->slug) }}')"
                   class="btn btn-outline-dark btn-sm w-100 d-flex align-items-center justify-content-center"
                   style="transition: 0.3s; color:blue">
                    <i class="lni lni-shopping-basket me-2" style="color:blue"></i> Add to cart
                </a>
            @endif

            <!-- Details Button -->
            <a href="{{ route('web.products.details', $product->slug) }}"
               class="btn btn-outline-dark btn-sm w-100 d-flex align-items-center justify-content-center"
               style="transition: 0.3s; color:red">
                <i class="lni lni-text-align-justify me-2" style="color:red"></i> Details
            </a>
        </div>
    </div>
</div>

                                    </div>
                                </div>
                            @else
                                <div class="col-12 text-center text-danger">
                                    <p>Product no longer available.</p>
                                </div>
                            @endif
                        @empty
                            <div class="col-12 text-center py-5">
                                <h4>Your wishlist is empty.</h4>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    
@endsection
