<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>ورود</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/css/style.min.css">
<link rel="stylesheet" href="{{ asset('plugins/alertify/css/alertify.rtl.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/alertify/css/themes/bootstrap.rtl.css') }}">
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form" action="{{ route('customer.login') }}" method="POST">
                    @csrf
                    <div class="header">
                        <img class="logo" src="{{ asset('pictures/logo.png') }}" alt="">
                        <h5>ورود</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="شماره موبایل" name="mobile" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-success w-100 request-verficitaion-code-btn" type="button" data-url="{{ route('request.code.verify') }}">
                                ارسال کد فعالسازی
                            </button>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" minlength="1" maxlength="4"  class="form-control" placeholder="کد فعالسازی" name="code" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="فراموشی رمز عبور"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">ورود</button>
                        {{-- <div class="signin_with mt-3">
                            <p class="mb-0">یا ثبت نام با استفاده از</p>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></button>
                            <button class="btn btn-primary btn-icon btn-icon-mini btn-round google"><i class="zmdi zmdi-google-plus"></i></button>
                        </div> --}}
                    </div>
                </form>
                {{-- <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span>راست چین شده توسط <a href="https://thememakker.com/" target="_blank">آرش خادملو</a></span>
                </div> --}}
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="{{ asset('customerPanel') }}/assets/images/signin.svg" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('customerPanel') }}/assets/bundles/libscripts.bundle.js"></script>
<script src="{{ asset('customerPanel') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('plugins/alertify/alertify.min.js') }}"></script>
@if($errors->any())
    <script>
        alertify.error('{{ $errors->first() }}');
    </script>
@endif
@if(session('success'))
    <script>
        alertify.success('{{ session('success') }}');
    </script>
@endif
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="{{ asset('customerPanel/assets/myJs/login.js') }}"></script>
</body>

</html>
