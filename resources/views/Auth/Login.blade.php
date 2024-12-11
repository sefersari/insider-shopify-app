
<!DOCTYPE html>

<html class="loading "
      lang="de"
      data-textdirection="ltr"
>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="5GnHfNOC9xGjyXkfRpEHQqOusAvDsLWkzB8e6edb">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Vuexy - Bootstrap HTML & Laravel admin template</title>
    <link rel="apple-touch-icon" href="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../images/logo/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendors.min%EF%B9%96id=cd237de63f2f3811a359.css')}}" />

    <!-- END: Vendor CSS-->

    <link rel="stylesheet" href="{{ asset('assets/vendors/css/extensions/toastr.min%EF%B9%96id=f46a48664f1939d7e483.css') }}">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/core%EF%B9%96id=b969fd28478dc1ee887a.css')}}" />


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/base/core/menu/menu-types/vertical-menu%EF%B9%96id=d6fb64b9fc56ebf927d5.css')}}" />



    <link rel="stylesheet" href="{{asset('assets/css/base/plugins/forms/form-validation%EF%B9%96id=593257ee1d345f37adb6.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/base/pages/authentication%EF%B9%96id=a4da8906bbc198d47025.css')}}">

    <!-- laravel style -->
    <link rel="stylesheet" href="{{ asset('assets/css/overrides%EF%B9%96id=a3a7abd8c9ef0f541059.css') }}" />

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('assets/css/base/plugins/extensions/ext-component-toastr.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/style%EF%B9%96id=68b329da9893e34099c7.css') }}" />


    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendors.min%EF%B9%96id=cd237de63f2f3811a359.css') }}" />


</head>



<body class="vertical-layout vertical-menu-modern   blank-page blank-page"
      data-menu="vertical-menu-modern"
      data-col="blank-page"
      data-framework="laravel">

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper">
        <div class="content-body">


            <div class="auth-wrapper auth-basic px-2">
                <div class="auth-inner my-2">
                    <!-- Login basic -->
                    <div class="card mb-0">
                        <div class="card-body">
                            <h4 class="card-title mb-1">Welcome to Shopify App! 👋</h4>
                            <p class="card-text mb-2">Please sign-in to your account.</p>
                            <form class="auth-login-form mt-2" action="{{ route('login-action') }}" method="POST">
                                @csrf
                                <div class="mb-1">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input
                                        type="text"
                                        class="form-control @if($errors->any()) is-invalid @endif"
                                        id="login-email"
                                        name="email"
                                        placeholder="john@example.com"
                                        aria-describedby="login-email"
                                    />
                                    @if($errors->any())
                                        <div class="text-danger font-small-2">{{ $errors->get('email')[0] }}</div>
                                    @endif
                                </div>

                                <div class="mb-1">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="login-password">Password</label>
                                    </div>
                                    <div class="input-group input-group-merge form-password-toggle">
                                        <input
                                            type="password"
                                            class="form-control form-control-merge"
                                            id="login-password"
                                            name="password"
                                            tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="login-password"
                                        />
                                        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
                            </form>

                            <p class="text-center mt-2">
                                <a href="{{ route('register') }}">
                                    <span>Create an account</span>
                                </a>
                            </p>
                        </div>
                    </div>
                    <!-- /Login basic -->
                </div>
            </div>

        </div>
    </div>
</div>
<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/vendors/js/vendors.min%EF%B9%96id=7dca1a1f6b86fd5d70ac.js') }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/vendors/js/ui/jquery.sticky%EF%B9%96id=17f0788e54b9dc4eb93d.js') }}"></script>
<script src="{{ asset('assets/vendors/js/extensions/toastr.min%EF%B9%96id=4822c7d98e89e261b45d.js') }}"></script>
@include('Alert.Toastr')
</body>

</html>
