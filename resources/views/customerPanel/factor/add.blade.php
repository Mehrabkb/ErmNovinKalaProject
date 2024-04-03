@extends('customerPanel.master')
@section('title' , 'ثبت سفارش')

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
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
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
                                    <div class="col-lg-4 col-md-4">
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
                                            <th>قیمت</th>
                                            <th>تعداد</th>
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
                                                <td>{{ $basketItem->title }}</td>
                                                <td>{{ number_format($basketItem->price) }}</td>
                                                <td>{{ $basketItem->count}}</td>
                                                <td>{{ number_format($basketItem->price * $basketItem->count) }}</td>
                                                <td>
                                                    <button class="btn btn-danger" data-id="{{ $basketItem->basket_item_id }}">حذف</button>
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
                                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است.</p>
                                </div>
                                <div class="col-md-6 text-right">
                                    <ul class="list-unstyled">
                                        <li><strong>زیر مجموع:-</strong> 2930.00</li>
                                        <li class="text-danger"><strong>تخفیف:-</strong> 12.9%</li>
                                        <li><strong>مالیات بر ارزش افزوده:-</strong> 12.9%</li>
                                    </ul>
                                    <h3 class="mb-0 text-success">2930.00 تومان</h3>
                                    <a href="javascript:void(0);" class="btn btn-info"><i class="zmdi zmdi-print"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-primary">تایید</a>
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
