<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Rashiqul Rony">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <!-- vendor css -->
    <link href="{{ asset('assets/admin/lib/fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bracket.css') }}" rel="stylesheet" >
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" >
    @yield('_css')
</head>
<body>

@include('admin.shared.navbar')

@include('admin.shared.header')

<div class="br-mainpanel">
    @yield('page-info')

    <div class="br-pagebody" style="min-height: calc(100vh - 270px);">
        @yield('content')
    </div>

    @include('admin.shared.footer')
</div>

<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content bd-0 tx-14">
            <div class="modal-header bg-dance pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold text-white">Are you sure ??</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-20">
                <form id="deleteForm" action="" method="post">
                    @csrf
                    @method('DELETE')
                    <p class="mg-b-5">Do you want delete this row ??</p>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button onclick="event.preventDefault(); document.getElementById('deleteForm').submit();" type="button" class="btn btn-sm btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/admin/lib/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<script src="{{ asset('assets/admin/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/rickshaw/vendor/d3.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/rickshaw/vendor/d3.layout.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/admin/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/admin/lib/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/lib/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bracket.js') }}"></script>
<script src="{{ asset('assets/admin/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>
<script>
    $(function(){
        'use strict'
        $(window).resize(function(){
            minimizeMenu();
        });
        minimizeMenu();
        function minimizeMenu() {
            if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
        }

    });
    function deleteRow(routes) {
        if (routes) {
            $("#deleteForm").attr('action', routes);
            $("#deleteModal").modal('show')
        } else {
            alert("This row can't delete.")
        }
    }
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Choose One",
        });
    });

    @if (session('success'))
    toastr.success("{{ session('success') }}", 'Success.. !!', {
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
        timeOut: 3000
    });
    @elseif(session('error'))
    toastr.error("{{ session('error') }}", 'Error.. !!', {
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
        timeOut: 3000
    });
    @elseif(session('info'))
    toastr.info("{{ session('info') }}", 'Info.. !!', {
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
        timeOut: 3000
    });
    @elseif(session('warning'))
    toastr.error("{{ session('warning') }}", 'Warning.. !!', {
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "progressBar": true,
        timeOut: 3000
    });
    @endif
</script>
@stack('_js')

</body>
</html>
