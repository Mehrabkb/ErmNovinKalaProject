@extends('panel.master')
@section('title' , 'ویرایش برند')
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
                                <th>برند</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($products as $product)
                                <tr>
                                    <td >{{ ++$count }}</td>
                                    <td style="width: 200px;">
                                        {{ $product->title }}
                                    </td>
                                    <td>
                                        {{ $product->description}}
                                    </td>
                                    <td>
                                        <select class="form-control slc-brand" name="brand">
                                            @foreach($brands as $brand)
                                                @if($product->product_brand_id == $brand->product_brand_id)
                                                    <option value="{{ $brand->product_brand_id }}" selected>{{ $brand->brand_name }}</option>
                                                @else
                                                    <option value="{{ $brand->product_brand_id }}">{{ $brand->brand_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-edit-brand-submit" data-url="" data-id="{{ $product->product_id }}" data-method="POST">ثبت برند</button>
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
    <script src="{{ asset('panelAdmin/myJavaScript/brandEdit.js') }}"></script>
@endsection
