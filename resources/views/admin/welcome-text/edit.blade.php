@extends('layouts.admin')

@section('title')
    Welcome Text | Edit
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Welcome Text | Edit</h4>
            <p class="mg-b-0">{{ $welcomeText->title }} - Edit this welcome message</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-12 col-xl-12 mg-t-20 mg-xl-t-0">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.WelcomeTexts.update', $welcomeText->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Title <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="title" value="{{ old('title', $welcomeText->title) }}">
                                        @error('title')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Content <span class="tx-danger">*</span></label>
                                        <textarea class="form-control" name="content" rows="5">{{ old('content', $welcomeText->content) }}</textarea>
                                        @error('content')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                        <select class="form-control" name="status">
                                            <option value="" disabled selected hidden>Select Status</option>
                                            <option value="Active" {{ old('status', $welcomeText->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $welcomeText->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
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
