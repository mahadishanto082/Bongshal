@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Vendor Registration | Hajjshops" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, Vendor, Registration, Company, Bangladesh" />
@endsection

@section('title')
    Vendor Register
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Vendor Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <form class="border p-4 rounded" method="POST" action="{{ route('vendor.register') }}" enctype="multipart/form-data">
                        @csrf

                        <h3 class="mb-4">Shop Registration</h3>

                        <div class="form-group mb-3">
                            <label for="name">Name *</label>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email *</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="mobile">Mobile *</label>
                            <input id="mobile" type="text" 
                                   class="form-control @error('mobile') is-invalid @enderror" 
                                   name="mobile" value="{{ old('mobile') }}" required>
                            @error('mobile')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="company_name">Company Name</label>
                            <input id="company_name" type="text" 
                                   class="form-control @error('company_name') is-invalid @enderror" 
                                   name="company_name" value="{{ old('company_name') }}">
                            @error('company_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <textarea id="address" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      name="address" rows="3">{{ old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="company_logo">Company Logo (optional)</label>
                            <input id="company_logo" type="file" 
                                   class="form-control @error('company_logo') is-invalid @enderror" 
                                   name="company_logo" accept="image/*">
                            @error('company_logo')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password *</label>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation">Confirm Password *</label>
                            <input id="password_confirmation" type="password" 
                                   class="form-control" 
                                   name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Register as Vendor
                        </button>

                        -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
