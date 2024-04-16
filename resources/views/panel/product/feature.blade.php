@extends('panel.master')
@section('title' , 'ویژگی ها')
@section('css')
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <section class="col-lg-12 col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-info-circle"></i>
                        <h3 class="box-title">افزودن ویژگی</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="" action="{{ route('add.feature.product') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="feature-key">نام کامل ویژگی</label>
                                    <input type="text" class="form-control" id="feature-key" name="feature-key" placeholder=" نام کامل ویژگی مثال : سایز" >
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <section class="col-lg-12 col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-info-circle"></i>
                        <h3 class="box-title">جدول اطلاعات</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <table id="unit-table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($productFeatures as $productFeature)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>
                                        {{ $productFeature->feature_key }}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/myJavaScript/unit.js"></script>
@endsection
