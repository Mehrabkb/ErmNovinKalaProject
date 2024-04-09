@extends('panel.master')
@section('title' , 'ویرایش قیمت')
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
                                <th>توضیحات</th>
                                <th>قیمت</th>
                                <th>قیمت فاکتور غیر رسمی</th>
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
                                        {{ $product->description}}
                                    </td>
                                    <td>
                                        <input type="text" name="price" class="price form-control number-seperator" value="{{ number_format($product->price) }}">
                                    </td>
                                    <td>
                                        <input type="text" name="product-company-price" class="product-company-price form-control number-seperator" value="{{ number_format($product->company_price) }}" >
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-edit-price-submit" data-url="{{ route('product.edit.price') }}" data-id="{{ $product->product_id }}" data-method="POST">ثبت قیمت</button>
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
    <script src="{{ asset('panelAdmin/myJavaScript/priceEdit.js') }}"></script>
@endsection
