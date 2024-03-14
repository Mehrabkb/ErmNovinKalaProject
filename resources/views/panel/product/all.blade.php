@extends('panel.master')
@section('title' , 'محصولات')

@section('content')
    <section class="content">
        <div class="row">
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
                                <th>عنوان محصول</th>
                                <th>دسته بندی</th>
                                <th>توضیحات</th>
                                <th>قیمت</th>
                                <th>عملیات</th>
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
                                        {{ $product->persian_category }}
                                    </td>
                                    <td>
                                        {{ $product->description }}
                                    </td>
                                    <td>
                                        {{ number_format($product->price) }}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-delete-category" data-url="{{ route('delete.category.product') }}" data-id="{{ $product->product_category_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                        <button class="btn btn-primary btn-edit-category-step-one" data-url="{{ route('get.category.product') }}" data-id="{{ $product->product_category_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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
