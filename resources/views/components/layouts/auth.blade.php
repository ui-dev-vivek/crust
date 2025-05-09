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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Web App Manifest -->
    <!-- <link rel="manifest" href="manifest.json"> -->
    @livewireStyles
</head>

<body>

    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only"></div>
        </div>
    </div>

        {{ $slot }}

        <script>
            window.addEventListener('tost', event => {
                const { icon, title } = event.detail;

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: icon || "success",
                    title: title || "Done!"
                });
            });
        </script>
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

