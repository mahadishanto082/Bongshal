@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Register" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('title')
    Register
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mfliud">
                    <form class="border p-3 rounded" method="post" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label>Name *</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email *</label>

                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Mobile *</label>

                            <input type="number"
                                   class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                   value="{{ old('mobile') }}" autocomplete="mobile">

                            @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Password *</label>

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label>Confirm Password *</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <p>Agree with the terms and policy</p>
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input id="ddd" class="checkbox-custom" name="ddd" type="checkbox">
                                    <label for="ddd" class="checkbox-custom-label">Sign Up for the Newsletter</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">
                                Create Account
                            </button>
                        </div>

                        <div class="form-group">
                            <p class="text-center">Or</p>
                        </div>
                        
                        <p class="text-center">Already Have an account? <a href="{{ route('login') }}">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
