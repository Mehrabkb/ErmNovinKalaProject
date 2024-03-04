<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ورود | کنترل پنل</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/bootstrap-theme.css">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/rtl.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="{{ asset('plugins/alertify/css/alertify.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/alertify/css/themes/bootstrap.rtl.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>ورود به پنل</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>

        <form action="{{ route('login') }}" method="post" class="login-user-form">
            @csrf
            <div class="form-group has-feedback">
                <input type="text" name="user-name" class="form-control" placeholder="نام کاربری" data-regex="userName">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="رمز عبور" data-regex="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> مرا به خاطر بسپار
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <!-- /.social-auth-links -->

{{--        <a href="#">رمز عبورم را فراموش کرده ام.</a><br>--}}
{{--        <a href="register.html" class="text-center">ثبت نام</a>--}}

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('panelAdmin') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('panelAdmin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('panelAdmin') }}/plugins/iCheck/icheck.min.js"></script>
<script src="{{ asset('plugins/alertify/alertify.min.js') }}"></script>
<script src="{{ asset('panelAdmin/myJavaScript/validationForms.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
