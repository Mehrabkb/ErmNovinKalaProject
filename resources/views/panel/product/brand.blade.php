@extends('panel.master')
@section('title' , 'برند')
@section('css')
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('panelAdmin/myCss/brand.css') }}" >

@endsection
@section('content')
    <section class="content">
        <div class="row">
            <section class="col-lg-12 col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-info-circle"></i>
                        <h3 class="box-title">افزودن برند</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="form-add-brand" action="{{ route('add.brand.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="persian-brand">نام برند</label>
                                    <input type="text" class="form-control" id="brand-title" name="brand-title" placeholder="نام  برند مثال : بنکن " >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">عکس برند</label>
                                    <input type="file" name="main-image" />
                                    <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
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
                                <th>نام برند</th>
                                <th>لوگو</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>
                                        {{ $brand->brand_name }}
                                    </td>
                                    <td>
                                        @if($brand->brand_logo != '')
                                        <img style="width: 60px; height: 60px; object-fit: contain;" src="{{ asset($brand->brand_logo)}}">
                                        @else
                                        <span>فاقد عکس </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-delete-brand" data-id="{{ $brand->product_brand_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                        <button class="btn btn-primary btn-edit-brand-step-one" data-url="{{ route('get.brand.single') }}" data-id="{{ $brand->product_brand_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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
                    <form class="delete-form-brand" action="{{ route('delete.brand.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="brand-data-id" class="brand-data-id">
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
                    <h5 class="modal-title" id="exampleModalLabel">ویرایش واحد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-form-brand" action="{{ route('edit.brand.product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product-brand-data-id" class="brand-data-id">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="persian-brand">نام برند</label>
                                <input type="text" class="form-control" id="brand-title" name="brand-title" placeholder="نام  برند مثال : بنکن " >
                            </div>
                            <div class="form-group show-imaged-brand">
                                <label for="main-image">عکس فعلی</label>
                                <img style="width:60px; height: 60px">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">عکس برند</label>
                                <input type="file" name="main-image" />
                                <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
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
    <script src="{{ asset('panelAdmin/myJavaScript/brand.js') }}"></script>
@endsection
