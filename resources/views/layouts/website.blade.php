
<!DOCTYPE html>
<html lang="zxx">
<head>
    @php($assetVersion = '?v=1.9')
    <meta charset="utf-8">
    <meta name="author" content="Rashiqul Rony"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('_seo')
    <title>Bongshal</title> 
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link href="{{ asset('assets/website/css/styles.css' . $assetVersion) }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/custom.css' . $assetVersion) }}" rel="stylesheet">
    <link href="{{ asset('assets/website/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="{{ asset('assets/website/plugins/sweetalert2/sweetalert2.all.min.css') }}" rel="stylesheet">
    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @yield('_css')
    <style>
        :root {
            --primary: #fa4c06;
            --primary-soft: #ff6a2e;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
            --shadow-premium: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            --radius-premium: 16px;
        }

        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: #fcfcfc;
        }

        [v-cloak] { display: none !important; }

        .glass-card {
            background: var(--bg-glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--border-glass);
            border-radius: var(--radius-premium);
            box-shadow: var(--shadow-premium);
            transition: var(--transition-smooth);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .btn-premium {
            background: linear-gradient(135deg, var(--primary), var(--primary-soft));
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: var(--transition-smooth);
            box-shadow: 0 4px 15px rgba(250, 76, 6, 0.3);
        }

        .btn-premium:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(250, 76, 6, 0.4);
            color: white;
        }
    </style>
</head>
<body>
<div class='loader'>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--dot'></div>
    <div class='loader--text'></div>
</div>

<div id="main-wrapper">
    @include('website.share.header')

    @yield('content')

    @include('website.share.footer')
</div>
<script src="{{ asset('assets/website/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/website/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/website/js/slick.js') }}"></script>
<script src="{{ asset('assets/website/js/slider-bg.js') }}"></script>
<script src="{{ asset('assets/website/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/website/js/smoothproducts.js') }}"></script>
<script src="{{ asset('assets/website/js/snackbar.min.js') }}"></script>
<script src="{{ asset('assets/website/js/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('assets/website/js/custom.js' . $assetVersion) }}"></script>
<script src="{{ asset('assets/website/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/website/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/vue.js') }}"></script>
<script src="{{ asset('assets/js/vue.resource.js') }}"></script>
<script src="{{ asset('assets/js/cart.js' . $assetVersion) }}"></script>
<script>
    function openWishlist() {
        document.getElementById("Wishlist").style.display = "block";
    }

    function closeWishlist() {
        document.getElementById("Wishlist").style.display = "none";
    }

    function openCart() {
        document.getElementById("Cart").style.display = "block";
    }

    function closeCart() {
        document.getElementById("Cart").style.display = "none";
    }

    function openSearch() {
        document.getElementById("Search").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("Search").style.display = "none";
    }

    @if (session('success'))
        toastr.success("{{ session('success') }}", 'Success.. !!', {
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,
            timeOut: 5000
        });
    @elseif(session('info'))
        toastr.info("{{ session('info') }}", 'Info.. !!', {
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,
            timeOut: 5000
        });
    @elseif(session('error'))
        toastr.error("{{ session('error') }}", 'Error.. !!', {
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,
            timeOut: 5000
        });
    @elseif(session('warning'))
        toastr.warning("{{ session('warning') }}", 'Warning.. !!', {
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "progressBar": true,
            timeOut: 5000
        });
    @endif

    document.addEventListener("DOMContentLoaded", function () {
        const currentPageUrl = window.location.href;

        // Get all the <a> elements inside the <ul> with class "dahs_navbar"
        const navLinks = document.querySelectorAll('.dahs_navbar a');

        // Loop through each link and check if its href matches the current page URL
        navLinks.forEach(function (link) {
            if (currentPageUrl.includes(link.href)) {
                // Add the "active" class to the element
                link.classList.add('active');
            }
        });
    });

    function populateDeleteForm(route) {
        const form = document.getElementById('delete-form');
        form.action = route;

        Swal.fire({
            icon: "warning",
            title: "Are you sure want to delete this?",
            showCancelButton: true,
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function productQuckView(route) {
        $.ajax({
            url: route,
            type: "GET",
            async: true,
            data: {
            }, success: function (res) {
                console.log(res)
                if (res.status === true) {
                    $(".quick_view_wrap").html(res.data)
                    $("#quickview").modal('show')
                } else {
                    console.log(res)
                }
            }
        });

        // $("#quickview").modal('show')
    }

    jQuery('a[target^="_new"]').click(function() {
        var width = window.innerWidth * 0.66 ;
        // define the height in
        var height = width * window.innerHeight / window.innerWidth ;
        // Ratio the hight to the width as the user screen ratio
        window.open(this.href , 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2));

    });
</script>

@stack('_js')
<!-- Swiper JS -->


</body>
</html>
