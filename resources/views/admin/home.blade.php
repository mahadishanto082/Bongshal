@extends('layouts.admin')

@section('title')
    Dashboard
@endsection

@section('page-info')
    <div class="br-pagetitle">
        <i class="icon ion-ios-home-outline"></i>
        <div>
            <h4>Dashboard</h4>
            <p class="mg-b-0">Here is today's information</p>
        </div>
    </div>
@endsection

@section('content')
    <div class="row row-sm">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today Orders</p>
                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $todayOrders }}</p>
                    </div>
                </div>
                <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->

        <div class="col-sm-6 col-xl-3">
            <div class="bg-info rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Orders</p>
                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">{{ $totalOrders }}</p>
                    </div>
                </div>
                <div id="ch1" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->

        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Today Sales</p>
                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">৳{{ number_format($todaySales) }}</p>
                    </div>
                </div>
                <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->

        <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
            <div class="bg-purple rounded overflow-hidden">
                <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                    <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                        <p class="tx-10 tx-spacing-1 tx-mont tx-semibold tx-uppercase tx-white-8 mg-b-10">Total Sales</p>
                        <p class="tx-24 tx-white tx-lato tx-bold mg-b-0 lh-1">৳{{ number_format($totalSales) }}</p>
                    </div>
                </div>
                <div id="ch3" class="ht-50 tr-y-1"></div>
            </div>
        </div><!-- col-3 -->
    </div>
@endsection
