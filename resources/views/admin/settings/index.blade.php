@section('title')
    الاعدادات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="text-primary text-center">الاعدادات</h2>
                    <a href="{{route('settings.edit', 1)}}" class="btn btn-block btn-info"> تعديل <i class="fa fa-edit"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body col-sm-8 col-sm-offset-2 form-group">
                    <div class="text-center form-group">
                        <h3>اسم الموقع</h3>
                        <p class="form-control">{{$setting->site_name? $setting->site_name : 'غير محدد'}}</p>
                    </div>
                    <div class="text-center form-group">
                        <h3>نسبة الموقع من الدورات</h3>
                        <p class="form-control">{{$setting->percent? $setting->percent : 'غير محدد'}}</p>
                    </div>
                    <br>
                    <div class="text-center form-group">
                        <h3>اللوجو</h3>
                        @if($setting->logo != null)
                            <img class="img-rounded" width="200" height="150" src="{{asset($setting->logo)}}" alt="">
                        @else
                            <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                        @endif
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>الايكونة</h3>
                        @if($setting->icon != null)
                            <img class="img-rounded" width="200" height="150" src="{{asset($setting->icon)}}" alt="">
                        @else
                            <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                        @endif
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>محتوى من نحن</h3>
                        <h6 class="form-control">{!! $setting->about_content? $setting->about_content : 'غير محدد' !!}</h6>
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>صورة من نحن</h3>
                        @if($setting->about_image != null)
                            <img class="img-rounded" width="200" height="150" src="{{asset($setting->about_image)}}" alt="">
                        @else
                            <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                        @endif
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>سياسة الخصوصة للمتدرب</h3>
                        <h6 class="form-control">{!! $setting->trainer_privacy ? $setting->trainer_privacy : 'غير محدد' !!}</h6>
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>سياسة الخصوصية للمدرب</h3>
                        <h6 class="form-control">{!! $setting->coach_privacy ? $setting->coach_privacy : 'غير محدد' !!}</h6>
                    </div>
                    <div class="text-center">
                        <h3>محتوى رسالة الرد على رسائل التواصل</h3>
                        <h6 class="form-control">{!! $setting->reply_msg ? $setting->reply_msg : 'غير محدد' !!}</h6>
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>لينك صفحة Facebook</h3>
                        <p class="form-control">{{$setting->facebook ? $setting->facebook : 'غير محدد'}}</p>
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>لينك صفحة Twitter</h3>
                        <p class="form-control">{{$setting->twitter ? $setting->twitter : 'غير محدد'}}</p>
                    </div>
                    <br>
                    <div class="text-center">
                        <h3>لينك صفحة Linkedin</h3>
                        <p class="form-control">{{$setting->linkedin ? $setting->linkedin : 'غير محدد'}}</p>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>

@section('scripts')

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                select: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }, {
                    extend: "colvis",
                    className: "btn dark btn-outline",
                    text: "Columns"
                }],
            });
        });
    </script>


@stop

@include('admin.layouts.footer')

