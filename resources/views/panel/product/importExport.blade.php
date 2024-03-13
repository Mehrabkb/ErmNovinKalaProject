@extends('panel.master')
@section('title' , 'درون ریزی / برون ریزی')

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
                                    <label for="product-price">قیمت</label>
                                    <input type="text" name="product-price" class="form-control number-separator">
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
