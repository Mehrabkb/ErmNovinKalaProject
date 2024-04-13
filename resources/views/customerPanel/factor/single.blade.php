@extends('customerPanel.master')
@section('title' , 'فاکتور')
@section('css')
    <style>
        .data-list-ul{
            list-style: none;
        }
        @media print{@page {size: landscape }}
        @media print{
            body{
                width: 1518px;
                height: 989px;
            }

            table , tr , th , td {
                border-collapse: collapse!important;
                border : 1px solid #000!important;
            }
        }
        table , tr , th , td {
            border-collapse: collapse!important;
            border : 1px solid #000!important;
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="body_scroll">
            <div class="block-header no-print">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>فاکتورها</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> نوین کالا</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">فاکتورها</a></li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                        <button class="btn btn-primary btn-print" onclick="PrintDiv()">پرینت فاکتور</button>
                    </div>
                </div>
            </div>

            <div class="container-fluid printer-div" style="align-items: center" id="printer-div">
                <!-- Basic Table -->
                <div class="row text-dark bg-white clearfix py-3 align-items-center" ">
                    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
                        <img src="{{ asset('pictures/logo.png') }}" class="w-50" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-center" >
                        <h2 class="text-dark my-3">پیش فاکتور فروش کالا و خدمات</h2>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <ul class="mx-auto data-list-ul p-0">
                            <li class="text-center">
                                <span>شماره سریال:</span>
                                <span><strong>{{ $factor->factor_id }}</strong> </span>
                            </li>
                            <li class="text-center">
                                <span>تاریخ:</span>
                                <span><strong>{{ \Morilog\Jalali\Jalalian::forge($factor->date)->format('%Y/%m/%d'); }}</strong> </span>
                            </li>
                            <li class="text-center">
                                <span>تاریخ اعتبار:</span>
                                <span><strong>{{ \Morilog\Jalali\Jalalian::forge($factor->date)->addDay(1)->format('%Y/%m/%d'); }}</strong> </span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 border" >
                        <h4 class="text-dark py-2 text-center" style="background : #ccc; border : 1px solid #000;">مشخصات فروشنده</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                <span><strong>نام شخص حقیقی / حقوقی : </strong></span>
                                <span>تامین تاسیسات نوین کالا</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شماره اقتصادی :</strong></span>
                                <span>14012129710</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شماره ثبت :</strong></span>
                                <span>611154</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شناسه ملی :</strong></span>
                                <span>14012129710</span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 my-3 text-center">
                                <span><strong>نشانی :</strong></span>
                                <span>تهران ، جنت آباد شمالی ، خیابان ایرانشهر جنوبی ، خیابان گلزار شرقی ، پلاک 27 و طبقه 5 واحد 15 </span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3 text-center">
                                <span><strong>کدپستی :</strong></span>
                                <span>1477933759</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3 text-center">
                                <span><strong>شماره تلفن :</strong></span>
                                <span>44832374</span>
                            </div>
                        </div>
                        <h4 class="text-dark py-2 text-center" style="background : #ccc; border: 1px solid #000;">مشخصات خریدار</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                <span><strong>شماره تلفن :</strong></span>
                                <span>{{ Auth::user()->phone }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شماره اقتصادی :</strong></span>
                                <span>{{ Auth::user()->registration_number ?  Auth::user()->registration_number  : 'فاقد مقدار'}}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شماره ثبت :</strong></span>
                                <span>{{ Auth::user()->national_id ? Auth::user()->national_id : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                <span><strong>شناسه ملی :</strong></span>
                                <span>{{ Auth::user()->registration_number ? Auth::user()->registration_number : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 my-3 text-center">
                                <span><strong>نشانی :</strong></span>
                                <span>{{ Auth::user()->address ? Auth::user()->address : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3 text-center">
                                <span><strong>کد پستی :</strong></span>
                                <span>{{ Auth::user()->postal_code ? Auth::user()->postal_code : 'فاقد مقدار' }}</span>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 my-3 text-center">
                                <span><strong>نام و نام خانوادگی :</strong></span>
                                <span>{{ Auth::user()->first_name ? Auth::user()->first_name : 'فاقد مقدار' }}
                                      {{ Auth::user()->last_name ? Auth::user()->last_name : 'فاقد مقدار' }}
                                </span>
                            </div>

                        </div>
                        <h4 class="text-dark py-2 text-center" style="background : #ccc; border : 1px solid #000;">مشخصات کالا یا خدمات مورد معامله</h4>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table" style="border-collapse: collapse; border : 1px solid #000;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>کد کالا</th>
                                        <th>نام کالا</th>
                                        <th>تعداد</th>
                                        <th>مبلغ واحد</th>
                                        <th>مبلغ کل</th>
                                        <th>مبلغ تخفیف</th>
                                        <th>مبلغ کل پس از تخفیف</th>
                                        <th>جمع مالیات و عوارض</th>
                                        <th>خالص فاکتور</th>
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
                                            @if($factor->official_bill)
                                                <td>{{ number_format($factorItem->price) }}</td>
                                                <td>{{ number_format($factorItem->price * $factorItem->count) }}</td>
                                                <td>{{ number_format(($factorItem->price * $factorItem->count ) / 100 * $factorItem->off) }}</td>
                                                <td>{{ number_format(($factorItem->price * $factorItem->count) - (($factorItem->price * $factorItem->count) / 100 * $factorItem->off)) }}</td>
                                                @php
                                                    $price =($factorItem->price * $factorItem->count) - (($factorItem->price * $factorItem->count) / 100 * $factorItem->off);
                                                @endphp
                                                <td>{{ number_format($price /100 * 10) }}</td>
                                                <td>{{ number_format($price + (($price /100) * 10)) }}</td>

                                            @else
                                                <td>{{ number_format($factorItem->company_price) }}</td>
                                                <td>{{ number_format($factorItem->company_price * $factorItem->count) }}</td>
                                                <td>{{ number_format(($factorItem->company_price * $factorItem->count) / 100 * $factorItem->off) }}</td>
                                                <td>{{ number_format(($factorItem->company_price * $factorItem->count) - (($factorItem->company_price * $factorItem->count) / 100 * $factorItem->off)) }}</td>
                                                @php
                                                    $price =($factorItem->company_price * $factorItem->count) - (($factorItem->company_price * $factorItem->count) / 100 * $factorItem->off);
                                                @endphp
                                                <td>0</td>
                                                <td>{{ number_format($price) }}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td colspan="5" class="text-center">جمع کل</td>
                                            @if($factor->official_bill)
                                                @php
                                                    $totalPrice = 0;
                                                    $totalOff = 0;
                                                    $cleanPrice = 0 ;
                                                    foreach($factorItems as $factorItem){
                                                        $totalPrice += $factorItem->price * $factorItem->count;
                                                        $totalOff += (($factorItem->price * $factorItem->count) / 100 ) * $factorItem->off ;
                                                        $tp = $totalPrice- $totalOff;
                                                        $cleanPrice = $tp + $tp / 100 * 10;
                                                    }
                                                @endphp
                                                <td>{{ number_format($totalPrice)  }}</td>
                                                <td>{{ number_format($totalOff) }}</td>
                                                <td>{{ number_format($totalPrice - $totalOff) }}</td>
                                                <td>{{ number_format((($totalPrice - $totalOff) / 100 ) * 10 ) }}</td>
                                                <td>{{ number_format($cleanPrice) }}</td>
                                            @else
                                                @php
                                                    $totalPrice = 0;
                                                    $totalOff = 0 ;
                                                    $cleanPrice = 0;
                                                    foreach($factorItems as $factorItem){
                                                        $totalPrice += $factorItem->company_price * $factorItem->count;
                                                        $totalOff += (($factorItem->company_price * $factorItem->count) / 100 ) * $factorItem->off ;
                                                        $cleanPrice += $factorItem->company_price * $factorItem->count - (($factorItem->company_price * $factorItem->count) / 100 ) * $factorItem->off;
                                                    }
                                                @endphp
                                                <td>{{ number_format($totalPrice)  }}</td>
                                                <td>{{ number_format($totalOff) }}</td>
                                                <td>{{ number_format($totalPrice - $totalOff) }}</td>
                                                <td>0</td>
                                                <td>{{ number_format($cleanPrice) }}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <span>شرایط و نحوه فروش :</span>
                                                <span>
                                                    نقدی
                                                    &nbsp;<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                </span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <span>
                                                    غیر نقدی
                                                    &nbsp;<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                </span>
                                            </td>
                                            <td colspan="6" class="num2persian">
                                                {{ ceil($cleanPrice) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="10">
                                                <h1 class="text-center">
                                                    مدت اعتبار یک روز می باشد
                                                </h1>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                مهر و امضاء فروشنده :
                                            </td>
                                            <td colspan="5" class="text-center">
                                                مهر و امضاء خریدار :
                                            </td>
                                        </tr>
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
    <script src="{{ asset('plugins/divJsPrinter/divjs.js') }}" ></script>
    <script !src="">
        let number = $('td.num2persian').html();
        $('td.num2persian').html('مبلغ به حروف : ' + number.num2persian() + ' ریال');
        function PrintDiv()
        {
            var divContents = document.querySelector(".printer-div").innerHTML;
            var printWindow = window.open('', '', '');
            printWindow.document.write('<html><head><title></title>');
            let head = $('head');
            printWindow.document.write(head.html());
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
        }

    </script>
@endsection
