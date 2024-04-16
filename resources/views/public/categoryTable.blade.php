<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/bootstrap-theme.css">
    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/rtl.css">
    <!-- persian Date Picker -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/persian-datepicker-0.4.5.min">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/AdminLTE.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/alertify/css/alertify.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/alertify/css/themes/bootstrap.rtl.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/datatables.min.css" rel="stylesheet">
</head>
<body>
    <section class="p-3" style="padding: 4%;">
        <table id="unit-table" class="table table-bordered table-hover table-info">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>عنوان محصول</th>
                <th>مشخصات</th>
                <th>تخفیف</th>
                <th>قیمت</th>
            </tr>
            </thead>
            <tbody>
            @php
                $count = 0 ;
            @endphp
            @foreach($products as $product)
                <tr>
                    <td>{{ ++$count }}</td>
                    <td>
                        {{ $product->title }}
                    </td>
                    <td>
                        {{ $product->description }}
                    </td>
                    <td>
                        {{ $product->off }}
                    </td>
                    <td>
                        {{ $product->price > 0 ? number_format($product->price) : 'استعلام بگیرید' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>


<script src="{{ asset('panelAdmin') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('panelAdmin') }}/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('panelAdmin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('panelAdmin') }}/bower_components/raphael/raphael.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('panelAdmin') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{ asset('panelAdmin') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('panelAdmin') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('panelAdmin') }}/bower_components/moment/min/moment.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{ asset('panelAdmin') }}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('panelAdmin') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('panelAdmin') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('panelAdmin') }}/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('panelAdmin') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('panelAdmin') }}/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('panelAdmin') }}/dist/js/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.3/b-3.0.1/r-3.0.1/datatables.min.js"></script>
    <script>
        $('.table-info').DataTable({
            "language": {
                "lengthMenu": "نمایش _MENU_ در هر صفحه",
                "zeroRecords": "هیچ چیزی برای نمایش وجود ندارد",
                "info": "نمایش _PAGE_ از _PAGES_",
                "infoEmpty": "خالی",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "جستجو : ",
                'paginate': {
                    'previous': 'قبلی',
                    'next': 'بعدی'
                }
            },
            responsive : true
        })
    </script>
</body>
</html>
