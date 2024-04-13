@extends('panel.master')
@section('title' , 'فاکتور ها')
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
                                <th>شماره فاکتور</th>
                                <th>مبلغ فاکتور</th>
                                <th>تاریخ</th>
                                <th>کاربر</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($factors as $factor)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>
                                        {{ $factor->factor_id }}
                                    </td>
                                    <td>
                                        {{ number_format($factor->total_price) }}
                                    </td>
                                    <td>
                                        {{  \Morilog\Jalali\Jalalian::forge($factor->date)->format('%B %d، %Y') }}
                                    </td>
                                    <td>
                                        {{ $factor->phone }}
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('factor.single.panel.admin.show' , ['id' => $factor->factor_id]) }}"><i class="fa fa-eye"></i></a>
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
                    <form class="delete-form-product" action="{{ route('delete.product') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product-id" class="product-id">
                        <p>آیا از حذف این مورد اطمینان دارید؟</p>
                        <br>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('panelAdmin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ asset('panelAdmin/myJavaScript/allProduct.js') }}"></script>
@endsection
