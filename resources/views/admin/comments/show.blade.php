@section('title')
    بيانات التعليق
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
                                    <h3 class="panel-title text-center"><p style="margin-top: 0px" class="text-center h3">التعليق والردود</p></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-9 col-sm-offset-2">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <td>التعليق:</td>
                                                        <td>{!! $comment->content !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>صاحب التعليق:</td>
                                                        <td>{{$comment->user ? $comment->user->name : App\Setting::first()->site_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>الكورس</td>
                                                        @if($comment->course)
                                                            <td><a href="{{route('admin-courses.show', $comment->course->slug)}}">{{$comment->course->name}}</a></td>
                                                        @else
                                                            <td>-----</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>الدرس</td>
                                                        @if($comment->lecture)
                                                            <td><a href="{{route('admin-lectures.show', $comment->lecture->slug)}}">{{$comment->lecture->name}}</a></td>
                                                        @else
                                                            <td>-----</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>الحالة</td>
                                                        @if($comment->active == 0)
                                                            <td><p class="text-danger">متوقف</p></td>
                                                        @else
                                                            <td><p class="text-primary">مفعل</p></td>
                                                        @endif
                                                    </tr>
                                                    <br>
                                                    @if(count($comment->replies) > 0)
                                                        <td class="h5">الردود على التعليق</td>
                                                        @foreach($comment->replies as $reply)
                                                            <tr>
                                                                <td>الرد بواسطة: {{$reply->user ? $reply->user->name : App\Setting::first()->site_name}}</td>
                                                                <td>الرد: {!! $reply->content !!}</td>
                                                                <td>
                                                                    @if($reply->active)
                                                                        <div class="col-sm-2" style="margin-right: 20px"><a href="{{route('admin-reply.deActive', $reply->id)}}" data-toggle="tooltip" type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a></div>
                                                                    @else
                                                                        <div class="col-sm-2" style="margin-right: 20px"><a href="{{route('admin-reply.active', $reply->id)}}" data-toggle="tooltip" type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a></div>
                                                                    @endif

                                                                    <div class="col-sm-2" style="margin-left: 20px; margin-right: 10px"><a href="{{route('admin-replies.edit', $reply->id)}}" data-toggle="tooltip" type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a></div>


                                                                    <div class="col-sm-2" style="margin-left: 20px; margin-right: 0px">
                                                                        <a href="#" class="text-danger bold btn btn-xs btn-danger" data-toggle="tooltip" class="pull-left"
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
                                                                            <i class="glyphicon glyphicon-remove"></i> حذف
                                                                        </a>
                                                                        <form id="delete-form-{{ $reply->id }}" action="{{route('admin-replies.destroy', $reply->id)}}" method="POST">
                                                                            @csrf()
                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                        </form>
                                                                    </div>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>لا يوجد ردود</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    @if($comment->active)
                                        <a href="{{route('admin-comment.deActive', $comment->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm  btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل التعليق</i></a>
                                    @else
                                        <a href="{{route('admin-comment.active', $comment->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm  btn-success"><i class="glyphicon glyphicon-edit"> تنشيط التعليق</i></a>
                                    @endif

                                    <a href="{{route('admin-comments.edit', $comment->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm  btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                    <a href="{{route('admin-comments.index')}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm  btn-success pull-right"><i class="glyphicon glyphicon-list"> عرض التعليقات</i></a>

                                    <form action="{{route('admin-replies.create')}}" method="get" data-toggle="tooltip" class="pull-right" >
                                        @csrf()
                                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                        <button class="btn btn-sm btn-block btn-success"><i class="fa fa-reply"></i> إضافة رد</button>
                                    </form>

                                    <a href="#" class="text-danger bold btn btn-sm btn-danger" style="margin-right: 20px" data-toggle="tooltip" class="pull-left"
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
                                        <i class="glyphicon glyphicon-remove"></i> حذف التعليق
                                    </a>
                                    <form id="delete-form-{{ $comment->id }}" action="{{route('admin-comments.destroy', $comment->id)}}" method="POST">
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

