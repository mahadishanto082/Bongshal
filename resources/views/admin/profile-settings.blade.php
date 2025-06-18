@extends('layouts.admin')

@section('title')
    Profile Settings
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Profile Settings</h4>
            <p class="mg-b-0">Here is Profile Settings</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-md-6 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-header">
                    Password Update
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.password.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Current Password *</label>

                                        <input type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               autocomplete="new-password"
                                               placeholder="Current Password"
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
                                               placeholder="New Password"
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
                                               placeholder="Confirm New Password"
                                               required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update Password</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-header">
                    Email Update
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.email.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Current Email *</label>

                                        <input type="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               name="email"
                                               autocomplete="new-email"
                                               placeholder="Current Email"
                                               required
                                        >

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">New Email *</label>

                                        <input type="email"
                                               class="form-control @error('new_email') is-invalid @enderror"
                                               name="new_email"
                                               autocomplete="new-new_email"
                                               placeholder="New Email"
                                               required
                                        >

                                        @error('new_email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Confirm New Email *</label>

                                        <input type="email"
                                               class="form-control"
                                               name="new_email_confirmation"
                                               autocomplete="new-email"
                                               placeholder="Confirm New Email"
                                               required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update Email</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
