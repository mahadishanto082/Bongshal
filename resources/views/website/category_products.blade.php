@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Categories | {{ $category->name }}" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('title')
    Categories | {{ $category->name }}
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('web.categories') }}">Subjects</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="gray">
        <div class="container">
            @if(count($products) > 0)
                <div class="infinite-scroll">
                    <div class="row align-items-center rows-products">
                        <!-- Single -->
                        @foreach($products as $product)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                <div class="product_grid card b-0 mb-0 shadow">
                                    @if($product['stock'] > 0)
                                        <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                    @else
                                        <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">Out Of Stock</div>
                                    @endif

                                    @if($product['discount_value'] > 0 && $product['discount_type'])
                                        <div class="badge bg-danger text-white position-absolute ft-regular ab-right text-upper">
                                            @if($product['discount_type'] == 'Taka')
                                                -{{ $product['discount_value'] }} Tk
                                            @else
                                                -{{ $product['discount_value'] }}%
                                            @endif
                                        </div>
                                    @endif

                                    <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                            <a class="card-img-top d-block overflow-hidden" href="{{ route('web.products.details', $product['slug']) }}">
                                                <img class="card-img-top" src="{{ asset('storage/products/'. $product['image']) }}" alt="{{ $product['name'] }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center bg-white">
                                        <div class="text-left">
                                            <div class="text-center">
                                                <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="#">{{ $product['name'] }}</a></h5>
                                                @if($product['discount_value'] > 0 && $product['discount_type'])
                                                    <div class="elis_rty">
                                                        <span class="text-muted ft-medium line-through mr-2">Tk. {{ $product['price'] }}</span>
                                                        <span class="ft-bold theme-cl fs-md">Tk. {{ discountCal($product['price'], $product['discount_type'], $product['discount_value']) }}</span>
                                                    </div>
                                                @else
                                                    <div class="elis_rty">
                                                        <span class="ft-bold text-dark fs-sm">Tk. {{ $product['price'] }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-5">
                                        <a href="{{ route('web.products.details', $product['slug']) }}" class="btn btn-block btn-sm btn-order">
                                            <i class="lni lni-cart"></i> Place order
                                        </a>

                                        @if($product['size'] || $product['color'])
                                            <a href="javascript:void(0)" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')"  class="btn btn-block btn-sm btn-cart">
                                                <i class="lni lni-shopping-basket"></i> Add to cart
                                            </a>
                                        @else
                                            <form action="{{ route('web.cart.quickAddCart', $product['slug']) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-block btn-sm btn-cart">
                                                    <i class="lni lni-shopping-basket"></i> Add to cart
                                                </button>
                                            </form>
                                        @endif
                                        <a class="btn btn-block btn-sm btn-detail" href="{{ route('web.products.details', $product['slug']) }}">
                                            <i class="lni lni-text-align-justify"></i> Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{ $products->appends(request()->input())->links('website.share.pagination') }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection


@push('_js')
    <script src="{{ asset('assets/website/js/jquery.jscroll.js') }}"></script>

    <script>
        $('ul.pagination').hide();
        $(function () {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<a href="#" class="btn stretched-link borders m-auto"><i class="lni lni-reload mr-2"></i>Loading...</a>', // MAKE SURE THAT YOU PUT THE CORRECT IMG PATH
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function () {
                    $('ul.pagination').remove();
                }
            });
        });
    </script>
@endpush

