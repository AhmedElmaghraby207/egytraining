@section('title')
    بيانات الاختبار
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="container">
                    <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><p style="margin-top: 0px" class="text-center h3">الاختبار لدورة</p>{{$test->course->name}}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-9 col-sm-offset-2">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>الكورس:</td>
                                                        <td>{{$test->course->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>المدرب:</td>
                                                        <td>{{$test->coach->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>السؤال</td>
                                                        <td>{{$test->question}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الاجابة الاولى</td>
                                                        <td>{{$test->first_ans}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الاجابة الثانية</td>
                                                        <td>{{$test->second_ans}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الاجابة الثالثة</td>
                                                        <td>{{$test->third_ans}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الاجابة الصحيحة</td>
                                                        <td>{{$test->correct_ans}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الحالة</td>
                                                        @if($test->active == 0)
                                                            <td><p class="text-danger">متوقف</p></td>
                                                        @else
                                                            <td><p class="text-primary">مفعل</p></td>
                                                        @endif
                                                    </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    @if($test->active)
                                        <a href="{{route('admin-test.deActive', $test->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a>
                                    @else
                                        <a href="{{route('admin-test.active', $test->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a>
                                    @endif

                                    <a href="{{route('admin-tests.edit', $test->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>


                                    <form action="{{route('admin-tests.create')}}"  data-original-title="حذف" method="get" data-toggle="tooltip" class="pull-right" >
                                        @csrf()
                                        <input type="hidden" name="course_id" value="{{$test->course->id}}">
                                        <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> إضافة إختبار للدورة</button>
                                    </form>

                                    <a href="#" class="text-danger bold btn btn-sm btn-danger" style="margin-right: 20px" data-toggle="tooltip" class="pull-left"
                                       onclick="
                                               var result = confirm('هل أنت متأكد من حذف هذا الاختبار؟');
                                               if(result)
                                               {
                                               event.preventDefault();
                                               document.getElementById('delete-form-{{ $test->id }}').submit();
                                               }
                                               "
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <i class="glyphicon glyphicon-remove"></i> حذف
                                    </a>
                                    <form id="delete-form-{{ $test->id }}" action="{{route('admin-tests.destroy', $test->id)}}" method="POST">
                                        @csrf()
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
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
                "autoWidth": false
            });
        });
    </script>

@stop

@include('admin.layouts.footer')

