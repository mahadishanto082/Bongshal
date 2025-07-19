@extends('layouts.admin')

@section('title')
    Writer | Edit
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Writer | Edit</h4>
            <p class="mg-b-0">{{ $data->name }} - Edit this information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.writers.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name', $data->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Bio</label>
                                        <textarea class="form-control" type="text" name="bio">{{ old('bio', $data->bio) }}</textarea>
                                        @error('bio')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image (300x300)</label>
                                        <input class="form-control" type="file" name="image" accept="image/*">
                                        @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Feature <small class="text-danger">(For Home Page)</small></label>
                                        <select class="form-control select2" name="feature">
                                            <option value="" selected hidden disabled></option>
                                            <option value="Yes" {{ $data->feature == 'Yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="No" {{ $data->feature == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('feature')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Status</label>
                                        <select class="form-control select2" name="status">
                                            <option value="" selected hidden disabled></option>
                                            <option value="Active" {{ $data->status == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ $data->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
