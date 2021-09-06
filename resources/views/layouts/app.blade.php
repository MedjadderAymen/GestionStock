<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Parc IT</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset("../assets/img/brand/Stock.png")}}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset("../assets/vendor/nucleo/css/nucleo.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css")}}"
          type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset("../assets/css/argon.css?v=1.2.0")}}" type="text/css">

    @yield('import')
</head>

<body>
<!-- Sidenav -->
@include('layouts.sidebar')
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
@include('layouts.navbar')
<!-- Header -->
@yield("header")
<!-- Header -->
@yield('cards')
<!-- Page content -->
    <div class="container-fluid mt--7">
        @yield('content')
    </div>
</div>

<!-- Argon Scripts -->
<!-- Core -->
<script src="{{asset("../assets/vendor/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("../assets/vendor/js-cookie/js.cookie.js")}}"></script>
<script src="{{"../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"}}"></script>
<script src="{{asset("../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js")}}"></script>
<!-- Optional JS -->
<script src="{{asset("../assets/vendor/chart.js/dist/Chart.min.js")}}"></script>
<script src="{{asset("../assets/vendor/chart.js/dist/Chart.extension.js")}}"></script>
<!-- Argon JS -->
<script src="{{asset("../assets/js/argon.js?v=1.2.0")}}"></script>

@yield('script')

</body>

</html>
