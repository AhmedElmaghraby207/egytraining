@section('title')
    التنويهات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">التنويهات</h3>
                    <a href="{{route('admin-alerts.create')}}" class="btn btn-success"> إضافة تنويه جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">العنوان</th>
                            <th class="text-center">المحتوى</th>
                            <th class="text-center">الكورس</th>
                            <th class="text-center">صاحب التنويه</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($alerts) > 0)
                            @foreach($alerts as $alert)
                                <tr>
                                    <td class="text-center">{{$alert->id}}</td>
                                    <td class="text-center">{{$alert->title}}</td>
                                    <td class="text-center">{!!$alert->content!!}</td>
                                    <td class="text-center">{{$alert->course->name}}</td>
                                    <td class="text-center">{{$alert->coach ? $alert->coach->name : App\Setting::first()->site_name}}</td>
                                    <td class="text-center">
                                        @if($alert->active)
                                            <a href="{{route('admin-alert.deActive', $alert->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-alert.active', $alert->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin-alerts.edit', $alert->slug)}}" class="btn btn-sm btn-info">تعديل</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                        var result = confirm('هل أنت متأكد من حذف هذا التنويه؟');
                                            if(result)
                                            {
                                                event.preventDefault();
                                                document.getElementById('delete-form-{{ $alert->id }}').submit();
                                            }
                                            "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $alert->id }}" action="{{route('admin-alerts.destroy', $alert->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="8" class="text-center h4">لا يوجد تنويهات حتى الان</th>
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

