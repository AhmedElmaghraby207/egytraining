@extends('website.layouts.website')

@section('title')
    عرض الدورة
@stop

@section('content')

    <div class="intro-container">
        <div class="intro-head text-center">
            <div class="container">
                <h1><span class="text-bold text-uppercase">{{$course->name}}</span> :مقدمة في دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.intro-head -->
        <div class="intro-box">
            <div class="container">
                <div class="intro-name text-right">
                    {{--<div class="name-head col-md-7 col-xs-12 pull-right">--}}
                        {{--<h1>{{$course->name}}</h1>--}}
                    {{--</div>--}}
                    <div class="col-xs-6 pull-right">
                        @if(Auth::user())
                        <div class="rating">
                            <form action="{{route('rate.course')}}" method="post">
                                @csrf()
                                <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $course->userAverageRating }}" data-size="xs">
                                <input type="hidden" name="id" required="" value="{{ $course->id }}">
                                <br/>
                                <button class="btn btn-success" style="margin-top: -20px; margin-bottom: 10px">تقييم</button>
                            </form>
                        </div>
                        @else
                            <span>
                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $course->averageRating }}" data-size="xs" disabled="">
                            </span>
                        @endif
                    </div>
                    <div class="extras col-xs-6 pull-left">
                        @if($course->status == 1)
                            <span>$ {{$course->price}}</span>
                        @else
                            <span>مجانى</span>
                        @endif
                    </div>
                </div>
                <!-- /.intro-name -->

                <div class="intro-video col-xs-12 text-center">
                    <video id="example_video_1" class="video-js vjs-default-skin" controls="true" width="100%" height="520"
                           poster="{{asset($course->cover ? $course->cover : 'public/website/images/3lom.jpg')}}">
                        <source src="{{asset($course->video? $course->video : 'public/website/images/test.mp4')}}" type='video/mp4'/>
                    </video>
                </div>
                <!-- /.intro-video -->

                <div class="intro-date col-xs-12 text-right">
                    <h1>
                        <i class="fa fa-calendar"></i>
                        من :{{$course->start_at}}
                        إلى :{{$course->finish_at}}
                    </h1>
                    {{--If unlogged in user redirect to login page--}}
                    @if(Auth::guest())
                        <a href="{{url('/login')}}" class="btn btn-primary pull-left">
                            <i class="fa fa-paper-plane "></i>
                            إشترك في الدورة
                        </a>
                    {{--If logged in user--}}
                    @else
                        {{--If logged in user is the coach of the course, Not Allow the course owner to join--}}
                        @if(Auth::user()->id != $course->coach->id)
                            {{--If Course has joined trainers--}}
                            @if(count($course->trainers) > 0)
                                @foreach($course->trainers as $trainer)
                                    {{--If ligged in user is not joined to this course--}}
                                    @if(Auth::user()->id != $trainer->id)
                                        {{--If course is free, join the course now--}}
                                        @if($course->status == 0)
                                            <form action="{{route('courses.join', $course->id)}}" method="post">
                                                @csrf()
                                                <button class="btn btn-primary pull-left" style="margin: 5px">
                                                    <i class="fa fa-paper-plane"></i>
                                                    إشترك في الدورة
                                                </button>
                                            </form>
                                        {{--If course is not free, pay first then join the course--}}
                                        @else
                                            <form action="{{url('pay/with/paypal/'. $course->id)}}" method="get">
                                                @csrf()
                                                <button class="btn btn-primary pull-left"  style="margin: 5px">
                                                    <i class="fa fa-paper-plane"></i>
                                                    إشترك في الدورة (paypal)
                                                </button>
                                            </form>
                                        @endif
                                    {{--If logged in user has already joined the course, Go to the first lecture of the course--}}
                                    @else
                                        <form action="{{route('lectures.index')}}" method="get">
                                            @csrf()
                                            <input type="hidden" name="course_id" value="{{$course->id}}">
                                            <button class="btn btn-success pull-left" style="margin: 5px">
                                                <i class="fa fa-paper-plane"></i>
                                                إبدأ الدورة الان
                                            </button>
                                        </form>
                                    @endif
                                @endforeach
                            @else
                            @if($course->status == 0)
                                <form action="{{route('courses.join', $course->id)}}" method="post">
                                    @csrf()
                                    <button class="btn btn-primary pull-left" style="margin: 5px">
                                        <i class="fa fa-paper-plane"></i>
                                        إشترك في الدورة
                                    </button>
                                </form>
                            @else
                                <form action="{{url('pay/with/paypal/'. $course->id)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-primary pull-left">
                                        <i class="fa fa-paper-plane" style="margin: 5px"></i>
                                        إشترك في الدورة (paypal)
                                    </button>
                                </form>
                            @endif
                            @endif

                        @endif
                    @endif

                    @if(Auth::user())
                        @if (Auth::user()->id == $course->coach_id)
                            <form action="{{route('course-tests.create')}}" method="get">
                                @csrf()
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-success pull-left" style="margin: 5px">
                                    <i class="fa fa-plus"></i> إضافة إختبار
                                </button>
                            </form>
                            @if(count($course->tests) > 0)
                                <form action="{{route('course-tests.index')}}" method="get">

                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <button class="btn btn-primary pull-left" style="margin: 5px">
                                        <i class="fa fa-paper-plane"></i>
                                        عرض الاختبارات
                                    </button>
                                </form>
                            @endif
                            @if($course->certificate)
                                <form action="{{route('certificates.edit', $course->certificate->slug)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-info pull-left" style="margin: 5px">
                                        <i class="fa fa-edit"></i> تعديل أو حذف الشهادة
                                    </button>
                                </form>
                                <form action="{{route('certificates.show', $course->certificate->slug)}}" method="get">
                                    <button class="btn btn-primary pull-left" style="margin: 5px">
                                        <i class="fa fa-paper-plane"></i> عرض الشهادة
                                    </button>
                                </form>
                            @else
                                <form action="{{route('certificates.create')}}" method="get">
                                    @csrf()
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <button class="btn btn-success pull-left" style="margin: 5px">
                                        <i class="fa fa-plus"></i> إضافة شهادة
                                    </button>
                                </form>
                            @endif

                            <form action="{{route('courses.edit', $course->slug)}}" method="get">
                                @csrf()
                                <button class="btn btn-info pull-left" style="margin: 5px">
                                    <i class="fa fa-edit"></i> تعديل أو حذف الدورة
                                </button>
                            </form>

                            @if($course->published == 0)
                                <form action="{{route('course.publish', $course->id)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-success pull-left" style="margin: 5px">
                                        <i class="fa fa-edit"></i> نشر الدرورة
                                    </button>
                                </form>
                            @else
                                <form action="{{route('course.unPublish', $course->id)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-warning pull-left" style="margin: 5px">
                                        <i class="fa fa-edit"></i> إيقاف نشر الدورة
                                    </button>
                                </form>
                            @endif

                            @if($course->completed == 0)
                            <form action="{{route('lectures.create')}}" method="get">
                                @csrf()
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-success pull-left" style="margin: 5px">
                                    <i class="fa fa-plus"></i> إضافة درس
                                </button>
                            </form>
                            @endif

                            @if($course->completed == 0)
                            <form action="{{route('course.complete', $course->id)}}" method="get">
                                @csrf()
                                <button class="btn btn-success pull-left" style="margin: 5px">
                                    <i class="fa fa-hourglass-end"></i> إنهاء الدورة
                                </button>
                            </form>
                            @else
                                <form action="{{route('course.unComplete', $course->id)}}" method="get">
                                    @csrf()
                                    <button class="btn btn-success pull-left" style="margin: 5px">
                                        <i class="fa fa-hourglass-start"></i> إعادة بث الدورة
                                    </button>
                                </form>
                            @endif

                            <form action="{{route('lectures.index')}}" method="get">
                                @csrf()
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-primary pull-left" style="margin: 5px">
                                    <i class="fa fa-paper-plane"></i>
                                    عرض الدروس
                                </button>
                            </form>
                        @endif
                    @endif

                </div>

                <!-- /.intro-date -->

                <div class="intro-details text-right">

                    <p>{{$course->description? $course->description : 'لا يوجد وصف'}}</p>

                </div>

                <!-- /.intro-details -->


                <div class="intro-extra col-xs-12">

                    <div class="intro-instructor col-md-6 col-xs-12 text-right pull-left">

                        <div class="intro_instructor-inner">

                            <h1>عن المدرس</h1>
                            <div class="avatar text-center">
                                <div class="av-inner">
                                    @if($course->coach != null)
                                        @if($course->coach->image != null)
                                            <img src="{{asset($course->coach->image)}}" class="img-circle" alt=""
                                                 width="80" height="80">
                                        @else
                                            <img src="{{asset('public/website/images/s.png')}}" class="img-circle"
                                                 alt="" width="80" height="80">
                                        @endif
                                    @else
                                        <img src="{{asset('public/website/images/s.png')}}" class="img-circle" alt=""
                                             width="80" height="80">
                                    @endif
                                </div>
                                <!-- /.av-inner -->
                            </div>
                            <!-- /.avatar -->

                            <div class="instructor-data">

                                <a href="#" class="know-teacher" data-toggle="tooltip" data-placement="top"
                                   title="اضغط لمعرفة هوية المحاضر">{{$course->coach ? $course->coach->name : 'غير معروف'}}</a>

                                <p>{{$course->coach->about ? $course->coach->about : 'لا يوجد معلومات عن المدرب'}}</p>

                            </div>

                            <!-- /.instructor-data -->

                        </div>

                        <!-- /.intro_instructor-inner -->

                    </div>

                    <!-- /.intro-instructor -->

                    <div class="intro-lec col-md-6 col-xs-12 text-right pull-right">
                        <div class="intro_lec-inner">
                            <h1>ماذا يحتوي هذا الكورس</h1>
                            <ol>
                                @if(count($course->lectures) > 0)
                                    @foreach($course->lectures as $lecture)
                                        @if($lecture->active == 1 && $lecture->published == 1)
                                            <li>
                                                <i class="fa fa-play-circle"></i> {{$lecture->name}}
                                            </li>
                                        @else
                                            @if(Auth::user())
                                                @if(Auth::user()->id == $lecture->coach->id)
                                                    <p class="text-center">بإنتظار موافقة الادمن لنشر الدروس</p>
                                                @else
                                                    <p class="text-center">لا يوجد دروس حتى الان</p>
                                                @endif
                                            @else
                                                <p class="text-center">لا يوجد دروس حتى الان</p>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <p class="text-center">لا يوجد دروس حتى الان</p>
                                @endif
                            </ol>
                        </div>
                        <!-- /.intro_lec-inner -->
                    </div>
                    <!-- /.intro-lec -->
                </div>
                <!-- /.intro-extra -->
            </div>
            <!-- /.container -->

            {{--Start Course Comments--}}
            <div style="margin-top: 60px" class="intro-container col-xs-12">
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
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <textarea style="margin-bottom: 3px" class="form-control" name="content" id="" cols="30" rows="2"></textarea>
                                    <button class="btn btn-sm btn-success form-control"><i class="fa fa-comment"></i> إضافة تعليق </button>
                                </form>
                            </div>
                            @if(count($course->comments) > 0)
                                <div class="alert-box">
                                    <div class="all-alerts col-xs-12 text-right">
                                        <ul>
                                            @foreach($course->comments as $comment)
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
                                        </ul>
                                    </div>
                                    <!-- end all-alerts -->
                                </div>
                                <!-- end alert-box -->
                        </div>
                        <!-- end container -->
                    </div>
                    <!-- end lesson-box -->
                </div>
                <!-- end corse-box -->
            </div>
            <!-- /.intro-container -->
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
            {{--End Course Comments--}}

        </div>
        <!-- /.intro-box -->
    </div>
    <!-- /.intro-container -->

