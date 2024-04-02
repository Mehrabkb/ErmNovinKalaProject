@extends('customerPanel.master')
@section('title' , 'ثبت سفارش')

@section('css')

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
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>طرح بندی</strong> درون خطی</h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="form-group">
                                            <input id="search-bar" data-url="{{ route('product.search.result') }}" class="form-control" autocomplete="off" placeholder="جستجو محصول...">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <select class="form-control show-tick ms select2 slc-products">
                                            <option selected disabled>انتخاب کنید</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="form-group">
                                            <input type="number" min="1" value="1" class="form-control" placeholder="تعداد">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <button type="button" class="btn btn-raised btn-primary btn-round waves-effect m-l-20">افزودن</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


@section('js')
    <script>
    </script>
    <script src="{{ asset('customerPanel/assets/myJs/factorAdd.js') }}"></script>
@endsection
