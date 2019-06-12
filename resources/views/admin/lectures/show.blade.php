@section('title')
    بيانات الدرس
@stop
@section('styles')
    <meta charset='UTF-8'><meta name="robots" content="noindex">
    {{--<link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />--}}
    {{--<link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />--}}
    <link rel="canonical" href="https://codepen.io/kavendish/pen/aOdopx?q=comment&limit=all&type=type-pens" />
    <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width">
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
    <style class="cp-pen-styles">html, body {
            background-color: #f0f2fa;
            font-family: "PT Sans", "Helvetica Neue", "Helvetica", "Roboto", "Arial", sans-serif;
            color: #555f77;
            -webkit-font-smoothing: antialiased;
        }

        input, textarea {
            outline: none;
            border: none;
            display: block;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            font-family: "PT Sans", "Helvetica Neue", "Helvetica", "Roboto", "Arial", sans-serif;
            font-size: 1rem;
            color: #555f77;
        }
        input::-webkit-input-placeholder, textarea::-webkit-input-placeholder {
            color: #ced2db;
        }
        input::-moz-placeholder, textarea::-moz-placeholder {
            color: #ced2db;
        }
        input:-moz-placeholder, textarea:-moz-placeholder {
            color: #ced2db;
        }
        input:-ms-input-placeholder, textarea:-ms-input-placeholder {
            color: #ced2db;
        }

        p {
            line-height: 1.3125rem;
        }

        .comments {
            margin: 2.5rem auto 0;
            max-width: 60.75rem;
            padding: 0 1.25rem;
        }

        .comment-wrap {
            margin-bottom: 1.25rem;
            display: table;
            width: 100%;
            min-height: 5.3125rem;
        }

        .photo {
            padding-top: 0.625rem;
            display: table-cell;
            width: 3.5rem;
        }
        .photo .avatar {
            height: 2.25rem;
            width: 2.25rem;
            border-radius: 50%;
            background-size: contain;
        }

        .comment-block {
            padding: 1rem;
            background-color: #fff;
            display: table-cell;
            vertical-align: top;
            border-radius: 0.1875rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08);
        }
        .comment-block textarea {
            width: 100%;
            resize: none;
        }

        .comment-text {
            margin-bottom: 1.25rem;
        }

        .bottom-comment {
            color: #acb4c2;
            font-size: 0.875rem;
        }

        .comment-date {
            float: left;
        }

        .comment-actions {
            float: right;
        }
        .comment-actions li {
            display: inline;
            margin: -2px;
            cursor: pointer;
        }
        .comment-actions li.complain {
            padding-right: 0.75rem;
            border-right: 1px solid #e1e5eb;
        }
        .comment-actions li.reply {
            padding-left: 0.75rem;
            padding-right: 0.125rem;
        }
        .comment-actions li:hover {
            color: #0095ff;
        }
    </style>
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
                                    <h3 class="panel-title text-center"><p style="margin-top: 0px" class="text-center h3">درس</p>{{$lecture->name}}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-9 col-sm-offset-2">
                                            <table class="table table-user-information">
                                                <tbody>
                                                <tr>
                                                    <td>اسم الدرس:</td>
                                                    <td>{{$lecture->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الكورس:</td>
                                                    <td><a href="{{route('admin-courses.show', $lecture->course->slug)}}">{{$lecture->course->name}}</a></td>
                                                </tr>
                                                <tr>
                                                    <td>المدرب:</td>
                                                    @if($lecture->coach)
                                                        <td><a href="{{route('coaches.show', $lecture->coach->slug)}}">{{$lecture->coach->name}}</a></td>
                                                    @else
                                                        <td>{{App\Setting::first()->site_name}}</td>
                                                    @endif
                                                </tr>

                                                <tr>
                                                    <td>الوصف:</td>
                                                    <td>{{$lecture->description ? $lecture->description : "لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الحالة</td>
                                                    @if($lecture->active == 0)
                                                        <td><p class="text-danger">متوقف</p></td>
                                                    @else
                                                        <td><p class="text-primary">مفعل</p></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>النشر</td>
                                                    @if($lecture->published == 0)
                                                        <td><p class="text-danger">لم ينشر بعد</p></td>
                                                    @else
                                                        <td><p class="text-danger">تم النشر</p></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>رابط الفيديو</td>
                                                    <td>{{$lecture->video_link ? $lecture->video_link : 'لا يوجد'}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الفيديو</td>
                                                    <td>
                                                        @if($lecture->video != null)
                                                            <video class="video-js vjs-default-skin" controls="true" width="100%" height="320" >
                                                                <source src="{{asset($lecture->video)}}" type='video/mp4' />
                                                            </video>
                                                        @else
                                                            لا يوجد
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>الملف</td>
                                                    @if($lecture->file != null)
                                                        <td><a href="{{asset($lecture->file)}}">تحميل/عرض الملف</a></td>
                                                    @else
                                                        <td>لا يوجد ملف</td>
                                                    @endif
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    @if($lecture->active)
                                        <a href="{{route('admin-lecture.deActive', $lecture->id)}}" data-original-title="تعطيل" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a>
                                    @else
                                        <a href="{{route('admin-lecture.active', $lecture->id)}}" data-original-title="تنشيط" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a>
                                    @endif

                                    @if($lecture->published)
                                        <a href="{{route('admin-lecture.unPublish', $lecture->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"> إيقاف النشر</i></a>
                                    @else
                                        <a href="{{route('admin-lecture.publish', $lecture->id)}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"> نشر</i></a>
                                    @endif

                                    <a href="{{route('admin-lectures.edit', $lecture->slug)}}" style="margin-right: 20px" type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                    <a href="{{route('admin-lectures.index')}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="pull-right btn btn-sm btn-primary"><i class="glyphicon glyphicon-th"> كل الدروس</i></a>
                                    <a href="{{route('admin-lectures.create')}}" style="margin-right: 20px" data-toggle="tooltip" type="button" class="pull-right btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"> إضافة درس</i></a>

                                    <form action="{{route('admin-comments.create')}}"  data-original-title="حذف" style="margin-right: 20px" method="get" data-toggle="tooltip" class="pull-right" >
                                        @csrf()
                                        <input type="hidden" name="course_id" value="0">
                                        <input type="hidden" name="lecture_id" value="{{$lecture->id}}">
                                        <button style="margin-right: 20px" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-comment"></i> إضافة تعليق</button>
                                    </form>

                                    <a href="#" class="text-danger bold btn btn-sm btn-danger" style="margin-right: 20px" data-toggle="tooltip" class="pull-left"
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
                                        <i class="glyphicon glyphicon-remove"></i> حذف
                                    </a>
                                    <form id="delete-form-{{ $lecture->id }}" action="{{route('admin-lectures.destroy', $lecture->id)}}" method="POST">
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

    {{--Comments--}}
    @if(count($lecture->comments) > 0)
        <h1 class="h2 text-center">التعليقات</h1>
    @else
        <h1 class="h2 text-center">لا يوجد تعليقات</h1>
    @endif
    <div class="col-sm-12 form-group">
        <form action="{{route('admin-comments.store')}}" method="post">
            @csrf()
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger text-center">{{$error}}</p>
                @endforeach
            @endif
            <input type="hidden" name="lecture_id" value="{{$lecture->id}}">
            <textarea style="margin-bottom: 3px" class="form-control" name="content" id="" cols="30" rows="2"></textarea>
            <button class="btn btn-sm btn-success form-control"><i class="fa fa-comment"></i> إضافة تعليق </button>
        </form>
    </div>
    <div class="comments" style="padding-bottom: 20px">
        @if(count($lecture->comments) > 0)
            @foreach($lecture->comments as $comment)
                <div class="comment-wrap">
                    <div class="photo">
                        @if($comment->user != null)
                            <img src="{{asset($comment->user->image)}}" width="40" height="40" class="img-responsive img-circle">
                        @else
                            <div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg')"></div>
                        @endif
                    </div>
                    <div class="comment-block">
                        <h3 class="text-primary" style="margin-bottom: 5px">{{$comment->user? $comment->user->name : App\Setting::first()->site_name}}</h3>
                        <p class="comment-text">{!! $comment->content !!}</p>
                        <div class="bottom-comment">
                            <div class="comment-date">{{$comment->created_at->diffForHumans()}}</div>
                            <ul class="comment-actions" style="margin-top: 10px">

                                {{--<li class="reply">--}}
                                    {{--<form action="{{route('admin-replies.create')}}" method="get" style="margin-right: 10px" data-toggle="tooltip" class="pull-right" >--}}
                                        {{--@csrf()--}}
                                        {{--<input type="hidden" name="comment_id" value="{{$comment->id}}">--}}
                                        {{--<button class="btn btn-xs btn-success"><i class="fa fa-reply"></i> إضافة رد</button>--}}
                                    {{--</form>--}}
                                {{--</li>--}}

                                <li class="reply">
                                    <a href="{{route('admin-comments.edit', $comment->id)}}" style="margin-right: 10px" data-toggle="tooltip" type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                </li>

                                <li class="reply">
                                    <a href="#" class="btn btn-xs btn-danger " style="margin-right: 5px" data-toggle="tooltip"
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
                                        <i class="glyphicon glyphicon-remove"></i> حذف
                                    </a>
                                    <form id="delete-form-{{ $comment->id }}" action="{{route('comments.destroy', $comment->id)}}" method="POST" class="pull-left">
                                        @csrf()
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </li>

                                <li class="reply">
                                    @if($comment->active)
                                        <a href="{{route('admin-comment.deActive', $comment->id)}}" data-toggle="tooltip" type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a>
                                    @else
                                        <a href="{{route('admin-comment.active', $comment->id)}}" data-toggle="tooltip" type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a>
                                    @endif
                                </li>

                            </ul>
                        </div>

                        {{--Replies on comment--}}
                        <div class="comments" style="padding-bottom: 20px; padding-top: 10px">
                            <hr>
                            @if(count($comment->replies) > 0)
                                @foreach($comment->replies as $reply)
                                    <div class="comment-wrap">
                                        <div class="photo">
                                            @if($reply->user != null)
                                                <img src="{{asset($reply->user->image)}}" width="40" height="40" class="img-responsive img-circle">
                                            @else
                                                <div class="avatar" style="background-image: url('https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg')"></div>
                                            @endif
                                        </div>
                                        <div class="comment-block">
                                            <h3 class="text-primary" style="margin-bottom: 5px">{{$reply->user? $reply->user->name : App\Setting::first()->site_name}}</h3>
                                            <p class="comment-text">{!! $reply->content !!}</p>
                                            <div class="bottom-comment">
                                                <div class="comment-date">{{$reply->created_at? $reply->created_at->diffForHumans() : 'غير معروف'}}</div>
                                                <ul class="comment-actions" style="margin-top: 10px">

                                                    <li class="reply" style="padding-left: 5px; padding-right: 0px;">
                                                        <a href="{{route('admin-replies.edit', $reply->id)}}" style="margin-right: 10px" data-toggle="tooltip" type="button" class="btn btn-xs btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                                    </li>

                                                    <li class="reply">
                                                        <a href="#" class="btn btn-xs btn-danger " style="margin-right: 5px" data-toggle="tooltip"
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
                                                        <form id="delete-form-{{ $reply->id }}" action="{{route('replies.destroy', $reply->id)}}" method="POST" class="pull-left">
                                                            @csrf()
                                                            <input type="hidden" name="_method" value="DELETE">
                                                        </form>
                                                    </li>

                                                    <li class="reply" >
                                                        @if($reply->active)
                                                            <a href="{{route('admin-reply.deActive', $reply->id)}}" style="margin-left: 15px;" data-toggle="tooltip" type="button" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a>
                                                        @else
                                                            <a href="{{route('admin-reply.active', $reply->id)}}" style="margin-left: 15px;" data-toggle="tooltip" type="button" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a>
                                                        @endif
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="col-sm-12 form-group">
                                <form action="{{route('admin-replies.store')}}" method="post">
                                    @csrf()
                                    @if(count($errors) > 0)
                                        @foreach($errors->all() as $error)
                                            <p class="alert alert-danger text-center">{{$error}}</p>
                                        @endforeach
                                    @endif
                                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                                    <textarea style="margin-bottom: 3px" class="form-control" name="content" id="" cols="30" rows="2"></textarea>
                                    <button class="btn btn-sm btn-success form-control"><i class="fa fa-reply"></i> رد </button>
                                </form>
                            </div>
                        </div>
                        {{--End Replies on comment--}}

                    </div>
                </div>
            @endforeach
        @endif
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

@section('scripts')
    <script src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
    <script src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
@stop

@include('admin.layouts.footer')

