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

@section('title')
    Products | {{ $product->name }}
@endsection

@section('content')
            <div class="gray py-3">
                <div class="container">
                    <div class="row">
                        <div class="colxl-12 col-lg-12 col-md-12">
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
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="sp-loading">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                                <br>LOADING IMAGES
                            </div>
                            <div class="sp-wrap">
                                <a href="{{ asset('storage/products/' . $product->image) }}"><img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"></a>
                                @if(count($product->images))
                                    @foreach($product->images as $image)
                                        <a href="{{ $image->url }}"><img src="{{ $image->url }}" alt="{{ $product->name }}"></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                            <div class="prd_details">

                                @if($product->stock > 0)
                                    <div class="prt_01 mb-2">
                                        <span class="text-success bg-light-success rounded px-2 py-1">Stock Available</span>
                                    </div>
                                @else
                                    <div class="prt_01 mb-2"><span class="text-danger bg-light-danger rounded px-2 py-1">Out Of Stock</span></div>
                                @endif
                                <div class="prt_02 mb-3">
                                    <h2 class="ft-bold mb-1">{{ $product->name }}</h2>
                                    <div class="text-left">
                                        @if($product->discount_value > 0 && $product->discount_type)
                                            <div class="elis_rty">
                                                <span class="text-muted ft-medium line-through mr-2">Tk. {{ $product->price }}</span>
                                                <span class="ft-bold theme-cl fs-md">Tk. {{ discountCal($product->price, $product->discount_type, $product->discount_value) }}</span>
                                                <span class="badge bg-green text-white ft-regular ab-right text-upper ml-5">
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
                                </div>

                                <div class="row">

                                    @if($product->point > 0 && auth('web')->check() && auth('web')->user()->role == 'Agent')
                                        <div class="col-md-12">
                                            <div class="prt_04 mb-4">
                                                <p class="d-flex align-items-center mb-1">
                                                    এই পণ্য অর্ডার করলেই আপনি পাচ্ছেন <strong class="fs-sm text-dark ft-medium ml-1">{{ $product->point }} &nbsp;</strong> পয়েন্ট
                                                </p>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="prt_04 mb-4">
                                            <p class="d-flex align-items-center mb-1">Category:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->category->name }}</strong></p>
                                            @if($product->brand)
                                                <p class="d-flex align-items-center mb-0">Brand:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->brand->name }}</strong></p>
                                            @endif
                                            @if($product->merchant)
                                                <p class="d-flex align-items-center mb-0">Merchant:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->merchant->name }}</strong></p>
                                            @endif
                                        </div>
                                    </div>
                                    @if($product->type == 'Book')
                                        <div class="col-md-6">
                                            <div class="prt_04 mb-4">
                                                @if($product->writer)
                                                    <p class="d-flex align-items-center mb-0">Writer:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->writer->name }}</strong></p>
                                                @endif
                                                @if($product->first_release)
                                                    <p class="d-flex align-items-center mb-0">First Release:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->first_release }}</strong></p>
                                                @endif
                                                @if($product->language)
                                                    <p class="d-flex align-items-center mb-0">Language:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->language }}</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="prt_04 mb-4">
                                                @if($product->weight)
                                                    <p class="d-flex align-items-center mb-0">Weight:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->weight }}</strong></p>
                                                @endif
                                                @if($product->warranty)
                                                    <p class="d-flex align-items-center mb-0">Warranty:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->warranty }}</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    @if($product->delivery_info || $product->shipping_in_dhaka || $product->shipping_out_dhaka)
                                        <div class="col-md-12">
                                            <div class="prt_04 mb-4">
                                                @if($product->delivery_info)
                                                    <p class="d-flex align-items-center mb-0">Delivery:<strong class="fs-sm text-dark ft-medium ml-1">{{ $product->delivery_info }}</strong></p>
                                                @endif
                                                @if(getSetting() && getSetting()->shipping_in_dhaka)
                                                    <p class="d-flex align-items-center mb-0">Shipping in dhaka city:<strong class="fs-sm text-dark ft-medium ml-1">Tk. {{ getSetting()->shipping_in_dhaka }}</strong></p>
                                                @endif
                                                @if(getSetting() && getSetting()->shipping_out_dhaka)
                                                    <p class="d-flex align-items-center mb-0">Out of dhaka city:<strong class="fs-sm text-dark ft-medium ml-1">Tk. {{ getSetting()->shipping_out_dhaka }}</strong></p>
                                                @endif
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                @if($product->size)
                                    @php
                                        $sizes = json_decode($product->size);
                                    @endphp
                                    <div class="prt_04 mb-4">
                                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                                        <div class="text-left pb-0 pt-2">
                                            @foreach($sizes as $key => $size)
                                                <div class="form-check size-option form-option form-check-inline mb-2">
                                                    <input class="form-check-input" v-model="size" type="radio" name="size" value="{{ $size }}" id="size{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                                    <label class="form-option-label" for="size{{ $key }}">{{ $size }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($product->color)
                                    @php
                                        $colors = json_decode($product->color);
                                    @endphp
                                    <div class="prt_04 mb-4">
                                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                                        <div class="text-left pb-0 pt-2">
                                            @foreach($colors as $key => $color)
                                                <div class="form-check size-option form-option form-check-inline mb-2">
                                                    <input class="form-check-input" v-model="color" type="radio" name="color" value="{{ $color }}" id="color{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                                    <label class="form-option-label" for="color{{ $key }}">{{ $color }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($product->fabrics)
                                    @php
                                        $fabrics = json_decode($product->fabrics);
                                    @endphp
                                    <div class="prt_04 mb-4">
                                        <p class="d-flex align-items-center mb-0 text-dark ft-medium">Fabrics:</p>
                                        <div class="text-left pb-0 pt-2">
                                            @foreach($fabrics as $key => $fabric)
                                                <div class="form-check size-option form-option form-check-inline mb-2">
                                                    <input class="form-check-input" v-model="fabrics" type="radio" name="fabrics" value="{{ $fabric }}" id="fabrics{{ $key }}" {{ $key == 0 ? 'checked' : '' }} required>
                                                    <label class="form-option-label" for="fabrics{{ $key }}">{{ $fabric }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div class="prt_05 mb-4">
                                    <div class="form-row mb-7">
                                        <div class="col-4 col-lg-auto">
                                            <div class="input-group mb-3">
                                                <div @click="decrement()" class="qty-input-btn">
                                                    <span class="input-group-text">-</span>
                                                </div>
                                                <div class="qty-input">@{{ qty }}</div>
                                                <div @click="increment('{{ $product->stock }}')" class="qty-input-btn">
                                                    <span class="input-group-text">+</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 col-lg">
                                            <!-- Submit -->
                                            <button type="button" @click="addToCart('{{ route('web.cart.add', $product->slug) }}')" class="btn btn-block custom-height bg-dark mb-2">
                                                <i class="lni lni-shopping-basket mr-2"></i>Add to Cart
                                            </button>
                                        </div>
        <!--                                <div class="col-4 col-lg-auto">
                                            &lt;!&ndash; Wishlist &ndash;&gt;
                                            <button class="btn custom-height btn-default btn-block mb-2 text-dark" data-toggle="button">
                                                </i>Wishlist
                                            </button>
                                        </div>-->
                                    </div>
                                    <div class="prt_04 mb-4">
                                    <form id="wishlist-form-{{ $product->id }}" action="{{ route('web.user.wishlist.add', $product->id) }}" method="POST" style="display: none;">
        @csrf
    </form>

    <button
        type="button"
        onclick="document.getElementById('wishlist-form-{{ $product->id }}').submit();"
        class="btn btn-sm text-white"
        style="background-color: orange; border-radius: 10px;"
    >
        <i class="lni lni-heart mr-2"></i> Add to Wishlist
    </button>


    <form action="{{ route('web.user.compare.add', $product->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-sm text-white" style="background-color: #007bff; border-radius: 10px;">
        <i class="lni lni-balance mr-2"></i> Add to Compare
    </button>
</form>




                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if($product->description)
                <section class="middle">
                    <div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
                                <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="description_info">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
                                <!-- All products details-->
            @if(count($relatedProducts) > 0)
                <section class="gray pt-3">
                    <div class="container">

                        <div class="row justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="sec_title position-relative text-center">
                                    <h2 class="off_title">Similar Products</h2>
                                    <h3 class="ft-bold pt-3">Related</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="slide_items">
                                    @foreach($relatedProducts as $product)
                                        <div class="single_itesm">
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
                                                            <img class="card-img-top" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
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

                                                    @if($product['size'] || $product['color'])
                                                        <a href="javascript:void(0)" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')"  class="btn btn-block btn-sm btn-cart">
                                                            <i class="lni lni-shopping-basket"></i> Add to Cart
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" @click="addToCart('{{ route('web.cart.add', $product['slug']) }}')" class="btn btn-block btn-sm btn-cart">
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
                        </div>

                    </div>
                </section>
            @endif

@endsection
