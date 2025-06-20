@extends('layouts.website')

@section('title')
    Wishlist
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
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
                @include('website.share.user-menu')

                <div class="col-12 col-md-12 col-lg-8 col-xl-8 text-center">
                    <!-- row -->
                    <div class="row align-items-center">

                        <!-- Single -->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_grid card b-0">
                            @forelse($wishlistItems as $item)
                    @php $product = $item->product; @endphp

                    @if($product)
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="product_grid card b-0">
                                @if($product->is_sale)
                                    <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                @endif

                                <form action="{{ route('web.user.wishlist', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn_love position-absolute ab-right theme-cl">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>

                                <div class="card-body p-0">
                                    <div class="shop_thumb position-relative">
                                        <a class="card-img-top d-block overflow-hidden" href="{{ route('web.user.wishlist', $product->id) }}">
                                            <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        </a>
                                    </div>
                                </div>

                                <div class="card-footers b-0 pt-3 px-2 bg-white d-flex align-items-start justify-content-center">
                                    <div class="text-left text-center">
                                        <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1">
                                            <a href="{{ route('web.user.wishlist', $product->id) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="elis_rty">
                                            @if($product->old_price)
                                                <span class="text-muted ft-medium line-through mr-2">${{ $product->old_price }}</span>
                                            @endif
                                            <span class="ft-bold theme-cl fs-md">${{ $product->price }}</span>
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


                        
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    @include('website.share.user-custom-feature')
@endsection
