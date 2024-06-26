@extends('panel.master')
@section('title' , 'دسته بندی')
@section('css')
    <link rel="stylesheet" href="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('panelAdmin/myCss/category.css') }}" >
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <section class="col-lg-12 col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-info-circle"></i>
                        <h3 class="box-title">درون ریزی</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="form-add-category" action="{{ route('import.category.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="excel-file">فایل csv را وارد کنید</label>
                                    <input name="excel-file" type="file" class="form-control">
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
                        <h3 class="box-title">افزودن دسته بندی</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="form-add-category" action="{{ route('add.category.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="english-category">نام انگلیسی دسته بندی</label>
                                    <input type="text" class="form-control" id="english-category" name="english-category" placeholder="نام انگلیسی دسته بندی را وارد کنید مثال : pipe">
                                </div>
                                <div class="form-group">
                                    <label for="persian-category">نام فارسی دسته بندی</label>
                                    <input type="text" class="form-control" id="persian-category" name="persian-category" placeholder="نام فارسی دسته بندی مثال : لوله فلزی " >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">عکس دسته بندی</label>
                                    <input type="file" name="main-image" />
                                    <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
                                </div>
                                <div class="form-group">
                                    <label for="parent-category">دسته والد</label>
                                    <select class="form-control" name="category-parent">
                                        <option disabled selected>میتوانید دسته والد را انتخاب کنید ( اختیاری )</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->product_category_id }}">{{ $category->persian_category }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tag-select">تگ دسته بندی را انتخاب کنید</label>
                                    <select name="tag-id" class="form-control">
                                        <option selected disabled>انتخاب تگ </option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->public_tag_id }}">{{ $tag->tags_title }}</option>
                                        @endforeach
                                    </select>
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
                        <table id="unit-table" class="table table-bordered table-hover table-info">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>آیدی دسته بندی</th>
                                <th>نام فارسی دسته</th>
                                <th>عکس</th>
                                <th>والد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>
                                        {{ $category->product_category_id }}
                                    </td>
                                    <td>
                                        {{ $category->persian_category }}
                                    </td>
                                    <td>
                                        @if($category->image != '')
                                            <img style="width: 60px; height: 60px; object-fit: contain;" src="{{ asset($category->image)}}">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $category->parent_category_id }}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-delete-category" data-url="{{ route('delete.category.product') }}" data-id="{{ $category->product_category_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                        <button class="btn btn-primary btn-edit-category-step-one" data-url="{{ route('get.category.product') }}" data-id="{{ $category->product_category_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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
                    <form class="delete-form-category" action="{{ route('delete.category.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="category-data-id" class="category-data-id">
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
                    <form class="edit-form-category" action="{{ route('edit.category.product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product-category-data-id" class="category-data-id">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="english-category">نام انگلیسی دسته بندی</label>
                                <input type="text" class="form-control" id="english-category" name="english-category" placeholder="نام انگلیسی دسته بندی را وارد کنید مثال : pipe">
                            </div>
                            <div class="form-group">
                                <label for="persian-category">نام فارسی دسته بندی</label>
                                <input type="text" class="form-control" id="persian-category" name="persian-category" placeholder="نام فارسی دسته بندی مثال : لوله فلزی " >
                            </div>
                            <div class="form-group">
                                <label for="image">عکس فعلی </label>
                                <img class="image" style="width: 50px;">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">عکس دسته بندی</label>
                                <input type="file" name="main-image-edit" />
                                <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
                            </div>
                            <div class="form-group now-parent-category">
                                <label for="now-parent-category">دسته والد فعلی</label>
                                <input disabled type="text" class="now-parent-category-input form-control" >
                            </div>
                            <div class="form-group">
                                <label for="parent-category">دسته والد</label>
                                <select class="form-control" name="category-parent">
                                    <option disabled selected>میتوانید دسته والد را انتخاب کنید ( اختیاری )</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->product_category_id }}">{{ $category->persian_category }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group now-tag-category">
                                <label for="">تگ فعلی</label>
                                <input disabled type="text" class="now-tag-category-input form-control">
                            </div>
                            <div class="form-group">
                                <label for="tag-select">تگ دسته بندی را انتخاب کنید</label>
                                <select name="tag-id" class="form-control">
                                    <option selected disabled>انتخاب تگ </option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->public_tag_id }}">{{ $tag->tags_title }}</option>
                                    @endforeach
                                </select>
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
    <script src="{{ asset('panelAdmin/myJavaScript/category.js') }}"></script>
@endsection
