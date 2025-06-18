@extends('layouts.admin')

@section('title')
    Setting
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-settings"></i>
        <div>
            <h4>Setting</h4>
            <p class="mg-b-0">Update your website settings</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Title</label>
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $setting ? $setting->title : '') }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Address</label>
                                        <input class="form-control" type="text" name="address" value="{{ old('address', $setting ? $setting->address : '') }}">
                                        @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email</label>
                                        <input class="form-control" type="text" name="email" value="{{ old('email', $setting ? $setting->email : '') }}">
                                        @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email 2</label>
                                        <input class="form-control" type="text" name="email_2" value="{{ old('email_2', $setting ? $setting->email_2 : '') }}">
                                        @error('email_2')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Mobile</label>
                                        <input class="form-control" type="text" name="mobile" value="{{ old('mobile', $setting ? $setting->mobile : '') }}">
                                        @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Mobile 2</label>
                                        <input class="form-control" type="text" name="mobile_2" value="{{ old('mobile_2', $setting ? $setting->mobile_2 : '') }}">
                                        @error('mobile_2')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Facebook link</label>
                                        <input class="form-control" type="text" name="facebook" value="{{ old('facebook', $setting ? $setting->facebook : '') }}">
                                        @error('facebook')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Instagram link</label>
                                        <input class="form-control" type="text" name="instagram" value="{{ old('instagram', $setting ? $setting->instagram : '') }}">
                                        @error('instagram')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Linkedin link</label>
                                        <input class="form-control" type="text" name="linkedin" value="{{ old('linkedin', $setting ? $setting->linkedin : '') }}">
                                        @error('linkedin')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Youtube link</label>
                                        <input class="form-control" type="text" name="youtube" value="{{ old('youtube', $setting ? $setting->youtube : '') }}">
                                        @error('youtube')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Twitter link</label>
                                        <input class="form-control" type="text" name="twitter" value="{{ old('twitter', $setting ? $setting->twitter : '') }}">
                                        @error('twitter')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Logo</label>
                                        <input class="form-control" type="file" accept="image/*" name="logo" >
                                        @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    @if($setting && $setting->logo)
                                        <img src="{{ asset('storage/logo/'. $setting->logo) }}" width="100">
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Shipping Dhaka City<span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="shipping_in_dhaka" value="{{ old('shipping_in_dhaka', $setting ? $setting->shipping_in_dhaka : '') }}">
                                        @error('shipping_in_dhaka')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Shipping Outside Dhaka City <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="number" min="0" max="99999999" step="0.01" name="shipping_out_dhaka" value="{{ old('shipping_out_dhaka', $setting ? $setting->shipping_out_dhaka : '') }}">
                                        @error('shipping_out_dhaka')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
