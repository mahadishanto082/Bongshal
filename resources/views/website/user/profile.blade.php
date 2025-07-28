@extends('layouts.website')

@section('title')
    Profile
@endsection

@section('content')
@include('website.share.user-custom-feature')
        <div class="gray py-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
            <div class="row">
                <!-- Sidebar -->
                <div class="col-xl-3 col-lg-4 col-md-5 mb-4">
                    <div class="rounded p-3 h-100" style="min-height: 100%; overflow-x: auto; color:white">
                        @include('website.share.user-menu')
                    </div>
                </div>


                <!-- Main Content -->
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Profile Info Card -->
                    <div class="card-wrap border rounded mb-4">
                        <div class="card-wrap-header px-3 py-2 br-bottom d-flex">
                            <h4 class="fs-md ft-bold mb-1">Profile info</h4>
                        </div>

                        <div class="card-wrap-body px-3 py-3">
                            <form method="post"
                                  enctype="multipart/form-data"
                                  action="{{ route('web.user.profile.update') }}"
                                  class="row">
                                @csrf

                                <div class="col-md-12 mb-3">
                                    <label class="small text-dark ft-medium">Name *</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', auth('web')->user()->name) }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="small text-dark ft-medium">Mobile</label>
                                    <input type="number" name="mobile"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           value="{{ old('mobile', auth('web')->user()->mobile) }}">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="small text-dark ft-medium">Image</label>
                                    <input type="file" accept="image/*" name="image"
                                           class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-dark">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="card-wrap border rounded mb-4">
                        <div class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                            <h4 class="fs-md ft-bold mb-1">Password update</h4>
                        </div>

                        <div class="card-wrap-body px-3 py-3">
                            <form method="post" action="{{ route('web.user.password.update') }}" class="row">
                                @csrf

                                <div class="col-md-12 mb-3">
                                    <label class="small text-dark ft-medium">Current Password *</label>
                                    <input type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="small text-dark ft-medium">New Password *</label>
                                    <input type="password"
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           name="new_password" required>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="small text-dark ft-medium">Confirm New Password *</label>
                                    <input type="password"
                                           class="form-control"
                                           name="new_password_confirmation" required>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-dark">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /.main content -->
            </div>
        </div>
    </section>
        <!-- ======================= Dashboard Detail End ======================== -->

        
@endsection
