@extends('website.layouts.website')

@section('title')
   {{$lecture->name}}   درس
@stop

@section('content')

    <div class="intro-container">
        <div class="intro-head text-center">
            <div class="container">
                <h1>{{$lecture->name}} درس </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.intro-head -->
        <div class="corse-indv">
            <div class="container">
                <div class="corse_indv-video col-md-12 col-xs-12 text-center">
                    <div class="corse_indv-inner">
                        @if($lecture->video_link != null)
                            <iframe width="100%" height="520" src="{{$lecture->video_link}}" frameborder="0" allowfullscreen style="margin-bottom: 20px"></iframe>
                        @endif
                        @if($lecture->video != null)
                            @if($lecture->cover != null)
                                <video id="example_video_1" class="video-js vjs-default-skin" controls="true" width="100%" height="420" poster="{{$lecture->cover}}">
                                    <source src="{{asset($lecture->video)}}" type='video/mp4' />
                                </video>
                            @else
                                <video id="example_video_1" class="video-js vjs-default-skin" controls="true" width="100%" height="420" poster="{{asset('public/website/images/3lom1.jpg')}}">
                                    <source src="{{asset($lecture->video)}}" type='video/mp4' />
                                </video>
                            @endif
                        @endif
                        <div class="finish-corse text-left col-xs-12">
                            @if($next)
                                <div class="col-sm-6 pull-left">
                                    <a class="btn btn-xs btn-block text-center btn-success" href="{{route('lectures.show', $next->slug)}}">
                                        الدرس التالى <i class="fa fa-arrow-left"></i>
                                    </a>
                                </div>
                            @endif
                            @if($prev)
                                <div class="col-sm-6 pull-right">
                                    <a class="btn btn-xs btn-block text-center btn-warning" href="{{route('lectures.show', $prev->slug)}}">
                                        <i class="fa fa-arrow-right"></i> الدرس السابق
                                    </a>
                                </div>
                            @endif
                            <div class="col-sm-12">
                                <form action="{{route('courses.show', $lecture->course->slug)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-primary pull-right" style="margin: 5px">
                                         عرض الدورة <i class="fa fa-paper-plane"></i>
                                    </button>
                                </form>
                                <form action="{{route('lectures.index')}}" method="get">
                                    @csrf()
                                    <input type="hidden" name="course_id" value="{{$lecture->course->id}}">
                                    <button class="btn btn-primary pull-right" style="margin: 5px">
                                         عرض الدروس <i class="fa fa-list"></i>
                                    </button>
                                </form>
                                @if(Auth::user()->id == $lecture->coach->id)
                                    <form action="{{route('lectures.edit', $lecture->slug)}}" method="get">
                                        @csrf()
                                        <button class="btn btn-info pull-right" style="margin: 5px">
                                            تعديل الدرس <i class="fa fa-edit"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            @if($lecture->file != null)
                                <div class="pull-right">
                                    <a class="btn btn-xs text-center btn-success" href="{{asset($lecture->file)}}">
                                        <i class="fa fa-download"></i> تحميل مرفقات الدرس
                                    </a>
                                </div>
                            @endif

                            <div class="lesson-desc col-xs-12 text-right">
                                <h1>وصف المحاضرة</h1>
                                <p>{{$lecture->description? $lecture->description : 'لا يوجد وصف'}}</p>
                            </div>
                        </div>
                        <!-- end finish-corse -->
                    </div>
                    <!-- end corse_indv-inner -->
                </div>
                <!-- end corse_indv-video -->


                <div class="intro-container col-xs-12">
                    <div class="intro-head text-center">
                        <div class="container">
                            <h1>التعليقات</h1>
                        </div>
                        <!-- /.container -->
                    </div>
                    <!-- /.intro-head -->
                    <div class="corse-box col-xs-12">
                        <div class="lesson-box text-right">
                            <div class="container">
                                <div class="col-sm-12 form-group">
                                    <form action="{{route('comments.store')}}" method="post">
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
                                @if(count($lecture->comments) > 0)
                                <div class="alert-box">
                                    <div class="all-alerts col-xs-12 text-right">
                                        <ul>
                                            @foreach($lecture->comments as $comment)
                                            <li>
                                                <h1>{{$comment->user? $comment->user->name : 'EgyTraining'}}</h1>
                                                <span>{{$comment->created_at->diffForHumans()}}</span>

                                                <a href="#" class="btn btn-lg btn-sm btn-danger pull-left" style="margin-left: 5px; margin-top: 1px" title="حذف التعليق"
                                                   onclick="
                                                           var result = confirm('هل أنت متأكد من حذف هذا التعليق؟');
                                                           if(result)
                                                           {
                                                           event.preventDefault();
                                                           document.getElementById('delete-form-{{ $comment->id }}').submit();
                                                           }
                                                           "
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $comment->id }}" action="{{route('comments.destroy', $comment->id)}}" method="post">
                                                    @csrf()
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>

                                                <p>{!! $comment->content !!}</p>
                                            </li>
                                                {{--Replies--}}

                                                <div class="intro-container col-xs-12">
                                                    <div class="corse-box col-xs-12">
                                                        <div class="lesson-box text-right" >
                                                            <div class="container">
                                                                <div class="alert-box">
                                                                    <div class="all-alerts col-xs-10 col-xs-offset-1 text-right">
                                                                        <ul style="margin-top: -25px;">
                                                                            @if(count($comment->replies) > 0)
                                                                            @foreach($comment->replies as $reply)
                                                                                <li>
                                                                                    <h1>{{$reply->user? $reply->user->name : 'EgyTraining'}}</h1>
                                                                                    <span>{{$reply->created_at->diffForHumans()}}</span>

                                                                                    <a href="#" class="btn btn-lg btn-sm btn-danger pull-left" style="margin-left: 5px; margin-top: 1px" title="حذف الرد"
                                                                                       onclick="
                                                                                               var result = confirm('هل أنت متأكد من حذف هذا الرد؟');
                                                                                               if(result)
                                                                                               {
                                                                                               event.preventDefault();
                                                                                               document.getElementById('delete-form-{{ $reply->id }}').submit();
                                                                                               }
                                                                                               "
                                                                                    >
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </a>
                                                                                    <form id="delete-form-{{ $reply->id }}" action="{{route('replies.destroy', $reply->id)}}" method="post">
                                                                                        @csrf()
                                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                                    </form>

                                                                                    <p>{!! $reply->content !!}</p>
                                                                                </li>
                                                                            @endforeach
                                                                            @endif
                                                                            <div class="col-sm-12 form-group">
                                                                                <form action="{{route('replies.store')}}" method="post">
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
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--End Replies--}}
                                            @endforeach
                                            {{--<div class="col-sm-12 form-group">--}}
                                                {{--<form action="{{route('comments.store')}}" method="post">--}}
                                                    {{--@csrf()--}}
                                                    {{--@if(count($errors) > 0)--}}
                                                        {{--@foreach($errors->all() as $error)--}}
                                                            {{--<p class="alert alert-danger text-center">{{$error}}</p>--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}
                                                    {{--<input type="hidden" name="lecture_id" value="{{$lecture->id}}">--}}
                                                    {{--<textarea style="margin-bottom: 3px" class="form-control" name="content" id="" cols="30" rows="2"></textarea>--}}
                                                    {{--<button class="btn btn-sm btn-success form-control"><i class="fa fa-comment"></i> إضافة تعليق </button>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                        </ul>
                                    </div>
                                    <!-- end all-alerts -->
                                </div>
                                <!-- end alert-box -->
                                @else
                                    <div class="corse-comments col-xs-12">
                                        <div class="disqus-comments">
                                            <div class="empty-msg text-center animated shake">
                                                <h1>
                                                    <i class="fa fa-commenting-o"></i>
                                                    عفوا لا توجد تعليقات علي هذا الدرس
                                                </h1>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end corse-comments -->
                                @endif
                            </div>
                            <!-- end container -->
                        </div>
                        <!-- end lesson-box -->
                    </div>
                    <!-- end corse-box -->
                </div>
                <!-- /.intro-container -->


            </div>
            <!-- end container -->
        </div>
        <!-- end corse-indv -->
    </div>
    <!-- /.intro-container -->


@stop

@section('scripts')
    <script type="text/javascript">
        var myPlayer = videojs("example_video_1");
        $('#show-l10').click(function () {
            $('#l10').show();
            $('#example_video_1').hide();
            myPlayer.pause();
        });
    </script>
@stop