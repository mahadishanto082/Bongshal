@extends('layouts.website')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">হোম</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
                    <form class="border p-3 rounded" method="post" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label>Email *</label>

                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
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
                            <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
