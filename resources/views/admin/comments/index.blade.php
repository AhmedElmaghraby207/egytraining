@section('title')
    التعليقات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">التعليقات</h3>
                    <a href="{{route('admin-comments.create')}}" class="btn btn-success"> إضافة تعليق جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">التعليق</th>
                            <th class="text-center">صاحب التعليق</th>
                            <th class="text-center">الدورة</th>
                            <th class="text-center">الدرس</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">الحالة</th>
                            {{--<th class="text-center">إضافة رد</th>--}}
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($comments) > 0)
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-center">{{$comment->id}}</td>
                                    <td class="text-center">{!! $comment->content !!}</td>
                                    <td class="text-center">{{$comment->user ? $comment->user->name : App\Setting::first()->site_name}}</td>
                                    @if($comment->course)
                                        <td class="text-center"><a href="{{route('admin-courses.show', $comment->course->slug)}}">{{$comment->course->name}}</a></td>
                                    @else
                                        <td class="text-center">-----</td>
                                    @endif
                                    @if($comment->lecture)
                                        <td class="text-center"><a href="{{route('admin-lectures.show', $comment->lecture->slug)}}">{{$comment->lecture->name}}</a></td>
                                    @else
                                        <td class="text-center">-----</td>
                                    @endif
                                    <td class="text-center"><a href="{{route('admin-comments.show', $comment->id)}}" class="btn btn-sm btn-success">عرض</a></td>
                                    <td class="text-center">
                                        @if($comment->active)
                                            <a href="{{route('admin-comment.deActive', $comment->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-comment.active', $comment->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>
                                    {{--<td class="text-center">--}}
                                        {{--<a href="{{route('admin-replies.create', $comment->id)}}" class="btn btn-sm btn-success">رد</a>--}}
                                    {{--</td>--}}
                                    <td class="text-center">
                                        <a href="{{route('admin-comments.edit', $comment->id)}}" class="btn btn-sm btn-info">تعديل</a>
                                    </td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا التعليق؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $comment->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $comment->id }}" action="{{route('admin-comments.destroy', $comment->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد تعليقات حتى الان</th>
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

