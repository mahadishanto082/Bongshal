@extends('layouts.admin')

@section('title')
    Category | Edit
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Category | Edit</h4>
            <p class="mg-b-0">{{ $data->name }} - Edit this information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25" data-select2-id="11">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" value="{{ old('name', $data->name) }}">
                                        @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Select Parent</label>
                                        <select class="form-control select2" name="parent">
                                            <option value="" selected hidden disabled></option>
                                            @if(!empty($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $data->parent_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('parent')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        <textarea class="form-control" type="text" name="description">{{ old('description', $data->description) }}</textarea>
                                        @error('description')
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
