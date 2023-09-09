<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; E-Commerce</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('/') }}fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}css/owl.theme.default.min.css">


    <link rel="stylesheet" href="{{ asset('/') }}css/aos.css">

    <link rel="stylesheet" href="{{ asset('/') }}css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>

    <div class="site-wrap">
        @include('frontend.inc.header')

        @yield('content')

        @include('frontend.inc.footer')
    </div>

    <script src="{{ asset('/') }}js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('/') }}js/jquery-ui.js"></script>
    <script src="{{ asset('/') }}js/popper.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap.min.js"></script>
    <script src="{{ asset('/') }}js/owl.carousel.min.js"></script>
    <script src="{{ asset('/') }}js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('/') }}js/aos.js"></script>
    @yield('customjs')
    <script src="{{ asset('/') }}js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (session()->get('success'))
            toastr.success("{{ session()->get('success') }}")
        @endif

        @if (session()->get('error'))
            toastr.error("{{ session()->get('error') }}")
        @endif

        @if (count($errors))
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

</body>

</html>
