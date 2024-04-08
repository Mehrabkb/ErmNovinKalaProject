@extends('customerPanel.master')
@section('title' , 'فاکتور')
@section('css')
    <style>
        .data-list-ul{
            list-style: none;
        }
    </style>
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
                <div class="row text-dark bg-white clearfix py-3 align-items-center">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                        <img src="{{ asset('pictures/logo.png') }}" class="w-50" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                        <h2 class="text-dark my-3">پیش فاکتور فروش کالا و خدمات</h2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <ul class="mx-auto data-list-ul p-0">
                            <li>
                                <span>شماره سریال:</span>
                                <span>{{ $factor->factor_id }}</span>
                            </li>
                            <li>
                                <span>تاریخ:</span>
                                <span>{{ \Morilog\Jalali\Jalalian::forge($factor->date)->format('%Y/%M/%d'); }}</span>
                            </li>
                            <li>
                                <span>تاریخ اعتبار:</span>
                                <span>{{ \Morilog\Jalali\Jalalian::forge($factor->date)->addDay(1)->format('%Y/%M/%d'); }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 border">
                        <h4 class="border text-dark py-2 text-center" style="background : #f5f5f5;">مشخصات فروشنده</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <span><strong>نام شخص حقیقی / حقوقی : </strong></span>
                                <span>تامین تاسیسات نوین کالا</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شماره اقتصادی :</strong></span>
                                <span>14012129710</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شماره ثبت :</strong></span>
                                <span>611154</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شناسه ملی :</strong></span>
                                <span>14012129710</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 my-3">
                                <span><strong>نشانی :</strong></span>
                                <span>تهران ، جنت آباد شمالی ، خیابان ایرانشهر جنوبی ، خیابان گلزار شرقی ، پلاک 27 و طبقه 5 واحد 15 </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3">
                                <span><strong>کدپستی :</strong></span>
                                <span>1477933759</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3">
                                <span><strong>شماره تلفن :</strong></span>
                                <span>44832374</span>
                            </div>
                        </div>
                        <h4 class="border text-dark py-2 text-center" style="background : #f5f5f5;">مشخصات خریدار</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <span><strong>شماره تلفن :</strong></span>
                                <span>{{ Auth::user()->phone }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شماره اقتصادی :</strong></span>
                                <span>{{ Auth::user()->registration_number ?  Auth::user()->registration_number  : 'فاقد مقدار'}}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شماره ثبت :</strong></span>
                                <span>{{ Auth::user()->national_id ? Auth::user()->national_id : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2">
                                <span><strong>شناسه ملی :</strong></span>
                                <span>{{ Auth::user()->registration_number ? Auth::user()->registration_number : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 my-3">
                                <span><strong>نشانی :</strong></span>
                                <span>{{ Auth::user()->address ? Auth::user()->address : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3">
                                <span><strong>کد پستی :</strong></span>
                                <span>{{ Auth::user()->postal_code ? Auth::user()->postal_code : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3">
                                <span><strong>نام و نام خانوادگی :</strong></span>
                                <span>{{ Auth::user()->first_name ? Auth::user()->first_name : 'فاقد مقدار' }}
                                      {{ Auth::user()->last_name ? Auth::user()->last_name : 'فاقد مقدار' }}
                                </span>
                            </div>

                        </div>
                        <h4 class="border text-dark py-2 text-center" style="background : #f5f5f5;">مشخصات کالا یا خدمات مورد معامله</h4>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد کالا</th>
                                        <th>نام کالا</th>
                                        <th>تعداد</th>
                                        <th>مبلغ واحد</th>
                                        <th>مبلغ کل</th>
                                        <th>درصد تخفیف</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $counter = 0 ;
                                    @endphp
                                    @foreach($factorItems as $factorItem)
                                        <tr>
                                            <th scope="row">{{ ++$counter }}</th>
                                            <td>{{ $factorItem->product_id }}</td>
                                            <td>{{ $factorItem->title . '( ' . $factorItem->description . ' )' }}</td>
                                            <td>{{ $factorItem->count }}</td>
                                            <td>{{ number_format($factorItem->price) }}</td>
                                            <td>{{ number_format($factorItem->price * $factorItem->count) }}</td>
                                            <td>{{ $factorItem->off }}</td>
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
    </section>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/mahmoud-eskandari/NumToPersian/dist/num2persian-min.js"></script>
@endsection
