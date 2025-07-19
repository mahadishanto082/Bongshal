@extends('layouts.vendor')

@section('content')
<div class="d-flex justify-content-center mt-5 pt-3">
    <div class="w-100" style="max-width: 1100px;"> {{-- Central wrapper with max width --}}

        {{-- Summary Cards --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Today Orders</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Create Post Section --}}
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Create New Product</span>
                <a href="{{ route('vendor.products.create') }}" class="btn btn-primary btn-sm">Create</a>

            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Active products</span>
                <a href="  {{route('vendor.products.index')}}" class="btn btn-primary btn-sm">View</a>

            </div>
        </div>

        {{-- Active Orders Section --}}
       
    </div>
</div>
@endsection