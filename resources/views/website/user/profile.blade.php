@extends('layouts.website')

@section('title')
    Profile
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================= Dashboard Detail ======================== -->
    <section class="middle">
        <div class="container">
            <div class="row align-items-start justify-content-between">
                @include('website.share.user-menu')

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <div class="row align-items-center">
                        <div class="card-wrap border rounded mb-4">
                            <div
                                class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                                <div class="card-header-flex">
                                    <h4 class="fs-md ft-bold mb-1">Profile info</h4>
                                </div>
                            </div>

                            <div class="card-wrap-body px-3 py-3">
                                <form class="row m-0"
                                      method="post"
                                      enctype="multipart/form-data"
                                      action="{{ route('web.user.profile.update') }}"
                                >
                                    @csrf

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">Name *</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', auth('web')->user()->name) }}" required/>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">Mobile</label>
                                            <input type="number" name="mobile"
                                                   class="form-control @error('mobile') is-invalid @enderror"
                                                   value="{{ old('mobile', auth('web')->user()->mobile) }}"/>

                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">Image</label>
                                            <input type="file" accept="image/*" name="image"
                                                   class="form-control @error('image') is-invalid @enderror"/>

                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card-wrap border rounded mb-4">
                            <div
                                class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                                <div class="card-header-flex">
                                    <h4 class="fs-md ft-bold mb-1">Password update</h4>
                                </div>
                            </div>

                            <div class="card-wrap-body px-3 py-3">
                                <form class="row m-0" method="post" action="{{ route('web.user.password.update') }}">
                                    @csrf

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">Current Password *</label>

                                            <input type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password"
                                                   autocomplete="new-password"
                                                   required
                                            >

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">New Password *</label>

                                            <input type="password"
                                                   class="form-control @error('new_password') is-invalid @enderror"
                                                   name="new_password"
                                                   autocomplete="new-new_password"
                                                   required
                                            >

                                            @error('new_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="small text-dark ft-medium">Confirm New Password *</label>

                                            <input type="password"
                                                   class="form-control"
                                                   name="new_password_confirmation"
                                                   autocomplete="new-password"
                                                   required
                                            >
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-dark">Update Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    @include('website.share.user-custom-feature')
@endsection
