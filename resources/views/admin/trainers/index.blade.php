@section('title')
    المتدربين
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">المتدربين</h3>
                    <a href="{{route('trainers.create')}}" class="btn btn-success"> إضافة متدرب جديد <i class="fa fa-plus"></i></a>
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
                        @if(count($trainers) > 0)
                            @foreach($trainers as $trainer)
                                <tr>
                                    <td class="text-center">{{$trainer->id}}</td>
                                    <td class="text-center">{{$trainer->name}}</td>
                                    <td class="text-center">{{$trainer->email}}</td>
                                    <td class="text-center">{{$trainer->phone}}</td>
                                    <td class="text-center">{{$trainer->created_at->toFormattedDateString()}}</td>
                                    <td class="text-center"><a href="{{route('trainers.show', $trainer->slug)}}" class="btn btn-sm btn-success">عرض</a></td>
                                    <td class="text-center"><a href="{{route('trainers.edit', $trainer->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>
                                    <td class="text-center">
                                        @if($trainer->active)
                                            <a href="{{route('trainer.deActive', $trainer->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('trainer.active', $trainer->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا المتدرب؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $trainer->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $trainer->id }}" action="{{route('trainers.destroy', $trainer->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد متدربين حتى الان</th>
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

