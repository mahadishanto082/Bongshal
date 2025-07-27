@extends('layouts.admin')

@section('title')
    Banner | Edit
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Banner | Edit</h4>
            <p class="mg-b-0">{{ $banner->title }} - Edit this information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Title</label>
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $banner->title) }}">
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Sub Title</label>
                                        <input class="form-control" type="text" name="sub_title" value="{{ old('sub_title', $banner->sub_title) }}">
                                        @error('sub_title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control" name="description">{{ old('description', $banner->description) }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Image (1900x1080) <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="file" name="image" accept="image/*">
                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @if ($banner->image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Image" height="100">
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                        <select class="form-control select2" name="status">
                                            <option value="" selected hidden disabled>Select status</option>
                                            <option value="Active" {{ old('status', $banner->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $banner->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div><!-- form-layout-footer -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
