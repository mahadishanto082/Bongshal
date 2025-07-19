@extends('layouts.admin')

@section('title')
    Profile Update
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-settings"></i>
        <div>
            <h4>Profile Update</h4>
            <p class="mg-b-0">Update your Profile</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="small text-dark ft-medium">Name *</label>
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name', auth('admin')->user()->name) }}" required/>

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
                                               value="{{ old('mobile', auth('admin')->user()->mobile) }}"/>

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
                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update Profile</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
