<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Dark Bootstrap Admin')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('Admin_Template-main/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ asset('Admin_Template-main/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="{{ asset('Admin_Template-main/css/font.css') }}">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('Admin_Template-main/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('Admin_Template-main/css/custom.css') }}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('Admin_Template-main/img/favicon.ico') }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header Navigation -->
    @include('admin.partials.header')
    
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation -->
        @include('admin.partials.sidebar')
        
        <!-- Main Page Content -->
        <div class="page-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">@yield('page-title', 'Dashboard')</h2>
                </div>
            </div>
            
            <!-- Main Content Area -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('admin.partials.footer')

    <!-- JavaScript files-->
    <script src="{{ asset('Admin_Template-main/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/js/charts-home.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/js/front.js') }}"></script>
    
    @stack('scripts')
</body>
</html>