@extends('panel.master')
@section('title' , 'ویرایش')
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
                        <form role="form" class="form-add-product" action="{{ route('edit.product.single') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->product_id }}" name="product-id">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="product-title">عنوان محصول</label>
                                    <input type="text" class="form-control" id="product-title" name="product-title" placeholder="عنوان محصول" value="{{ $product->title }}">
                                </div>
                                @if($product->main_image != null)
                                    <div class="form-group">
                                        <label for="main-image">عکس فعلی محصول</label>
                                        <img src="{{ asset($product->main_image) }}" style="width: 60px; height: 60px;">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleInputFile">عکس محصول</label>
                                    <input type="file" name="main-image" />
                                    <p class="help-block">فایل های معتبر : PNG , JPG , JPEG , WEBP</p>
                                </div>
                                <div class="form-group">
                                    <label for="description">توضیحات</label>
                                    <textarea name="description" class="form-control"  placeholder="توضیحات محصول ... ">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="product-balance">موجودی</label>
                                    <input type="number"  min="0" class="form-control" value="{{ $product->balance }}" name="product-balance">
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
                                                <input type="text" name="product-feature-value[]" value="{{ $productFeature->product_feature_value }}" class="form-control" placeholder="لطفا مقدار مورد نظر را وارد کنید مثال : 10cm">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="product-price">قیمت</label>
                                    <input type="text" name="product-price" class="form-control number-separator" value="{{ number_format($product->price) }}">
                                </div>
                                <div class="form-group">
                                    <label for="product-company-price">قیمت</label>
                                    <input type="text" name="product-company-price" class="form-control number-separator" value="{{ number_format($product->company_price) }}" placeholder="قیمت فاکتور غیر رسمی">
                                </div>
                                <div class="form-group">
                                    <label for="product-off">تخفیف</label>
                                    <input type="number" name="off" class="form-control" value="{{ number_format($product->off) }}">
                                </div>
                                <div class="form-group">
                                    <label for="categories">دسته بندی</label>
                                    <select name="product-category-id" class="form-control">
                                        <option disabled selected >یک دسته بندی برای محصول خود انتخاب کنید</option>
                                        @foreach($categories as $category)
                                            @if($product->product_category_id == $category->product_category_id)
                                                <option selected value="{{ $category->product_category_id }}">{{ $category->persian_category }}</option>
                                            @else
                                                <option value="{{ $category->product_category_id }}">{{ $category->persian_category }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-status">وضعیت محصول</label>
                                    <select name="product-status-id" id="" class="form-control">
                                        <option disabled selected >لطفا وضعیت محصول را انتخاب نمایید</option>
                                        @foreach($productStatuses as $productStatus)
                                            @if($product->product_status_id == $productStatus->product_status_id )
                                                <option value="{{ $productStatus->product_status_id }}" selected>{{ $productStatus->persian_title }}</option>
                                            @else
                                                <option value="{{ $productStatus->product_status_id }}">{{ $productStatus->persian_title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-brand">برند محصول</label>
                                    <select name="product-brand-id" id="" class="form-control">
                                        <option selected disabled >لطفا برند محصول را انتخاب نمایید</option>
                                        @foreach($brands as $brand)
                                            @if($product->product_brand_id == $brand->product_brand_id )
                                                <option value="{{ $brand->product_brand_id }}" selected>{{ $brand->brand_name }}</option>
                                            @else
                                                <option value="{{ $brand->product_brand_id }}">{{ $brand->brand_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product-tag-id">تگ محصول</label>
                                    <select name="product-tag-id" class="form-control">
                                        <option selected disabled>لطفا تگ محصول را انتخاب نمایید</option>
                                        @foreach($tags as $tag)
                                            @if($product->product_tag_id == $tag->public_tag_id)
                                                <option value="{{ $tag->public_tag_id }}" selected>{{ $tag->tags_title }}</option>
                                            @else
                                                <option value="{{ $tag->public_tag_id }}">{{ $tag->tags_title }}</option>
                                            @endif
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



@section('js')
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('panelAdmin/myJavaScript/addProduct.js') }}"></script>
@endsection
