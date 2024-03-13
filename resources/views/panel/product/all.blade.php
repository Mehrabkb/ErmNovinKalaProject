@extends('panel.master')
@section('title' , 'محصولات')

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
                                <th>نام انگلیسی دسته</th>
                                <th>نام فارسی دسته</th>
                                <th>عکس</th>
                                <th>والد</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $count = 0 ;
                            @endphp
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>
                                        {{ $category->english_category }}
                                    </td>
                                    <td>
                                        {{ $category->persian_category }}
                                    </td>
                                    <td>
                                        @if($category->image != '')
                                            <img style="width: 60px; height: 60px; object-fit: contain;" src="{{ asset($category->image)}}">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $category->parent_category_id }}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-delete-category" data-url="{{ route('delete.category.product') }}" data-id="{{ $category->product_category_id }}" data-toggle="modal" data-target="#delete-modal">حذف</button>
                                        <button class="btn btn-primary btn-edit-category-step-one" data-url="{{ route('get.category.product') }}" data-id="{{ $category->product_category_id }}" data-method="GET" data-toggle="modal" data-target="#edit-modal">ویرایش</button>
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
