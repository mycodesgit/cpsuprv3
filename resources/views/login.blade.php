<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>CPSU PR | Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/modules/fontawesome-free-V6/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('template/assets/modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/components.min.css"') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/assets/img/cpsulogov4.png') }}">
    
</head>

<body class="layout-4" style="background-color: #f4f6f9">

    <div id="app">
        <section class="section">
            <div class="container" style="margin-top: 190px">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="login-brand" style="z-index: 999; margin-top: -50px">
                                <img src="{{ asset('template/assets/img/cpsulogov4.png') }}" alt="logo" width="100" class="">
                            </div>
                            <h4 style="text-align: center; margin-top: -20px">CPSU PR</h4>
                            <div class="card-body">
                                <form action="{{route('postLogin')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="text" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                tabindex="3" id="remember-me">
                                            <label class="custom-control-label" for="remember-me">Show Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="auth-register.html">Create One</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/bundles/lib.vendor.bundle.js"></script>
    <script src="js/CodiePie.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="js/scripts.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- auth-login.html  Tue, 07 Jan 2020 03:39:47 GMT -->

</html>