@stop





@section('models')



    <!-- =========================================================================================================================================== -->
    @if($course->coach != null)
        <div class="panel-pop modal" id="instructor">
            <div class="intro-instructor col-xs-12 text-right">
                <div class="intro_instructor-inner">
                    <h1>عن المدرس</h1>
                    <div class="avatar text-center">
                        <div class="av-inner">
                            <img src="{{asset($course->coach->image? $course->coach->image : 'public/website/images/s.png')}}"
                                 alt="" width="80" height="80">
                        </div>
                        <!-- /.av-inner -->
                    </div>
                    <!-- /.avatar -->
                    <div class="instructor-data">
                        <a>{{$course->coach->name}}</a>
                        <p>{{$course->coach->about? $course->coach->about : 'لا يوجد معلومات عن المدرس'}}</p>
                    </div>
                    <!-- /.instructor-data -->
                </div>
                <!-- /.intro_instructor-inner -->
            </div>
            <!-- /.intro-instructor -->
        </div>
        <!-- /.modal -->
    @endif



    <!-- =========================================================================================================================================== -->





    <div class="panel-pop modal" id="payment">

        <div>

            <h1>

                <i class="fa fa-shopping-cart"></i>

                تأكيد الاشتراك في الكورس

            </h1>

            <!-- Nav tabs -->

            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active">

                    <a href="#credit-card" aria-controls="credit-card" role="tab" data-toggle="tab">

                        <i class="fa fa-credit-card"></i>Credit Card

                    </a>

                </li>

                <li role="presentation">

                    <a href="#paypal" aria-controls="paypal" role="tab" data-toggle="tab">

                        <i class="fa fa-paypal"></i> Paypal

                    </a>

                </li>

            </ul>


            <!-- Tab panes -->

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane fade active" id="credit-card">...</div>

                <div role="tabpanel" class="tab-pane fade" id="paypal">

                    <div class="paypal-box text-center">

                        <a href="#">تأكيد الدفع من خلال البايبال</a>

                    </div>

                    <!-- end paypal-box -->

                </div>

            </div>


        </div>

    </div>

    <!-- /.modal -->



    <!-- =========================================================================================================================================== -->



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