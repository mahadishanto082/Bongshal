@extends('layouts.website')

@section('title')
    Addresses
@endsection

@section('content')
    <div class="gray py-3">
        <div class="container">
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Addresses</li>
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
                @include('website.share.user-menu')

                <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <!-- row -->
                    <div class="row align-items-start">
                        <!-- Single -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <a href="{{ route('web.user.user_addresses.create') }}" class="btn stretched-link borders full-width">
                                    <i class="fas fa-plus mr-2"></i>Add New Address
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- row -->

                    <!-- row -->
                    <div class="row align-items-start">
                        @foreach($data as $datum)
                        <!-- Single -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="card-wrap border rounded mb-4">
                                <div
                                    class="card-wrap-header px-3 py-2 br-bottom d-flex align-items-center justify-content-between">
                                    <div class="card-header-flex">
                                        <h4 class="fs-md ft-bold mb-1">{{ ucfirst($datum->address_type) }} Address</h4>
                                        @if($datum->is_default)
                                        <p class="m-0 p-0"><span class="text-success bg-light-success small ft-medium px-2 py-1">Primary Account</span></p>
                                        @endif
                                    </div>

                                    <div class="card-head-last-flex">
                                        <!-- Button -->
                                        <a class="border p-3 circle text-dark d-inline-flex align-items-center justify-content-center"
                                           href="{{ route('web.user.user_addresses.edit', $datum->id) }}">
                                            <i class="fas fa-pen-nib position-absolute"></i>
                                        </a>
                                        <!-- Button -->
                                        <a href="javascript:void(0)"
                                           onclick="populateDeleteForm('{{ route('web.user.user_addresses.destroy', $datum->id) }}')"
                                           class="border bg-white text-danger p-3 circle text-dark d-inline-flex align-items-center justify-content-center">
                                            <i class="fas fa-times position-absolute"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="card-wrap-body px-3 py-3">
                                    <h5 class="ft-medium mb-1">{{ $datum->name }}</h5>
                                    <p>
                                        {!! $datum->address_line ? "$datum->address_line" : "" !!}
                                        {{ $datum->division }}<br>
                                        {{ $datum->district }}
                                    </p>
                                    <p class="lh-1">
                                        <span class="text-dark ft-medium">Email:</span>
                                        {{ $datum->email }}
                                    </p>
                                    <p><span class="text-dark ft-medium">Call:</span> {{ $datum->phone }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- row -->
                </div>
            </div>
        </div>
    </section>
    <!-- ======================= Dashboard Detail End ======================== -->

    @include('website.share.user-custom-feature')
@endsection
