@section('title')
    الاختبارات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الاختبارات</h3>
                    <form action="{{route('admin-tests.create')}}"  data-original-title="حذف" method="get" data-toggle="tooltip" class="pull-left" >
                        @csrf()
                        <input type="hidden" name="course_id" value="0">
                        <button class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> إضافة إختبار جديد</button>
                    </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">السؤال</th>
                            <th class="text-center">الكورس</th>
                            <th class="text-center">المدرب</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tests) > 0)
                            @foreach($tests as $test)
                                <tr>
                                    <td class="text-center">{{$test->id}}</td>
                                    <td class="text-center">{{$test->question}}</td>
                                    @if($test->course)
                                        <td class="text-center"><a href="{{route('admin-courses.show', $test->course->slug)}}">{{$test->course->name}}</a></td>
                                    @else
                                        <td class="text-center">{{App\Setting::first()->site_name}}</td>
                                    @endif
                                    <td class="text-center"><a href="{{route('coaches.show', $test->coach->slug)}}">{{$test->coach->name}}</a></td>
                                    <td class="text-center"><a href="{{route('admin-tests.show', $test->slug)}}" class="btn btn-sm btn-primary">عرض</a></td>
                                    <td class="text-center">
                                        @if($test->active)
                                            <a href="{{route('admin-test.deActive', $test->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-test.active', $test->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{route('admin-tests.edit', $test->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
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
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $test->id }}" action="{{route('admin-tests.destroy', $test->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد إختبارات حتى الان</th>
                            </tr>
                        @endif
                        </tbody>

                    </table>
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
                "autoWidth": false
            });
        });
    </script>

@stop

@include('admin.layouts.footer')

