@section('title')
    تعيل الاعدادات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="text-info text-center">تعديل الاعدادات</h2>
                    <a href="{{route('settings.index')}}" class="btn btn-block btn-danger"> إلغاء التعديل <i class="fa fa-remove"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body col-sm-8 col-sm-offset-2 form-group">
                    <form action="{{route('settings.update', $setting->id)}}" method="post" enctype="multipart/form-data">
                        @csrf()
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger text-center">{{$error}}</p>
                            @endforeach
                        @endif
                        <input type="hidden" name="_method" value="put">
                        <div class="text-center form-group">
                            <h3>اسم الموقع</h3>
                            <input class="form-control" type="text" name="site_name" value="{{$setting->site_name}}">
                        </div>
                        <div class="text-center form-group">
                            <h3>نسبة الموقع من الدورات</h3>
                            <input class="form-control" type="text" name="percent" value="{{$setting->percent}}">
                        </div>
                        <br>
                        <div class="text-center form-group">
                            <h3>اللوجو</h3>
                            @if($setting->logo != null)
                                <img class="img-rounded" width="200" height="150" src="{{asset($setting->logo)}}" alt="">
                            @else
                                <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                            @endif
                            <input class="form-control" type="file" name="logo">
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>الايكونة</h3>
                            @if($setting->icon != null)
                                <img class="img-rounded" width="200" height="150" src="{{asset($setting->icon)}}" alt="">
                            @else
                                <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                            @endif
                            <input class="form-control" type="file" name="icon">
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>محتوى من نحن</h3>
                            <textarea id="editor1" class="textarea" name="about_content" placeholder="إكتب محتوى من نحن هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$setting->about_content}}
                            </textarea>
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>صورة من نحن</h3>
                            @if($setting->about_image != null)
                                <img class="img-rounded" width="200" height="150" src="{{asset($setting->about_image)}}" alt="">
                            @else
                                <img class="img-rounded" width="200" height="150" src="{{asset('http://via.placeholder.com/200x150')}}" alt="">
                            @endif
                            <input class="form-control" type="file" name="about_image">
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>سياسة الخصوصة للمتدرب</h3>
                            <textarea id="editor1" class="textarea" name="trainer_privacy" placeholder="إكتب سياسة الخصوصية للمتدرب هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$setting->trainer_privacy}}
                            </textarea>
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>سياسة الخصوصية للمدرب</h3>
                            <textarea id="editor1" class="textarea" name="coach_privacy" placeholder="إكتب سياية الخصوصية للمتدرب هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$setting->coach_privacy}}
                            </textarea>
                        </div>
                        <div class="text-center">
                            <h3>محتوى رسالة الرد على رسائل التواصل</h3>
                            <textarea id="editor1" class="textarea" name="reply_msg" placeholder="إكتب محتوى الرسالة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$setting->reply_msg}}
                            </textarea>
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>لينك صفحة Facebook</h3>
                            <input class="form-control" type="url" name="facebook" value="{{$setting->facebook}}">
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>لينك صفحة Twitter</h3>
                            <input class="form-control" type="url" name="twitter" value="{{$setting->twitter}}">
                        </div>
                        <br>
                        <div class="text-center">
                            <h3>لينك صفحة Linkedin</h3>
                            <input class="form-control" type="url" name="linkedin" value="{{$setting->linkedin}}">
                        </div>

                        <div class="text-center">
                            <button class="btn btn-block btn-info form-control">حفظ التعديلات</button>
                        </div>

                    </form>
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

