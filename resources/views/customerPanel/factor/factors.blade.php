@extends('customerPanel.master')
@section('title' , 'فاکتورها')
@section('css')
    <link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/footable-bootstrap/css/footable.standalone.min.css">
@endsection
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>فاکتورها</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> نوین کالا</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">فاکتورها</a></li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- Basic Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0 table-factor">
                                        <thead>
                                        <tr>
                                            <th>ردیف</th>
                                            <th>شماره فاکتور</th>
                                            <th>مبلغ فاکتور</th>
                                            <th data-breakpoints="xs">تاریخ</th>
                                            <th data-breakpoints="xs">وضعیت</th>
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
                                                <td>{{ $factor->factor_id }}</td>
                                                <td>{{ number_format($factor->total_price) }}</td>
                                                <td>{{ \Morilog\Jalali\Jalalian::forge($factor->date)->format('%B %d، %Y') }}</td>
                                                <td>{{ $factor->status }}</td>
                                                <td>
                                                    <a href="{{ route('customer.factor.single.show' , ['id' => $factor->factor_id]) }}" class="btn btn-primary">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('customerPanel') }}/assets/bundles/footable.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="{{ asset('customerPanel') }}/assets/js/pages/tables/footable.js"></script><!-- Custom Js -->
@endsection
