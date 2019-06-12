@extends('website.layouts.website')

@section('title')
    صفحة الدورة
@stop

@section('content')

    <div class="intro-container col-xs-12">
        <div class="intro-head text-center">
            <div class="container">
                <h1><a class="btn btn-lg btn-info" href="{{route('courses.show', $course->slug)}}">{{$course->name}}</a> دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.intro-head -->

        <div class="corse-box col-xs-12">
            <div class="corse-nav text-center">
                <div class="container">
                    <ul>
                        @if(Auth::user()->id == $course->coach->id)
                            <li>
                                <form action="{{route('lectures.create')}}" method="get" style="margin: 3px">
                                    @csrf()
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <button class="btn btn-lg btn-success">
                                        <i class="fa fa-plus"></i> إضافة درس
                                    </button>
                                </form>
                            </li>
                            <li>
                                <a href="#" class="add-alert-form">
                                    <i class="fa fa-bullhorn"></i> إضافة تنويه
                                </a>
                            </li>
                            <li>
                                <a href="#" class="sent-all">
                                    <i class="fa fa-envelope"></i> إرسال للجميع
                                </a>
                            </li>
                        @endif

                        <li>
                            <form action="{{route('alerts.index')}}" method="get" style="margin: 3px">
                                @csrf()
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-lg btn-success">
                                    <i class="fa fa-bell"></i>التنويهات
                                </button>
                            </form>
                        </li>
                    </ul>
                    <!-- =========================================================================================================================================== -->

                    <div class="panel-pop modal" id="msg-all">
                        <div class="lost-inner">
                            <h1>
                                <i class="fa fa-envelope"></i>
                                إرسال لجميع الطلاب المشتركين في الدورة
                            </h1>
                            <div class="lost-item" id="messageTo">
                                <textarea placeholder="اكتب الرسالة هنا"></textarea>
                            </div>
                            <!-- /.lost-item -->
                            <div class="text-center">
                                <input type="submit" value="إرسال">
                            </div>
                            <!-- /.lost-item -->
                        </div>
                        <!-- /.lost-inner -->
                    </div>
                    <!-- /.modal -->

                    <!-- =========================================================================================================================================== -->

                    <div>
                        <div class="panel-pop modal" id="alert-all">
                            <div class="lost-inner">
                                <h1>
                                    <i class="fa fa-envelope"></i>
                                    اضافة تنويه للطلاب المشتركين في الدورة
                                </h1>
                                <div class="lost-item" id="alert-item">
                                    <input type="text" placeholder="عنوان التنويه">
                                </div>
                                <!-- /.lost-item -->
                                <div class="lost-item" id="alert-item">
                                    <textarea placeholder="مضمون التنويه"></textarea>
                                </div>
                                <!-- /.lost-item -->
                                <div class="text-center">
                                    <input type="submit" value="نشر التنويه">
                                </div>
                                <!-- /.lost-item -->
                            </div>
                            <!-- /.lost-inner -->
                        </div>
                        <!-- /.modal -->

                    </div>

                    <!-- =========================================================================================================================================== -->
                </div>
                <!-- end container -->
            </div>
            <!-- end corse-nav -->

            <div class="lesson-box text-right">
                <div class="container">


                    <div class="certf text-center animated bounceIn">
                        <h1>تهانينا لقد انتهيت من هذه الدورة بنجاح </h1>
                        <form action="{{route('certificates.show', $course->certificate->slug)}}" method="get">
                            <button class="btn btn-lg btn-primary" style="margin: 5px">
                                <i class="fa fa-certificate"></i> عرض الشهادة
                            </button>
                        </form>
                        {{--<a href="#">--}}
                            {{--<i class="fa fa-print"></i> تستطيع طباعة الشهادة--}}
                        {{--</a>--}}
                    </div>
                    <!-- end certf -->


                    @if(count($course->lectures) > 0)
                        <div class="week-module text-right">
                            <h1>
                                <i class="fa fa-tasks"></i>
                                الدروس
                            </h1>
                        </div>
                        <!-- end week-moduke -->

                        <div>
                            <ul>
                                @if(Auth::user()->coach == 1 && Auth::user()->id == $course->coach->id)
                                    @foreach($course->lectures as $lecture)
                                    @if($lecture->active == 1 && $lecture->published == 0)
                                            <!-- end week-moduke -->
                                        <div style="margin-bottom: 50px">
                                            <li>
                                                <a href="{{route('lectures.show', $lecture->slug)}}" class="lesson-det">
                                                    <i class="fa fa-play-circle"></i>
                                                    <span class="lesson-name">
                                                        {{$lecture->name}}
                                                        <span style="color: red">(لم ينشر بعد)</span>
                                                    </span>
                                                </a>
                                                <h3>{{$lecture->created_at->diffForHumans()}}</h3>


                                                <a href="{{route('lectures.edit', $lecture->slug)}}" style="margin: 4px"
                                                   class="btn btn-info pull-left" title="تعديل الدرس">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{route('lectures.publish', $lecture->id)}}" style="margin: 4px"
                                                   class="btn btn-success pull-left" title="نشر الدرس">
                                                    <i class="fa fa-share"></i>
                                                </a>

                                                <a href="#" class="del-lesson" data-toggle="tooltip"
                                                   data-placement="top" title="حذف الدرس"
                                                   onclick="
                                                           var result = confirm('هل أنت متأكد من حذف هذا الدرس؟');
                                                           if(result)
                                                           {
                                                           event.preventDefault();
                                                           document.getElementById('delete-form-{{ $lecture->id }}').submit();
                                                           }
                                                           "
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $lecture->id }}"
                                                      action="{{route('lectures.destroy', $lecture->id)}}"
                                                      method="POST">
                                                    @csrf()
                                                    <input type="hidden" name="_method" value="DELETE">
                                                </form>
                                            </li>
                                        </div>
                                        <hr>

                                    @endif
                                @endforeach
                                @endif
                            </ul>
                            <ul>
                                @foreach($course->lectures as $lecture)
                                    @if($lecture->active == 1 && $lecture->published == 1)
                                        <div>
                                            <li>
                                                <a href="{{route('lectures.show', $lecture->slug)}}" class="lesson-det">
                                                    <i class="fa fa-play-circle"></i>
                                                    <span class="lesson-name">{{$lecture->name}}</span>
                                                </a>
                                                <h3>{{$lecture->created_at->diffForHumans()}}</h3>
                                                @if(Auth::user()->id == $course->coach->id)

                                                    <a href="{{route('lectures.edit', $lecture->slug)}}" style="margin: 4px"
                                                       class="btn btn-info pull-left" title="تعديل الدرس">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="{{route('lectures.unPublish', $lecture->id)}}" style="margin: 4px"
                                                       class="btn btn-warning pull-left" title="إيقاف نشر الدرس">
                                                        <i class="fa fa-stop"></i>
                                                    </a>

                                                    <a href="#" class="del-lesson" data-toggle="tooltip"
                                                       data-placement="top" title="حذف الدرس"
                                                       onclick="
                                                               var result = confirm('هل أنت متأكد من حذف هذا الدرس؟');
                                                               if(result)
                                                               {
                                                               event.preventDefault();
                                                               document.getElementById('delete-form-{{ $lecture->id }}').submit();
                                                               }
                                                               "
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $lecture->id }}"
                                                          action="{{route('lectures.destroy', $lecture->id)}}"
                                                          method="POST">
                                                        @csrf()
                                                        <input type="hidden" name="_method" value="DELETE">
                                                    </form>

                                                @endif
                                            </li>
                                        </div>
                                    @else
                                        @if(Auth::user()->id != $course->coach->id)
                                        <div class="empty-msg text-center animated shake">
                                            <h1>
                                                <i class="fa fa-frown-o"></i>
                                                لا يوجد دروس الان ولكن يمكنك الاشتراك في الدورة لحين بدأها
                                            </h1>
                                        </div>
                                        <!-- end empty-msg -->
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                    @else
                        <div class="empty-msg text-center animated shake">
                            <h1>
                                <i class="fa fa-frown-o"></i>
                                لا يوجد دروس الان ولكن يمكنك الاشتراك في الدورة لحين بدأها
                            </h1>
                        </div>
                        <!-- end empty-msg -->
                    @endif

                    @if(count($course->tests) > 0)
                        <div class="take-exam col-xs-12 text-center">
                            <form action="{{route('course-tests.index')}}" method="get">
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-primary" style="margin: 5px">
                                    <i class="fa fa-pencil"></i>
                                     بدأ الاختبارات الان
                                </button>
                            </form>
                        </div>
                        <!-- end take-exam -->
                    @endif

                    {{--<div class="take-exam col-xs-12 text-center">--}}
                        {{--<a href="{{}}">--}}
                            {{--<i class="fa fa-file-text-o"></i> ابدا الاختبار الان--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<!-- end take-exam -->--}}

                </div>
                <!-- end container -->
            </div>
            <!-- end lesson-box -->

        </div>
        <!-- end corse-box -->

    </div>
    <!-- /.intro-container -->

@stop