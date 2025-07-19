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
    <div class="card product_card mb-4 border-0 shadow-sm h-100 position-relative">
        
        {{-- Badges --}}
        @if($product['stock'] > 0)
            <div class="badge bg-success position-absolute top-0 start-0 m-2">Sale</div>
        @else
            <div class="badge bg-secondary position-absolute top-0 start-0 m-2">Out Of Stock</div>
        @endif

        @if($product['discount_value'] > 0 && $product['discount_type'])
            <div class="badge bg-danger position-absolute top-0 end-0 m-2">
                @if($product['discount_type'] == 'Taka')
                    -{{ $product['discount_value'] }} Tk
                @else
                    -{{ $product['discount_value'] }}%
                @endif
            </div>
        @endif

        {{-- Product Image --}}
        @if (!empty($product->slug))
            <a href="{{ route('web.products.details', $product->slug) }}">
                <img class="card-img-top" src="{{ asset('storage/products/' . $product['image']) }}" alt="{{ $product['name'] }}" style="height: 200px; object-fit: cover;">
            </a>
        
        @endif
       
        {{-- Product Info --}}
        <div class="card-body text-center p-3">
            <h6 class="fw-bold mb-1 text-dark">{{ $product['name'] }}</h6>

            @if($product['discount_value'] > 0 && $product['discount_type'])
                <div class="mb-2">
                    <span class="text-muted text-decoration-line-through me-2">Tk. {{ $product['price'] }}</span>
                    <span class="text-danger fw-semibold">Tk. {{ discountCal($product['price'], $product['discount_type'], $product['discount_value']) }}</span>
                </div>
            @else
                <div class="mb-2">
                    <span class="text-dark fw-semibold">Tk. {{ $product['price'] }}</span>
                </div>
            @endif

            {{-- Product Buttons --}}
            <div class="d-grid gap-2">
                {{-- Quick View --}}
                @if (!empty($product->slug) && $product['stock'] > 0)
                    <a href="javascript:void(0)" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center">
                        <i class="lni lni-eye me-2"></i> Quick View
                    </a>
                @endif

               

                {{-- Add to Cart --}}
                @if($product['size'] || $product['color'])
                    <a href="javascript:void(0)" onclick="productQuckView('{{ route('web.products.quickView', $product->slug) }}')" class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center">
                        <i class="lni lni-shopping-basket me-2"></i> Add to Cart
                    </a>
                @elseif($product['stock'] > 0 && $product['is_add_to_cart'] == 1)
                    <form action="{{ route('web.cart.quickAddCart', $product['slug']) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning btn-sm d-flex align-items-center justify-content-center w-100">
                            <i class="lni lni-shopping-basket me-2"></i> Add to Cart
                        </button>
                    </form>
                @endif

                {{-- Details --}}
               @if (!empty($product->slug))
                    <a href="{{ route('web.products.details', $product->slug) }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center">
                        <i class="lni lni-info me-2"></i> Details
                    </a>
                @else
                    <button class="btn btn-outline-secondary btn-sm d-flex align-items-center justify-content-center" disabled>
                        <i class="lni lni-info me-2"></i> Details
                    </button>
               
               @endif
            </div>
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

