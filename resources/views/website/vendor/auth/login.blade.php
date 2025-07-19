@extends('layouts.website')

@section('_seo')
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="Hajjshops | Login" />
    <meta property="og:site_name" content="Hajjshops.com" />
    <meta property="og:description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('logo.png') }}" />
    <meta name="author" content="Rashiqul Rony">
    <meta name="description" content="{{ getSetting()->title ?? 'বাংলাদেশের বিশ্বস্ত অনলাইন শপ । সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি)' }}">
    <meta name="keywords" content="Hajj, Shops, HajjShop.Com, বাংলাদেশের বিশ্বস্ত অনলাইন শপ, সারাদেশে ক্যাশ অন ডেলিভারি (৪৮ থেকে ৭২ ঘণ্টার মধ্যে নিশ্চিত ডেলিভারি), সঠিক মূল্য, নিরাপদ পেমেন্ট, ডেলিভারী, ২৪/৭ কাস্টমার কেয়ার, হজ্জ সামগ্রী">
@endsection

@section('title')
    Vendor Login
@endsection

@section('_css')
    <style>
        .input-group-pass {
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            color: #495057;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: 52px;
        }
    </style>
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Shop Login</li>
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
                    <form class="border p-3 rounded" method="POST" action="{{ route('vendor.login') }}">
                        @csrf

                        {{-- Optional error flash --}}
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password *</label>
                            <div class="input-group mb-3">
                                <input id="password" type="password"
                                       class="form-control password @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="current-password">
                                <div class="input-group-append">
                                    <label class="input-group-pass">
                                        <input type="checkbox" onclick="togglePassword()"> &nbsp; Show Password
                                    </label>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-1">
                                    <input class="checkbox-custom" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="checkbox-custom-label">Remember Me</label>
                                </div>
                                <div class="eltio_k2">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forget Password?</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">
                                Login
                            </button>
                        </div>
                        <p class="text-center">New User? <a href="{{ route('vendor.register') }}">Register Here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('_js')
    <script>
        function togglePassword() {
            var x = document.getElementById("password");
            x.type = x.type === "password" ? "text" : "password";
        }
    </script>
@endpush
