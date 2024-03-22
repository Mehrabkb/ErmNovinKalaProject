@extends('panel.master')
@section('title' , 'کاربرها')
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
                        <h3 class="box-title">افزودن کاربر</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="" action="{{ route('user.add') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="phone">شماره:</label>
                                    <input type="text" class="form-control" name="phone" placeholder="شماره موبایل مثل : 09369849997">
                                </div>
                                <div class="form-group">
                                    <label for="first-name">نام:</label>
                                    <input type="text" class="form-control" id="first-name" name="first-name" placeholder=" نام کاربر مثل : مهراب" >
                                </div>
                                <div class="form-group">
                                    <label for="last-name">نام خانوادگی:</label>
                                    <input type="text" class="form-control" id="last-name" name="last-name" placeholder="نام خانوادگی مثل : کردبچه " >
                                </div>
                                <div class="form-group">
                                    <label for="user-role">نقش کاربر: </label>
                                    <select name="user-role" id="user-role" class="form-control">
                                        @foreach ($user_roles as $user_role)
                                            <option value="{{ $user_role->user_role_id }}">{{ $user_role->persian_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">نام کابری:</label>
                                    <input type="text" name="username" class="form-control" placeholder="نام کاربری مثل : mehrabkb">
                                </div>
                                <div class="form-group">
                                    <label for="password">رمزعبور:</label>
                                    <input type="password" class="form-control" name="password">
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
                                     <th>شماره موبایل</th>
                                     <th>نام کاربری</th>
                                     <th>نقش</th>
                                     <th>عملیات</th>
                                 </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0 ;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ ++$count }}</td>
                                        <td>
                                            {{ $user->phone != '' ? $user->phone  : 'خالی'}}
                                        </td>
                                        <td>
                                            {{ $user->user_name }}
                                        </td>
                                        <td>
                                            {{ $user->persian_name }}
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-delete-unit" data-url="{{ route('delete.unit.product') }}" data-id="{{ $user->user_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                            <button class="btn btn-primary btn-edit-unit-step-one" data-url="{{ route('get.unit.product') }}" data-id="{{ $user->user_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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
