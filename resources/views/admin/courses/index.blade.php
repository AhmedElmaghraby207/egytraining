@section('title')
    الدورات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الدورات</h3>
                    <a href="{{route('admin-courses.create')}}" class="btn btn-success"> إضافة دورة جديدة <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الاسم</th>
                            <th class="text-center">المدرب</th>
                            <th class="text-center">القسم</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">النشر</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($courses) > 0)
                            @foreach($courses as $course)
                                <tr>
                                    <td class="text-center">{{$course->id}}</td>
                                    <td class="text-center">{{$course->name}}</td>
                                    @if($course->coach)
                                        <td class="text-center"><a href="{{route('coaches.show', $course->coach->slug)}}">{{$course->coach->name}}</a></td>
                                    @else
                                        <td class="text-center">{{App\Setting::first()->site_name}}</td>
                                    @endif
                                    <td class="text-center">{{$course->category->name}}</td>
                                    <td class="text-center"><a href="{{route('admin-courses.show', $course->slug)}}" class="btn btn-sm btn-primary">عرض</a></td>
                                    <td class="text-center">
                                        @if($course->active == 1)
                                            <a href="{{route('admin-course.deActive', $course->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-course.active', $course->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($course->published == 1)
                                            <a href="{{route('admin-course.unPublish', $course->id)}}" class="btn btn-sm btn-warning">إيقاف النشر</a>
                                        @else
                                            <a href="{{route('admin-course.publish', $course->id)}}" class="btn btn-sm btn-success">نشر</a>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{route('admin-courses.edit', $course->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذه الدورة؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $course->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $course->id }}" action="{{route('admin-courses.destroy', $course->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد كورسات حتى الان</th>
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

