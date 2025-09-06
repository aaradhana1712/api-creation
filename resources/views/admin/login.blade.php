<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
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
</head>
<body>
    <div class="login-page">
        <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
                <div class="row">
                    <!-- Logo & Information Panel-->
                    <div class="col-lg-6">
                        <div class="info d-flex align-items-center">
                            <div class="content">
                                <div class="logo">
                                    <h1>Dashboard</h1>
                                </div>
                                <p>Please login to access your admin dashboard.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Form Panel -->
                    <div class="col-lg-6 bg-white">
                        <div class="form d-flex align-items-center">
                            <div class="content">
                                <form method="POST" action="{{ route('admin.login.post') }}" class="form-validate">
                                    @csrf
                                    <div class="form-group">
                                        <input id="login-username" type="email" name="email" required 
                                               value="{{ old('email') }}" 
                                               class="input-material @error('email') is-invalid @enderror">
                                        <label for="login-username" class="label-material">Email</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="login-password" type="password" name="password" required 
                                               class="input-material @error('password') is-invalid @enderror">
                                        <label for="login-password" class="label-material">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="remember" id="remember" class="checkbox-template">
                                        <label for="remember">Remember Me</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                                <a href="#" class="forgot-pass">Forgot Password?</a><br>
                                <small>Do not have an account? </small><a href="{{ route('admin.register') }}" class="signup">Signup</a>
                                
                                <!-- Success/Error Messages -->
                                @if(session('success'))
                                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>2024 &copy; Your company.</p>
        </div>
    </div>
    
    <!-- JavaScript files-->
    <script src="{{ asset('Admin_Template-main/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('Admin_Template-main/js/front.js') }}"></script>
</body>
</html>