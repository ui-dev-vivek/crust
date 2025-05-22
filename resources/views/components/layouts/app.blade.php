<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="{{$metsData['description'] ?? ''}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <title>{{$metsData['title'] ?? ''}}</title>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:title" content="{{$metsData['title'] ?? ''}}">
    <meta property="og:description" content="{{$metsData['description'] ?? ''}}">
    <meta property="og:image" content="{{asset($metsData['image'] ?? '')}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="robots" content="{{$metsData['robots'] ?? 'index, follow'}}">
    <meta name="googlebot" content="{{$metsData['robots'] ?? 'index, follow'}}">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "headline": "{{ $metsData['title'] ?? '' }}",
            "name": "{{ $metsData['title'] ?? '' }}",
            "description": "{{ $metsData['description'] ?? '' }}",
            "url": "{{ url()->current() }}",
            "image": {
                "@type": "ImageObject",
                "url": "{{ asset($metsData['image'] ?? '') }}"
            },
            "inLanguage": "en-IN",
            "author": {
                "@type": "Organization",
                "name": "{{ $metsData['author'] ?? 'Your Site Name' }}"
            },
            "publisher": {
                "@type": "Organization",
                "name": "{{ $metsData['publisher'] ?? 'Your Site Name' }}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{ asset($metsData['logo'] ?? 'images/logo.png') }}"
                }
            },
            "datePublished": "{{ $metsData['published_at'] ?? now()->toIso8601String() }}",
            "dateModified": "{{ $metsData['updated_at'] ?? now()->toIso8601String() }}"
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('assets/img/icons/icon-72x72.png')}}">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{asset('assets/img/icons/icon-96x96.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/icons/icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('assets/img/icons/icon-167x167.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/icons/icon-180x180.png')}}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/theam/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/brands.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/solid.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/theam/css/nice-select.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" id="suha-style.css">
    <!-- Web App Manifest -->
    <!-- <link rel="manifest" href="manifest.json"> -->
    @livewireStyles
</head>

<body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only"></div>
        </div>
    </div>

    @livewire('utility.navbar',['type' => $navbarType?? 'home'])

    <div class="bg-white shadow toast pwa-install-alert" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000" data-bs-autohide="true">
        <div class="toast-body">
            <div class="mb-2 content d-flex align-items-center"><img src="assets/img/icons/icon-72x72.png" alt="">
                <h6 class="mb-0">Add to Home Screen</h6>
                <button class="btn-close ms-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div><span class="mb-0 d-block">Add Suha on your mobile home screen. Click the<strong class="mx-1">Add to Home Screen</strong>button &amp; enjoy it like a regular app.</span>
        </div>
    </div>
    <div class="page-content-wrapper">
        {{ $slot }}
    </div>
    <!-- Internet Connection Status-->
    <div class="mb-4 internet-connection-status" id="internetStatus"></div>
    {{-- <a href=""><div class="internet-connection-status bg-success" id="cartstatus">3 items in cart &nbsp;&nbsp;<i class='bx bx-arrow-back bx-flip-horizontal bx-flashing' ></i></div></a> --}}
    <!-- Footer Nav-->
    <div class="footer-nav-area" id="footerNav">
        <div class="suha-footer-nav">
            {{-- max 6 --}}
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0 rtl-flex-d-row-r">
                <li><a href="/"><i class="fa-solid fa-house"></i>Home</a></li>
                <li><a href=""><i class="fa-solid fa-bag-shopping"></i>Cart</a></li>
                <li><a href=""><i class="fa-solid fa-chart-line"></i>Trend</a></li>

                <li><a href=""><i class="fa-solid fa-comment-dots"></i>Support</a></li>

            </ul>
        </div>
    </div>
    <!-- All JavaScript Files-->
    @livewireScripts
    <script src="{{asset('assets/theam/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.passwordstrength.js')}}"></script>
    <script src="{{asset('assets/theam/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/theam/js/theme-switching.js')}}"></script>
    <script src="{{asset('assets/theam/js/no-internet.js')}}"></script>
    <script src="{{asset('assets/theam/js/active.js')}}"></script>
    <script src="{{asset('assets/theam/js/pwa.js')}}"></script>
</body>

</html>
