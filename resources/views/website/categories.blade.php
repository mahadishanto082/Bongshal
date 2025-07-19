@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Categories" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('title')
    Categories
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subjects</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="gray">
        <div class="container">
            @if(!empty($categories))
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-4">
                            <div class="cats_side_wrap text-center mx-auto bg-white shadow mb-3">
                                <div class="sl_cat_01">
                                    <div class="d-inline-flex align-items-center justify-content-center p-4 circle mb-2 border">
                                        <a href="{{ route('web.categories.products', $category->slug) }}" class="d-block">
                                            <img src="{{ asset('storage/categories/'. $category->image) }}" class="img-fluid" width="40" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="sl_cat_02"><h6 class="m-0 ft-medium fs-sm"><a href="{{ route('web.categories.products', $category->slug) }}">{{ $category->name }}</a></h6></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endsection
