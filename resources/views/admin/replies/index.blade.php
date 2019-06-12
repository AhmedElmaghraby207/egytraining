@section('title')
    الردود
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الردود على التعليقات</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">صاحب الرد</th>
                            <th class="text-center">الرد</th>
                            <th class="text-center">التعليق</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($replies) > 0)
                            @foreach($replies as $reply)
                                <tr>
                                    <td class="text-center">{{$reply->id}}</td>
                                    <td class="text-center">{{$reply->user ? $reply->user->name : App\Setting::first()->site_name}}</td>
                                    <td class="text-center">{!! $reply->content !!}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin-comments.show', $reply->comment->slug)}}">(عرض التعليق)</a>
                                        {!! $reply->comment->content !!}
                                    </td>

                                    <td class="text-center">
                                        @if($reply->active)
                                            <a href="{{route('admin-reply.deActive', $reply->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-reply.active', $reply->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{route('admin-replies.edit', $reply->slug)}}" class="btn btn-sm btn-info">تعديل</a>
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا الرد؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $reply->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $reply->id }}" action="{{route('admin-replies.destroy', $reply->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد ردود حتى الان</th>
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

