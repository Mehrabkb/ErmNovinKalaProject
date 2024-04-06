@extends('customerPanel.master')
@section('title' , 'اطلاعات کاربری')

@section('content')

    <section class="content">
        <div class="">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>داشبورد</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> نوین کالا</a></li>
                            <li class="breadcrumb-item active">اطلاعات کاربری</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    {{--                    <div class="col-lg-5 col-md-6 col-sm-12">--}}
                    {{--                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>--}}
                    {{--                    </div>--}}
                </div>
            </div>
            <div class="container-fluid">
                <!-- Vertical Layout -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
{{--                        <div class="alert alert-warning" role="alert">--}}
{{--                            <strong>بوت استرپ</strong> بهتر خودتان را بررسی کنید, <a target="_blank" href="https://getbootstrap.com/docs/4.2/components/forms/">بیشتر ببینید</a>--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                        <div class="card">
                            <div class="header">
                                <h2><strong>اطلاعات کاربری</strong></h2>
                            </div>
                            <div class="body">
                                <form action="{{ route('user.info') }}" method="POST">
                                    @csrf
                                    <label for="user_name">نام کاربری</label>
                                    <div class="form-group">
                                        <input type="text" id="user_name" name="user-name" class="form-control" value="{{ $user->user_name }}" placeholder="نام کاربری را وارد کنید">
                                    </div>
                                    <label for="email_address">آدرس ایمیل</label>
                                    <div class="form-group">
                                        <input type="text" id="email_address" name="email" class="form-control" value="{{ $user->email }}" placeholder="آدرس ایمیل خود را وارد کنید">
                                    </div>
                                    <label for="first-name">نام</label>
                                    <div class="form-group">
                                        <input type="text" id="first-name" name="first-name" class="form-control" value="{{ $user->first_name }}" placeholder="نام">
                                    </div>
                                    <label for="last-name">نام خانوادگی</label>
                                    <div class="form-group">
                                        <input type="text" id="last-name" name="last-name" class="form-control" value="{{ $user->last_name }}" placeholder="نام خانوادگی">
                                    </div>
{{--                                    <label for="password">رمزعبور</label>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <input type="password" id="password" name="password" autocomplete="off"  class="form-control" placeholder="رمز عبور خود را وارد کنید">--}}
{{--                                    </div>--}}
                                    <label for="phone">موبایل</label>
                                    <div class="form-group">
                                        <input type="text" id="phone" class="form-control" value="{{ $user->phone }}" disabled placeholder="موبایل">
                                        <input type="hidden" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <label for="company-name">نام شرکت</label>
                                    <div class="form-group">
                                        <input type="text" id="company-name" name="company-name" value="{{ $user->company_name }}" class="form-control" placeholder="نام شرکت">
                                    </div>
                                    <label for="company-phone">تلفن شرکت</label>
                                    <div class="form-group">
                                        <input type="text" id="company-phone" name="company-phone" class="form-control" value="{{ $user->company_phone }}" placeholder="تلفن شرکت">
                                    </div>
                                    <label for="company-address">آدرس شرکت</label>
                                    <div class="form-group">
                                        <input type="text" id="company-address" name="company-address" class="form-control" value="{{ $user->company_address }}" placeholder="آدرس شرکت">
                                    </div>
                                    <label for="company-website">وبسایت شرکت</label>
                                    <div class="form-group">
                                        <input type="text" id="company-website" name="company-website" class="form-control" value="{{ $user->company_website }}" placeholder="وبسایت شرکت">
                                    </div>
                                    <label for="personal-website">وبسایت شخصی</label>
                                    <div class="form-group">
                                        <input type="text" id="personal-website" name="personal-website" class="form-control" value="{{ $user->personal_website }}" placeholder="وبسایت شخصی">
                                    </div>
                                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">ثبت</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


