@extends('panel.master')
@section('title' , 'واحدها')
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
                        <h3 class="box-title">افزودن واحد</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="form-add-unit" action="{{ route('add.unit.product') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="unit-long">نام کامل واحد</label>
                                    <input type="text" class="form-control" id="unit-long" name="long-title" placeholder=" نام کامل واحد مثال : سانتیمتر" data-regex="force-persian" data-title="نام کامل واحد">
                                </div>
                                <div class="form-group">
                                    <label for="unit-short">علامت واحد</label>
                                    <input type="text" class="form-control" id="unit-short" name="short-title" placeholder="علامت واحد مثال : CM " data-regex="force-english" data-title="علامت واحد">
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
                                     <th>نام کامل واحد</th>
                                     <th>علامت واحد</th>
                                     <th>عملیات</th>
                                 </tr>
                                </thead>
                                <tbody>
                                @foreach($units as $unit)
                                    <tr>
                                        <td>
                                            {{ $unit->long_title }}
                                        </td>
                                        <td>
                                            {{ $unit->short_title }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" data-id="{{ $unit->unit_id }}">حذف</button>
                                            <button class="btn btn-primary" data-id="{{ $unit->unit_id }}">ویرایش</button>
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
