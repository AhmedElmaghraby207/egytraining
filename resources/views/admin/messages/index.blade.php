@section('title')
    الرسائل
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الرسائل</h3>
                    <a href="{{route('admin-messages.create')}}" class="btn btn-success"> إضافة رسالة جديدة <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الرسالة</th>
                            <th class="text-center">المرسل</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($messages) > 0)
                            @foreach($messages as $message)
                                <tr>
                                    <td class="text-center">{{$message->id}}</td>
                                    <td class="text-center">{!! $message->content !!}</td>
                                    <td class="text-center">{{$message->coach ? $message->coach->name : App\Setting::first()->site_name}}</td>
                                    <td class="text-center">
                                        @if($message->active)
                                            <a href="{{route('admin-message.deActive', $message->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-message.active', $message->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin-messages.edit', $message->id)}}" class="btn btn-sm btn-info">تعديل</a>
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذه الرسالة؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $message->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $message->id }}" action="{{route('admin-messages.destroy', $message->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="8" class="text-center h4">لا يوجد رسائل حتى الان</th>
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

