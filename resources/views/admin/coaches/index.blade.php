@section('title')
    المدربين
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">المدربين</h3>
                    <a href="{{route('coaches.create')}}" class="btn btn-success"> إضافة مدرب جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الاسم</th>
                            <th class="text-center">البريد</th>
                            <th class="text-center">الهاتف</th>
                            <th class="text-center">وقت تسجيل العضوية</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($coaches) > 0)
                            @foreach($coaches as $coach)
                                <tr>
                                    <td class="text-center">{{$coach->id}}</td>
                                    <td class="text-center">{{$coach->name}}</td>
                                    <td class="text-center">{{$coach->email}}</td>
                                    <td class="text-center">{{$coach->phone? $coach->phone : 'لا يوجد'}}</td>
                                    <td class="text-center">{{$coach->created_at->toFormattedDateString()}}</td>
                                    <td class="text-center"><a href="{{route('coaches.show', $coach->slug)}}" class="btn btn-sm btn-primary">عرض</a></td>
                                    <td class="text-center"><a href="{{route('coaches.edit', $coach->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        @if($coach->active)
                                            <a href="{{route('coach.deActive', $coach->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('coach.active', $coach->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا المدرب؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $coach->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $coach->id }}" action="{{route('coaches.destroy', $coach->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="8" class="text-center h4">لا يوجد مدربين حتى الان</th>
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

