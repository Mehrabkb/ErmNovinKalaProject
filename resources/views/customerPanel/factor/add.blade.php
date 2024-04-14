@extends('customerPanel.master')
@section('title' , 'ثبت سفارش')
@section('css')
    <style>
        @media(max-width: 768px){
            .title-product-td{
                width: 80px;
                white-space: normal!important;
            }
        }
    </style>
@endsection
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ثبت سفارش</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> نوین کالا</a></li>
                        <li class="breadcrumb-item active">ثبت سفارش</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
{{--                <div class="col-lg-5 col-md-6 col-sm-12">--}}
{{--                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>--}}
{{--                </div>--}}
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong> جستجو </strong>محصول</h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('basket.add.item') }}" method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <input id="search-bar" data-url="{{ route('product.search.result') }}" class="form-control" autocomplete="off" placeholder="جستجو محصول...">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mb-3">
                                        <select class="form-control show-tick ms select2 slc-products" name="product-id">
                                            <option selected disabled>انتخاب کنید</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <input type="number" name="count" min="1" value="1" class="form-control" placeholder="تعداد">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect m-l-20" >افزودن</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <h5><strong>سبد خرید: </strong> </h5>
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6 col-sm-6">--}}
{{--                                    <address>--}}
{{--                                        <strong>شرکت خادملو.</strong><br>--}}
{{--                                        795 فولسوم خیابان، سوئیت 546 سانفرانسیسکو, 54656<br>--}}
{{--                                        <abbr title="Phone">ت:</abbr> (123) 456-34636--}}
{{--                                    </address>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6 col-sm-6 text-right">--}}
{{--                                    <p class="mb-0"><strong>تاریخ سفارش: </strong> 2 بهمن 1397</p>--}}
{{--                                    <p class="mb-0"><strong>وضعیت سفارش: </strong> <span class="badge badge-success">موفقیت</span></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>نام محصول</th>
                                            <th>مشخصات</th>
                                            <th>قیمت</th>
                                            <th>تعداد</th>
                                            <th>تخفیف</th>
                                            <th>مجموع</th>
                                            <th>عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $counter = 0 ;
                                        @endphp
                                        @foreach($basketItems as $basketItem)
                                            <tr>
                                                <td>{{ ++$counter }}</td>
                                                <td class="title-product-td">{{ $basketItem->title }}</td>
                                                <td>{{ $basketItem->description }}</td>
                                                @if($fullBasket->official_bill)
                                                    <td>{{ number_format($basketItem->price) > 0 ? number_format($basketItem->price) : 'استعلام بگیرید' }}</td>
                                                @else
                                                    <td>{{ number_format($basketItem->company_price) > 0 ? number_format($basketItem->company_price) : 'استعلام بگیرید' }}</td>
                                                @endif
                                                <td>{{ $basketItem->count}}</td>
                                                <td>{{ $basketItem->off }}</td>
                                                @if($fullBasket->official_bill)
                                                    <td>{{ number_format(($basketItem->price * $basketItem->count) - (($basketItem->price * $basketItem->count / 100) * $basketItem->off) , 3 , '.') }}</td>
                                                @else
                                                    <td>{{ number_format(($basketItem->company_price * $basketItem->count) - (($basketItem->company_price * $basketItem->count / 100) * $basketItem->off) , 3 , '.') }}</td>
                                                @endif
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-delete-basket-item" data-id="{{ $basketItem->basket_item_id }}" data-url="{{ route('basket.delete.item') }}"><i class="zmdi zmdi-delete"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>توجه</h5>
                                    <p>
                                        <input class="form-check-input" data-id="{{ $fullBasket->basket_id }}" data-url="{{ route('basket.official.setter') }}" onchange="changeOfficialBillCheckBox(this)" {{ $fullBasket->official_bill ? 'checked' : '' }} name="official-bill" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            فاکتور رسمی ( در نظر داشته باشید که فاکتور رسمی شامل 10 % مالیات می باشد)

                                        </label>
                                    </p>
                                    <p>در نظر داشته باشید که قیمت ها به روز می باشد.پس از ثبت سفارش کارشناسان ما با شما تماس خواهند گرفت</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <ul class="list-unstyled">
{{--                                        <li><strong> مجموع:</strong> {{ number_format($fullBasket->price) }}</li>--}}
{{--                                        <li class="text-danger"><strong>تخفیف:-</strong> 12.9%</li>--}}
{{--                                        <li><strong>مالیات بر ارزش افزوده:-</strong> 12.9%</li>--}}
                                    </ul>
                                    <h3 class="mb-0 text-success">{{ number_format($fullBasket->total_price  , 3 , '.' ) }} ریال</h3>
{{--                                    <a href="javascript:void(0);" class="btn btn-info"><i class="zmdi zmdi-print"></i></a>--}}
                                    <a href="{{ route('customer.prefactor.add' , ['id' => $fullBasket->basket_id]) }}" class="btn btn-primary">ثبت نهایی</a>
                                </div>
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
    <script src="{{ asset('customerPanel/assets/myJs/factorAdd.js') }}"></script>
@endsection
