@extends('layouts.website')

@section('title')
    Address create
@endsection

@section('content')
@include('website.share.user-custom-feature')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Address create</li>
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
            <div class="col-xl-3 col-lg-4 col-md-5 mb-4">
                                    <div class="rounded p-3 h-100" style="min-height: 100%; overflow-x: auto;">
                                        @include('website.share.user-menu')
                                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <form method="post" action="{{ route('web.user.user_addresses.store') }}">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-lg-12 col-xl-12 col-md-12 mb-3">
                                <h4 class="ft-medium fs-lg">Add New Address</h4>
                            </div>
                        </div>

                        @include('website.user.address.fields')
                    </form>
                    <!-- row -->
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

  
@endsection
