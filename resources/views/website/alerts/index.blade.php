@extends('website.layouts.website')

@section('title')
    التنويهات
@stop

@section('content')

    <div class="intro-container col-xs-12">
        <div class="intro-head text-center">
            <div class="container">
                <h1>{{$course->name}}تنويهات دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.intro-head -->

        <div class="corse-box col-xs-12">
            <div class="corse-nav text-center">
                <div class="container">
                    <ul>

                        <li>
                            <a href="{{route('courses.show', $course->slug)}}">
                                <i class="fa fa-tasks"></i> الدورة
                            </a>
                        </li>

                        <li>
                            <form action="{{route('lectures.index')}}" method="get">
                                @csrf()
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                <button class="btn btn-lg btn-primary pull-left" style="margin-bottom: -17px;">
                                    <i class="fa fa-tasks"></i>
                                    عرض الدروس
                                </button>
                            </form>
                        </li>


                    </ul>
                </div>
                <!-- end container -->
            </div>
            <!-- end corse-nav -->
            <div class="lesson-box text-right">
                <div class="container">
                    <div class="alert-box">
                        @if(count($course->alerts) > 0)
                        <div class="all-alerts col-xs-12 text-right">
                            <ul>
                                @foreach($course->alerts as $alert)
                                <li>
                                    <h1 style="display: block; color: #0b74dd">{{$alert->coach? $alert->coach->name : App\Setting::first()->site_name}}</h1>
                                    <h1>{{$alert->title}}</h1>
                                <span style="margin-top: -40px;">{{$alert->created_at->diffForHumans()}}</span>
                                    <p>{!! $alert->content !!}</p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- end all-alerts -->

                        @else
                        <div class="empty-msg text-center animated shake">
                            <h1>
                                <i class="fa fa-bell-slash"></i>
                                لا توجد تنويهات حتي الان
                            </h1>
                        </div>
                        @endif
                        <!-- end empty-msg -->
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

@stop