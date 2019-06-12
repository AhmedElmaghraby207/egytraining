@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="margin-top: 20px" class="text-center panel-heading">
            معلومات الموقع
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box" style="margin-top: 20px">
            <div class="row" style=" margin: 20px 8px 8px 10px;">

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{count(\App\Certificate::all())}}</h3>

                            <p class="h3">الشهادات</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <a href="{{route('admin-certificates.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{count(\App\Lecture::all())}}</h3>

                            <p class="h1">الدروس</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-video-camera"></i>
                        </div>
                        <a href="{{route('admin-lectures.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{count(\App\Course::all())}}</h3>
                            <p class="h1">الدورات</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-th"></i>
                        </div>
                        <a href="{{route('admin-courses.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{count(\App\Category::all())}}</h3>
                            <p class="h1">الاقسام</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-puzzle-piece"></i>
                        </div>
                        <a href="{{route('admin-categories.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{count(\App\Comment::all())}}</h3>

                            <p class="h3">التعليقات</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-comments"></i>
                        </div>
                        <a href="{{route('admin-comments.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{count(\App\Contact::all())}}</h3>

                            <p class="h1">رسائل التواصل</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="{{route('contacts.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{count(\App\User::where('trainer', 1)->get())}}</h3>

                            <p class="h1">المتدربين</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{route('trainers.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{count(\App\User::where('coach', 1)->get())}}</h3>

                            <p class="h1">المدربين</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <a href="{{route('coaches.index')}}" class="small-box-footer">عرض الكل <i
                                    class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@include('admin.layouts.footer')