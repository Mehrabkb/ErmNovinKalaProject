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
                                            <button class="btn btn-danger btn-delete-unit" data-url="{{ route('delete.unit.product') }}" data-id="{{ $unit->unit_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                            <button class="btn btn-primary btn-edit-unit-step-one" data-url="{{ route('get.unit.product') }}" data-id="{{ $unit->unit_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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

@section('modals')
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel">حذف واحد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="delete-form-unit" action="{{ route('delete.unit.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="unit-data-id" class="unit-data-id">
                        <p>آیا از حذف این مورد اطمینان دارید؟</p>
                        <br>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="exampleModalLabel">حذف واحد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-form-unit" action="{{ route('edit.unit.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="unit-data-id" class="unit-data-id">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="unit-long">نام کامل واحد</label>
                                <input type="text" class="form-control long-title" id="unit-long" name="long-title"  placeholder=" نام کامل واحد مثال : سانتیمتر" data-regex="force-persian" data-title="نام کامل واحد">
                            </div>
                            <div class="form-group">
                                <label for="unit-short">علامت واحد</label>
                                <input type="text" class="form-control short-title"  id="unit-short"  name="short-title" placeholder="علامت واحد مثال : CM " data-regex="force-english" data-title="علامت واحد">
                            </div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ویرایش</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/myJavaScript/unit.js"></script>
@endsection
