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
            <div class="navbar-bg"></div>

            <!-- Start app top navbar -->
            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="container">
                    <a href="" class="navbar-brand sidebar-gone-hide">CPSU PR</a>
                    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
                    
                </div>
            </nav>

            <!-- Start app main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Top Navigation</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Layout</a></div>
                            <div class="breadcrumb-item">Top Navigation</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <h2 class="section-title">This is Example Page</h2>
                        <p class="section-lead">This page is just an example for you to create your own page.</p>
                        <div class="card">
                            <div class="card-header">
                                <h4>Example Card</h4>
                            </div>
                            <div class="card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="card-footer bg-whitesmoke">This is card footer</div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Start app Footer part -->
            <footer class="main-footer">
                <div class="footer-left">
                    <div class="bullet"></div> <a href="templateshub.net">Templates Hub</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
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
