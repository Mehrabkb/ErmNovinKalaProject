@extends('customerPanel.master')
@section ('title' , 'داشبرد')
@section('content')

    <section class="content">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>داشبورد</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> نوین کالا</a></li>
                            <li class="breadcrumb-item active">داشبورد</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
{{--                    <div class="col-lg-5 col-md-6 col-sm-12">--}}
{{--                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon traffic">
                            <div class="body">
                                <h6>پیش فاکتورها</h6>
                                <h2 style="color: #ee2558;">{{  count($pre_factors) }} <small class="info">عدد</small></h2>
{{--                                <small>2٪ بالاتر از ماه گذشته</small>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
{{--                    <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                        <div class="card widget_2 big_icon sales">--}}
{{--                            <div class="body">--}}
{{--                                <h6>فروش</h6>--}}
{{--                                <h2>12% <small class="info">از 100</small></h2>--}}
{{--                                <small>6٪ بالاتر از ماه گذشته</small>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%;"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                        <div class="card widget_2 big_icon email">--}}
{{--                            <div class="body">--}}
{{--                                <h6>ایمیل</h6>--}}
{{--                                <h2>39 <small class="info">از 100</small></h2>--}}
{{--                                <small>مجموع ایمیل ثبت شده</small>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar l-purple" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                        <div class="card widget_2 big_icon domains">--}}
{{--                            <div class="body">--}}
{{--                                <h6>دامنه ها</h6>--}}
{{--                                <h2>8 <small class="info">از 10</small></h2>--}}
{{--                                <small>مجموع دامنه ثبت شده</small>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card widget_2 big_icon domains">
                            <div class="body">
                                <tgju
                                    type="ticker-single"
                                    items="137203"
                                    columns="dot"
                                    token="webservice"
                                ></tgju>
                                <script src="https://api.tgju.org/v1/widget/v2" defer></script>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="row clearfix">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h2><strong><i class="zmdi zmdi-chart"></i> گزارش</strong> فروش</h2>--}}
{{--                                <ul class="header-dropdown">--}}
{{--                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>--}}
{{--                                        <ul class="dropdown-menu dropdown-menu-right slideUp">--}}
{{--                                            <li><a href="javascript:void(0);">ویرایش</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">حذف</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">گزارش</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="remove">--}}
{{--                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="body mb-2">--}}
{{--                                <div class="row clearfix">--}}
{{--                                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                                        <div class="state_w1 mb-1 mt-1">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <div>--}}
{{--                                                    <h5>2,365</h5>--}}
{{--                                                    <span><i class="zmdi zmdi-balance"></i> درآمد</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#868e96">5,2,3,7,6,4,8,1</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                                        <div class="state_w1 mb-1 mt-1">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <div>--}}
{{--                                                    <h5>365</h5>--}}
{{--                                                    <span><i class="zmdi zmdi-turning-sign"></i> بازگشت</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#2bcbba">8,2,6,5,1,4,4,3</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                                        <div class="state_w1 mb-1 mt-1">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <div>--}}
{{--                                                    <h5>65</h5>--}}
{{--                                                    <span><i class="zmdi zmdi-alert-circle-o"></i> پرس و جوها</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#82c885">4,4,3,9,2,1,5,7</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                                        <div class="state_w1 mb-1 mt-1">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <div>--}}
{{--                                                    <h5>2,055</h5>--}}
{{--                                                    <span><i class="zmdi zmdi-print"></i> صورتحساب ها</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#45aaf2">7,5,3,8,4,6,2,9</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="body">--}}
{{--                                <div id="chart-area-spline-sracked" class="c3_chart d_sales"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row clearfix">--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="card mcard_4">--}}
{{--                            <div class="body">--}}
{{--                                <ul class="header-dropdown list-unstyled">--}}
{{--                                    <li class="dropdown">--}}
{{--                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-menu"></i> </a>--}}
{{--                                        <ul class="dropdown-menu slideUp">--}}
{{--                                            <li><a href="javascript:void(0);">ویرایش</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">حذف</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">گزارش</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <div class="img">--}}
{{--                                    <img src="assets/images/lg/avatar1.jpg" class="rounded-circle" alt="profile-image">--}}
{{--                                </div>--}}
{{--                                <div class="user">--}}
{{--                                    <h5 class="mt-3 mb-1">آرش خادملو</h5>--}}
{{--                                    <small class="text-muted">طراح رابط گرافیکی</small>--}}
{{--                                </div>--}}
{{--                                <ul class="list-unstyled social-links">--}}
{{--                                    <li><a href="javascript:void(0);"><i class="zmdi zmdi-dribbble"></i></a></li>--}}
{{--                                    <li><a href="javascript:void(0);"><i class="zmdi zmdi-behance"></i></a></li>--}}
{{--                                    <li><a href="javascript:void(0);"><i class="zmdi zmdi-pinterest"></i></a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                        <div class="card w_data_1">--}}
{{--                        <div class="body">--}}
{{--                                <div class="w_icon pink"><i class="zmdi zmdi-bug"></i></div>--}}
{{--                                <h4 class="mt-3 mb-0">12.1k</h4>--}}
{{--                                <span class="text-muted">اشکالات ثابت شده</span>--}}
{{--                                <div class="w_description text-success">--}}
{{--                                    <i class="zmdi zmdi-trending-up"></i>--}}
{{--                                    <span>15.5%</span>--}}
{{--                                </div>--}}
{{--                        </div>--}}
{{--                        </div>--}}
{{--                        <div class="card w_data_1">--}}
{{--                            <div class="body">--}}
{{--                                <div class="w_icon cyan"><i class="zmdi zmdi-ticket-star"></i></div>--}}
{{--                                <h4 class="mt-3 mb-1">01.8k</h4>--}}
{{--                                <span class="text-muted">تکرارهای ارسال شده</span>--}}
{{--                                <div class="w_description text-success">--}}
{{--                                    <i class="zmdi zmdi-trending-up"></i>--}}
{{--                                    <span>95.5%</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="body">--}}
{{--                                <div class="chat-widget">--}}
{{--                                    <ul class="list-unstyled">--}}
{{--                                        <li class="left">--}}
{{--                                            <img src="assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>آرش 11:00 صبح</small></li>--}}
{{--                                                <li><span class="message bg-blue">سلام, آرش</span></li>--}}
{{--                                                <li><span class="message bg-blue">حال شما چطور است!</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="right">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>11:10AM</small></li>--}}
{{--                                                <li><span class="message">سلام, آرش</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="right">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>11:11 صبح</small></li>--}}
{{--                                                <li><span class="message">من خوبم شما چطوری؟</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="left">--}}
{{--                                            <img src="assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>آرش 11:11 صبح</small></li>--}}
{{--                                                <li><span class="message bg-indigo">سلام, آرش و آرش</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="left">--}}
{{--                                            <img src="assets/images/xs/avatar5.jpg" class="rounded-circle" alt="">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>آرش 11:11 صبح</small></li>--}}
{{--                                                <li><span class="message bg-amber">سلام, تیم</span></li>--}}
{{--                                                <li><span class="message bg-amber">لطفا اجازه دهید من نیازهای شما را بشناسم.</span></li>--}}
{{--                                                <li><span class="message bg-amber">چگونه می خواهیم با ما ارتباط برقرار کنیم؟</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                        <li class="right">--}}
{{--                                            <ul class="list-unstyled chat_info">--}}
{{--                                                <li><small>11:11 صبح</small></li>--}}
{{--                                                <li><span class="message">سلام, آرش</span></li>--}}
{{--                                                <li><span class="message">جلسه در اتاق کنفرانس در 12:00 غروب</span></li>--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div class="input-group mt-3">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">اضافه</button>--}}
{{--                                        <div class="dropdown-menu">--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);">آرش خادملو</a>--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);">آرش خادملو</a>--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);">آرش خادملو</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <input type="text" class="form-control" placeholder="متن اینجا وارد کنید ..." aria-label="Text input with dropdown button">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <span class="input-group-text"><i class="zmdi zmdi-mail-send"></i></span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row clearfix">--}}
{{--                    <div class="col-md-12 col-lg-8">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h2><strong>آمار</strong> بازدید کنندگان</h2>--}}
{{--                                <ul class="header-dropdown">--}}
{{--                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>--}}
{{--                                        <ul class="dropdown-menu dropdown-menu-right slideUp">--}}
{{--                                            <li><a href="javascript:void(0);">اقدام</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">اقدام دیگر</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">یک چیز دیگر</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="remove">--}}
{{--                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="body">--}}
{{--                                <div id="world-map-markers" class="jvector-map"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-4 col-md-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h2><strong>توزیع</strong></h2>--}}
{{--                                <ul class="header-dropdown">--}}
{{--                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>--}}
{{--                                        <ul class="dropdown-menu dropdown-menu-right slideUp">--}}
{{--                                            <li><a href="javascript:void(0);">ویرایش</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">حذف</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">گزارش</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="remove">--}}
{{--                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="body text-center">--}}
{{--                                <div id="chart-pie" class="c3_chart d_distribution"></div>--}}
{{--                                <button class="btn btn-primary mt-4 mb-4">مشاهده بیشتر</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row clearfix">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="header">--}}
{{--                                <h2><strong>منبع</strong> ترافیک</h2>--}}
{{--                                <ul class="header-dropdown">--}}
{{--                                    <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>--}}
{{--                                        <ul class="dropdown-menu dropdown-menu-right slideUp">--}}
{{--                                            <li><a href="javascript:void(0);">ویرایش</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">حذف</a></li>--}}
{{--                                            <li><a href="javascript:void(0);">گزارش</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                    <li class="remove">--}}
{{--                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-8 col-md-6 col-sm-12">--}}
{{--                                        <div id="chart-area-step" class="c3_chart d_traffic"></div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-4 col-md-6 col-sm-12">--}}
{{--                                        <span> بیش از 30 درصد از کاربران از لینک مستقیم پیروی می کنند. برای اطلاعات بیشتر صفحه جزئیات را بررسی کنید.</span>--}}
{{--                                        <div class="progress mt-4">--}}
{{--                                            <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex bd-highlight mt-4">--}}
{{--                                            <div class="flex-fill bd-highlight">--}}
{{--                                                <h5 class="mb-0">21,521 <i class="zmdi zmdi-long-arrow-up"></i></h5>--}}
{{--                                                <small>امروز</small>--}}
{{--                                            </div>--}}
{{--                                            <div class="flex-fill bd-highlight">--}}
{{--                                                <h5 class="mb-0">%12.35 <i class="zmdi zmdi-long-arrow-down"></i></h5>--}}
{{--                                                <small>ماه گذشته %</small>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </section>
@endsection


