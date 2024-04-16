@extends('panel.master')
@section('title' , 'افزودن')
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
                        <h3 class="box-title">افزودن برند</h3>
                        <!-- tools box -->
                        <div class="pull-left box-tools">
                            <button type="button" class="btn bg-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <div class="box-body">
                        <form role="form" class="form-add-product" action="{{ route('add.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="product-title">عنوان محصول</label>
                                    <input type="text" class="form-control" id="product-title" name="product-title" placeholder="عنوان محصول" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">عکس محصول</label>
                                    <input type="file" name="main-image" />
                                    <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" class="form-control" placeholder="توضیحات محصول ... "></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-balance">موجودی</label>
                                    <input type="number"  min="0" class="form-control" name="product-balance">
                                </div>
                                <div class="form-group">
                                <label>ویژگی ها</label>
                                    @foreach($productFeatures as $productFeature)
                                     <div class="row">
                                         <div class="col-lg-4">
                                             <input type="hidden" name="product-feature-key-id[]" value="{{ $productFeature->product_feature_id  }}">
                                             <input type="text" class="form-control" disabled value="{{ $productFeature->feature_key }}">
                                         </div>
                                         <div class="col-lg-4">
                                             <input type="text" name="product-feature-value[]"  class="form-control" placeholder="لطفا مقدار مورد نظر را وارد کنید مثال : 10cm">
                                         </div>
                                     </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="product-price">قیمت</label>
                                    <input type="text" name="product-price" class="form-control number-separator">
                                </div>
                                <div class="form-group">
                                    <label for="product-company-price">قیمت</label>
                                    <input type="text" name="product-company-price" class="form-control number-separator" placeholder="قیمت فاکتور غیر رسمی">
                                </div>
                                <div class="form-group">
                                    <label for="categories">دسته بندی</label>
                                    <select name="product-category-id" class="form-control">
                                        <option disabled selected >یک دسته بندی برای محصول خود انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->product_category_id }}">{{ $category->persian_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-status">وضعیت محصول</label>
                                    <select name="product-status-id" id="" class="form-control">
                                        <option disabled selected >لطفا وضعیت محصول را انتخاب نمایید</option>
                                        @foreach($productStatuses as $productStatus)
                                            <option value="{{ $productStatus->product_status_id }}">{{ $productStatus->persian_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-brand">برند محصول</label>
                                    <select name="product-brand-id" id="" class="form-control">
                                        <option selected disabled >لطفا برند محصول را انتخاب نمایید</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->product_brand_id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-tag-id">تگ محصول</label>
                                    <select name="product-tag-id" class="form-control">
                                        <option selected disabled>لطفا تگ محصول را انتخاب نمایید</option>
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
    <script src="{{ asset('panelAdmin/myJavaScript/addProduct.js') }}"></script>
@endsection
