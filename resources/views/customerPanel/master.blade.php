<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>:: آرئو مدیریت بوت استرپ 4 :: خانه</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/charts-c3/plugin.css"/>

<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/plugins/morrisjs/morris.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('customerPanel') }}/assets/css/style.min.css">
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{ asset('customerPanel') }}/assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>لطفا صبر کنید...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
      <input type="search" value="" placeholder="جستجو..." />
      <button type="submit" class="btn btn-primary">جستجو</button>
    </form>
</div>

<!-- Right Icon menu Sidebar -->
{{--<div class="navbar-right">--}}
{{--    <ul class="navbar-nav">--}}
{{--        <li><a href="#search" class="main_search" title="Search..."><i class="zmdi zmdi-search"></i></a></li>--}}
{{--        <li class="dropdown">--}}
{{--            <a href="javascript:void(0);" class="dropdown-toggle" title="App" data-toggle="dropdown" role="button"><i class="zmdi zmdi-apps"></i></a>--}}
{{--            <ul class="dropdown-menu slideUp2">--}}
{{--                <li class="header">میانبر برنامه</li>--}}
{{--                <li class="body">--}}
{{--                    <ul class="menu app_sortcut list-unstyled">--}}
{{--                        <li>--}}
{{--                            <a href="image-gallery.html">--}}
{{--                                <div class="icon-circle mb-2 bg-blue"><i class="zmdi zmdi-camera"></i></div>--}}
{{--                                <p class="mb-0">عکس ها</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle mb-2 bg-amber"><i class="zmdi zmdi-translate"></i></div>--}}
{{--                                <p class="mb-0">ترجمه</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="events.html">--}}
{{--                                <div class="icon-circle mb-2 bg-green"><i class="zmdi zmdi-calendar"></i></div>--}}
{{--                                <p class="mb-0">تقویم</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="contact.html">--}}
{{--                                <div class="icon-circle mb-2 bg-purple"><i class="zmdi zmdi-account-calendar"></i></div>--}}
{{--                                <p class="mb-0">مخاطبین</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle mb-2 bg-red"><i class="zmdi zmdi-tag"></i></div>--}}
{{--                                <p class="mb-0">اخبار</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle mb-2 bg-grey"><i class="zmdi zmdi-map"></i></div>--}}
{{--                                <p class="mb-0">نقشه ها</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="dropdown">--}}
{{--            <a href="javascript:void(0);" class="dropdown-toggle" title="Notifications" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>--}}
{{--                <div class="notify"><span class="heartbit"></span><span class="point"></span></div>--}}
{{--            </a>--}}
{{--            <ul class="dropdown-menu slideUp2">--}}
{{--                <li class="header">اطلاعیه ها</li>--}}
{{--                <li class="body">--}}
{{--                    <ul class="menu list-unstyled">--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4>8 عضو جدید عضو شدند</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 14 دقیقه پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-amber"><i class="zmdi zmdi-shopping-cart"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4>4 فروش انجام شده است</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 14 دقیقه پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4><b>اسم فرضی</b> حساب حذف شده</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 3 ساعت پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4><b>اسم فرضی</b> نام تغییر کرده است</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 3 ساعت پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4><b>آرش</b> پست شما را بررسی کرده است</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 3 ساعت پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4><b>آرش</b> وضعیت به روز شده</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> 3 ساعت پیش </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a href="javascript:void(0);">--}}
{{--                                <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>--}}
{{--                                <div class="menu-info">--}}
{{--                                    <h4>تنظیمات به روز شد</h4>--}}
{{--                                    <p><i class="zmdi zmdi-time"></i> دیروز </p>--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li class="footer"> <a href="javascript:void(0);">مشاهده تمام اعلان ها</a> </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="dropdown">--}}
{{--            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i>--}}
{{--            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>--}}
{{--            </a>--}}
{{--            <ul class="dropdown-menu slideUp2">--}}
{{--                <li class="header">لیست وظیفه ها <small class="float-right"><a href="javascript:void(0);">نمایش همه</a></small></li>--}}
{{--                <li class="body">--}}
{{--                    <ul class="menu tasks list-unstyled">--}}
{{--                        <li>--}}
{{--                            <div class="progress-container progress-primary">--}}
{{--                                <span class="progress-badge">وب سایت تجاری</span>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">--}}
{{--                                        <span class="progress-value">86%</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <ul class="list-unstyled team-info">--}}
{{--                                    <li class="m-r-15"><small>تیم</small></li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar2.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar3.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar4.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <div class="progress-container">--}}
{{--                                <span class="progress-badge">بازی ساز iOS</span>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">--}}
{{--                                        <span class="progress-value">45%</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <ul class="list-unstyled team-info">--}}
{{--                                    <li class="m-r-15"><small>تیم</small></li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar10.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar9.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar8.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar7.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar6.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <div class="progress-container progress-warning">--}}
{{--                                <span class="progress-badge">توسعه خانه</span>--}}
{{--                                <div class="progress">--}}
{{--                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;">--}}
{{--                                        <span class="progress-value">29%</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <ul class="list-unstyled team-info">--}}
{{--                                    <li class="m-r-15"><small>تیم</small></li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar5.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar2.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <img src="{{ asset('customerPanel') }}/assets/images/xs/avatar7.jpg" alt="Avatar">--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li><a href="javascript:void(0);" class="app_calendar" title="تقویم"><i class="zmdi zmdi-calendar"></i></a></li>--}}
{{--        <li><a href="javascript:void(0);" class="app_google_drive" title="Google Drive"><i class="zmdi zmdi-google-drive"></i></a></li>--}}
{{--        <li><a href="javascript:void(0);" class="app_group_work" title="Group Work"><i class="zmdi zmdi-group-work"></i></a></li>--}}
{{--        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>--}}
{{--        <li><a href="sign-in.html" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a></li>--}}
{{--    </ul>--}}
{{--</div>--}}

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="index.html"><img src="{{ asset('pictures/logo.png') }}" width="25" alt="نوین کالا"><span class="m-l-10">نوین کالا</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="profile.html"><img src="{{ asset('customerPanel') }}/assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4>{{ Auth::user()->user_name }}</h4>
                        <small>مشتری</small>
                    </div>
                </div>
            </li>
            <li class="active open"><a href="{{ route('customer.panel.home') }}"><i class="zmdi zmdi-home"></i><span>داشبورد</span></a></li>
            <li class="active open"><a href="{{ route('customer.logout' , ['id' => Auth::user()->user_id]) }}"><i class="zmdi zmdi-sign-in"></i><span>خروج</span></a></li>
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>برنامه</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="mail-inbox.html">ایمیل</a></li>--}}
{{--                    <li><a href="chat.html">برنامه چت</a></li>--}}
{{--                    <li><a href="events.html">تقویم</a></li>--}}
{{--                    <li><a href="contact.html">مخاطب</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>پروژه ها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="project-list.html">لیست پروژه</a></li>--}}
{{--                    <li><a href="taskboard.html">نوار وظیفه</a></li>--}}
{{--                    <li><a href="ticket-list.html">لیست تیکت</a></li>--}}
{{--                    <li><a href="ticket-detail.html">جزئیات تیکت</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-folder"></i><span>مدیریت فایل</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="file-dashboard.html">همه فایل ها</a></li>--}}
{{--                    <li><a href="file-documents.html">اسناد</a></li>--}}
{{--                    <li><a href="file-images.html">تصاویر</a></li>--}}
{{--                    <li><a href="file-media.html">رسانه</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-blogger"></i><span>وبلاگ</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="blog-dashboard.html">داشبورد</a></li>--}}
{{--                    <li><a href="blog-post.html">پست وبلاگ</a></li>--}}
{{--                    <li><a href="blog-list.html">نمایش لیست</a></li>--}}
{{--                    <li><a href="blog-grid.html">نمایش گرید</a></li>--}}
{{--                    <li><a href="blog-details.html">جزئیات وبلاگ</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-shopping-cart"></i><span>تجارت الکترونیک</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="ec-dashboard.html">داشبورد</a></li>--}}
{{--                    <li><a href="ec-product.html">محصول</a></li>--}}
{{--                    <li><a href="ec-product-List.html">لیست محصول</a></li>--}}
{{--                    <li><a href="ec-product-detail.html">جزئیات محصول</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>ابزارک ها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="ui_kit.html">کیت عناصر کاربردی</a></li>--}}
{{--                    <li><a href="alerts.html">هشدارها</a></li>--}}
{{--                    <li><a href="collapse.html">سقوط</a></li>--}}
{{--                    <li><a href="colors.html">رنگ ها</a></li>--}}
{{--                    <li><a href="dialogs.html">گفتگوها</a></li>--}}
{{--                    <li><a href="list-group.html">گروه لیست</a></li>--}}
{{--                    <li><a href="media-object.html">شیء رسانه</a></li>--}}
{{--                    <li><a href="modals.html">مودال ها</a></li>--}}
{{--                    <li><a href="notifications.html">اطلاعیه ها</a></li>--}}
{{--                    <li><a href="progressbars.html">نوار پیشرفت</a></li>--}}
{{--                    <li><a href="range-sliders.html">اسلایدر محدوده</a></li>--}}
{{--                    <li><a href="sortable-nestable.html">قابل مرتب شدن و ناپایداری</a></li>--}}
{{--                    <li><a href="tabs.html">زبانه ها</a></li>--}}
{{--                    <li><a href="waves.html">امواج</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-flower"></i><span>آیکون های فونت</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="icons.html">آیکون های متریال</a></li>--}}
{{--                    <li><a href="icons-themify.html">آیکون های Themify</a></li>--}}
{{--                    <li><a href="icons-weather.html">آیکون های آب و هوا</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>فرم ها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="basic-form-elements.html">فرم پایه</a></li>--}}
{{--                    <li><a href="advanced-form-elements.html">فرم پیشرفته</a></li>--}}
{{--                    <li><a href="form-examples.html">نمونه های فرم</a></li>--}}
{{--                    <li><a href="form-validation.html">فرم اعتبار سنجی</a></li>--}}
{{--                    <li><a href="form-wizard.html">فرم پیشرفته</a></li>--}}
{{--                    <li><a href="form-editors.html">ویرایشگرها</a></li>--}}
{{--                    <li><a href="form-upload.html">آپلود فایل</a></li>--}}
{{--                    <li><a href="form-summernote.html">سامرنوت</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-grid"></i><span>جداول</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="normal-tables.html">جداول معمولی</a></li>--}}
{{--                    <li><a href="jquery-datatable.html">پایگاه داده جی کوئری</a></li>--}}
{{--                    <li><a href="editable-table.html">جداول قابل ویرایش</a></li>--}}
{{--                    <li><a href="footable.html">جداول فو</a></li>--}}
{{--                    <li><a href="table-color.html">رنگ جداول</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-chart"></i><span>نمودارها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="c3.html">نمودار C3</a></li>--}}
{{--                    <li><a href="morris.html">موریس</a></li>--}}
{{--                    <li><a href="flot.html">فلوت</a></li>--}}
{{--                    <li><a href="chartjs.html">نمودار JS</a></li>--}}
{{--                    <li><a href="sparkline.html">اسپارک لاین</a></li>--}}
{{--                    <li><a href="jquery-knob.html">تهیه کننده جی کوئری</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-delicious"></i><span>ابزارک ها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="widgets-app.html">ابزارک برنامه ها</a></li>--}}
{{--                    <li><a href="widgets-data.html">ابزارک داده</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-lock"></i><span>احراز هویت</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="sign-in.html">ورود</a></li>--}}
{{--                    <li><a href="sign-up.html">ثبت نام</a></li>--}}
{{--                    <li><a href="forgot-password.html">فراموشی رمزعبور</a></li>--}}
{{--                    <li><a href="404.html">صفحه 404</a></li>--}}
{{--                    <li><a href="500.html">صفحه 500</a></li>--}}
{{--                    <li><a href="page-offline.html">صفحه آفلاین</a></li>--}}
{{--                    <li><a href="locked.html">صفحه قفل شده</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-copy"></i><span>صفحات نمونه</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="blank.html">صفحه خالی</a></li>--}}
{{--                    <li><a href="image-gallery.html">گالری تصویر</a></li>--}}
{{--                    <li><a href="profile.html">پروفایل</a></li>--}}
{{--                    <li><a href="timeline.html">زمان بندی</a></li>--}}
{{--                    <li><a href="pricing.html">قیمت گذاری</a></li>--}}
{{--                    <li><a href="invoices.html">صورتحساب ها</a></li>--}}
{{--                    <li><a href="invoices-list.html">لیست صورتحساب ها</a></li>--}}
{{--                    <li><a href="search-results.html">نتایج جستجو</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="open_top"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-map"></i><span>نقشه ها</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li><a href="google.html">نقشه گوگل</a></li>--}}
{{--                    <li><a href="yandex.html">نقشه یاندکس</a></li>--}}
{{--                    <li><a href="jvectormap.html">نقشه jVector</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="progress-container progress-primary m-t-10">--}}
{{--                    <span class="progress-badge">ترافیک این ماه</span>--}}
{{--                    <div class="progress">--}}
{{--                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100" style="width: 67%;">--}}
{{--                            <span class="progress-value">67%</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="progress-container progress-info">--}}
{{--                    <span class="progress-badge">بارگذاری سرور</span>--}}
{{--                    <div class="progress">--}}
{{--                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">--}}
{{--                            <span class="progress-value">86%</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
        </ul>
    </div>
</aside>

<!-- Right Sidebar -->
<aside id="rightsidebar" class="right-sidebar">
    <ul class="nav nav-tabs sm">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat"><i class="zmdi zmdi-comments"></i></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="setting">
            <div class="slim_scroll">
                <div class="card">
                    <h6>گزینه تم</h6>
                    <div class="light_dark">
                        <div class="radio">
                            <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                            <label for="lighttheme">حالت روشن</label>
                        </div>
                        <div class="radio mb-0">
                            <input type="radio" name="radio1" id="darktheme" value="dark">
                            <label for="darktheme">حالت تاریک</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <h6>پوسته های رنگی</h6>
                    <ul class="choose-skin list-unstyled">
                        <li data-theme="purple"><div class="purple"></div></li>
                        <li data-theme="blue"><div class="blue"></div></li>
                        <li data-theme="cyan"><div class="cyan"></div></li>
                        <li data-theme="green"><div class="green"></div></li>
                        <li data-theme="orange"><div class="orange"></div></li>
                        <li data-theme="blush" class="active"><div class="blush"></div></li>
                    </ul>
                </div>
                <div class="card">
                    <h6>تنظیمات عمومی</h6>
                    <ul class="setting-list list-unstyled">
                        <li>
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox">
                                <label for="checkbox1">گزارش استفاده از پانل</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox2" type="checkbox" checked="">
                                <label for="checkbox2">ایمیل تغییر مسیر</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox3" type="checkbox" checked="">
                                <label for="checkbox3">اطلاعیه ها</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox4" type="checkbox">
                                <label for="checkbox4">به روز رسانی خودکار</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox5" type="checkbox" checked="">
                                <label for="checkbox5">آفلاین</label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input id="checkbox6" type="checkbox" checked="">
                                <label for="checkbox6">مجوز محل سکونت</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-pane right_chat" id="chat">
            <div class="slim_scroll">
                <div class="card">
                    <ul class="list-unstyled">
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('customerPanel') }}/assets/images/xs/avatar4.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">آرش <small class="float-right">11:00 صبح</small></span>
                                        <span class="message">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ </span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('customerPanel') }}/assets/images/xs/avatar5.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">آرش <small class="float-right">11:30 صبح</small></span>
                                        <span class="message">لورم ایپسوم متن ساختگی با تولید سادگی</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="offline">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('customerPanel') }}/assets/images/xs/avatar2.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">آرش <small class="float-right">11:30 صبح</small></span>
                                        <span class="message">لورم ایپسوم متن ساختگی با تولید سادگی</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="me">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('customerPanel') }}/assets/images/xs/avatar1.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">آرش <small class="float-right">11:30 صبح</small></span>
                                        <span class="message">لورم ایپسوم متن ساختگی با تولید سادگی</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="online">
                            <a href="javascript:void(0);">
                                <div class="media">
                                    <img class="media-object " src="{{ asset('customerPanel') }}/assets/images/xs/avatar3.jpg" alt="">
                                    <div class="media-body">
                                        <span class="name">آرش <small class="float-right">11:30 صبح</small></span>
                                        <span class="message">لورم ایپسوم متن ساختگی با تولید سادگی</span>
                                        <span class="badge badge-outline status"></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</aside>

<!-- Main Content -->


@yield('content')





<!-- Jquery Core Js -->
<script src="{{ asset('customerPanel') }}/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="{{ asset('customerPanel') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="{{ asset('customerPanel') }}/assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="{{ asset('customerPanel') }}/assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
<script src="{{ asset('customerPanel') }}/assets/bundles/c3.bundle.js"></script>

<script src="{{ asset('customerPanel') }}/assets/bundles/mainscripts.bundle.js"></script>
<script src="{{ asset('customerPanel') }}/assets/js/pages/index.js"></script>

</body>

</html>
