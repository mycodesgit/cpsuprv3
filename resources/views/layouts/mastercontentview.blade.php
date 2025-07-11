<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Content</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/fontawesome-free-V6/css/all.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/components.min.css') }}">
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <!-- <div style="height: 15px; background: #f4f6f9; position: fixed; top: 0; left: 0; right: 0; z-index: 998;"></div>
        
        <nav class="navbar navbar-expand-lg main-navbar" style="background: linear-gradient(135deg, #3a7d5c 0%, #1f5036 100%); position: fixed; margin-top: 15px; border-radius: 5px; margin-right: 10px; margin-left: 10px; z-index: 999">
            <div class="container">
                <a href="index-2.html" class="navbar-brand sidebar-gone-hide">CPSU PR</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
            </div>
        </nav> -->

            <!-- Start app main Content -->
            <div class="main-content" style="margin-top: -60px;">
                @yield('body')
            </div>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('template/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('template/js/CodiePie.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>
</body>


</html>
