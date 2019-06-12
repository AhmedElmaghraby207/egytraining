@section('title')
    الدروس
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الدروس</h3>
                    <a href="{{route('admin-lectures.create')}}" class="btn btn-success"> إضافة درس جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الاسم</th>
                            <th class="text-center">الكورس</th>
                            <th class="text-center">المدرب</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">النشر</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($lectures) > 0)
                            @foreach($lectures as $lecture)
                                <tr>
                                    <td class="text-center">{{$lecture->id}}</td>
                                    <td class="text-center">{{$lecture->name}}</td>
                                    <td class="text-center">{{$lecture->course->name}}</td>
                                    <td class="text-center">{{$lecture->coach->name}}</td>
                                    <td class="text-center"><a href="{{route('admin-lectures.show', $lecture->slug)}}" class="btn btn-sm btn-primary">عرض</a></td>
                                    <td class="text-center">
                                        @if($lecture->active)
                                            <a href="{{route('admin-lecture.deActive', $lecture->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-lecture.active', $lecture->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($lecture->published == 1)
                                            <a href="{{route('admin-lecture.unPublish', $lecture->id)}}" class="btn btn-sm btn-warning">إيقاف النشر</a>
                                        @else
                                            <a href="{{route('admin-lecture.publish', $lecture->id)}}" class="btn btn-sm btn-success">نشر</a>
                                        @endif
                                    </td>
                                    <td class="text-center"><a href="{{route('admin-lectures.edit', $lecture->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا الدرس؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $lecture->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $lecture->id }}" action="{{route('admin-lectures.destroy', $lecture->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد دروس حتى الان</th>
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

