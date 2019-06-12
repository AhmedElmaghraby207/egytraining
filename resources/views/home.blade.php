@extends('website.layouts.website')

@section('title')
    الرئيسية
@stop

@section('search')

    <div class="search-box">
        <div class="container">
            <div class="search-inner">
                <h1 class="text-center">تستطيع من خلال موقعنا البحث  عن كل ما تريد من دورات </h1>
                <form action="{{url('/results')}}" method="get">
                    <div class="form-item col-xs-12">
                        <div class="input-container col-md-10 col-xs-12 input-lft pull-right">
                            <input type="text" name="query">
                        </div>
                        <!-- /.input-container -->
                        <div class="btn-container col-md-1 btn-right">
                            <a class="show-advanced">
                                بحث متقدم
                            </a>
                        </div>
                        <!-- end btn-container -->
                        <div class="btn-container col-md-1">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <!-- end btn-container -->
                    </div>
                    <!-- /.form-item -->
                    <div class="form-advanced col-xs-12 adv-left">
                        <div class="advanced-item col-md-3 col-xs-12 pull-right">
                            <h2>ابحث اسم الدورة</h2>
                            <input type="text" name="course_name">
                        </div>
                        <!-- /.advanced-item -->
                        <div class="advanced-item col-md-3 col-xs-12 pull-right">
                            <h2>ابحث باسم المدرب</h2>
                            <input type="text" name="coach_name">
                        </div>
                        <!-- /.advanced-item -->
                        <div class="advanced-item col-md-3 col-xs-12 pull-right">
                            <h2>ابحث بسعر الدورة</h2>
                            <input type="text" name="price">
                        </div>
                        <!-- /.advanced-item -->
                    </div>
                    <!-- /.form-advanced -->
                </form>
            </div>
            <!-- /.search-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.search-box -->

@stop



@section('content')

    <div class="allcourses-box">
        <div class="courses allcourses-body">
            <div class="container">
                <div class="courses-head text-center">
                    <h1>أحدث الدورات</h1>
                </div>
                <!-- /.testominal-head -->
                <div class="row">
                    <div class="row block-container">

                        @if(count($courses) > 0)
                            @foreach($courses as $course)
                                @if($course->active == 1 && $course->published == 1)
                                    @guest
                                        <div class="block col-md-4">
                                            <figure>
                                                @if($course->cover != null)
                                                    <div><img src="{{asset($course->cover)}}" alt="img05" class="img-responsive"></div>
                                                @else
                                                    <div><img src="{{asset('public/website/images/b3.jpg')}}" alt="img05" class="img-responsive"></div>
                                                @endif
                                                <figcaption class="text-right">
                                                    <h1>
                                                        <label>اسم الدورة</label>
                                                        <span>{{$course->name}}</span>
                                                    </h1>
                                                    <h1>
                                                        <label>اسم المدرس</label>
                                                        <span>{{$course->coach ? $course->coach->name : 'غير معروف'}}</span>
                                                    </h1>
                                                    <h1>
                                                        <label>عدد الطلبة المشاركين</label>
                                                        <span>{{count($course->trainers)}}</span>
                                                    </h1>
                                                    <h1>
                                                        <label>تاريخ بداية الكورس</label>
                                                        <span>{{$course->start_at ? $course->start_at : 'غير معروف'}}</span>
                                                    </h1>
                                                    <h1>
                                                        <label>تقييم الكورس</label>
                                                        <span>
                                                            <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $course->averageRating }}" data-size="xs" disabled="">
                                                        </span>
                                                    </h1>
                                                    <a href="{{route('courses.show', $course->slug)}}">
                                                        <i class="fa fa-eye"></i> مشاهدة الكورس
                                                    </a>
                                                </figcaption>
                                            </figure>
                                        </div>
                                        <!-- /.block -->
                                    @else
                                        @if(Auth::user()->gender == 1 and $course->male == 1)
                                            <div class="block col-md-4">
                                                <figure>
                                                    @if($course->cover != null)
                                                        <div><img src="{{asset($course->cover)}}" alt="img05" class="img-responsive"></div>
                                                    @else
                                                        <div><img src="{{asset('public/website/images/b3.jpg')}}" alt="img05" class="img-responsive"></div>
                                                    @endif
                                                    <figcaption class="text-right">
                                                        <h1>
                                                            <label>اسم الدورة</label>
                                                            <span>{{$course->name}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>اسم المدرس</label>
                                                            <span>{{$course->coach ? $course->coach->name : 'غير معروف'}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>عدد الطلبة المشاركين</label>
                                                            <span>{{count($course->trainers)}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>تاريخ بداية الدورة</label>
                                                            <span>{{$course->start_at ? $course->start_at : 'غير معروف'}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>تقييم الكورس</label>
                                                            <span>
                                                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $course->averageRating }}" data-size="xs" disabled="">
                                                            </span>
                                                        </h1>
                                                        <a href="{{route('courses.show', $course->slug)}}">
                                                            <i class="fa fa-eye"></i> مشاهدة الدورة
                                                        </a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                            <!-- /.block -->
                                        @elseif(Auth::user()->gender == 0 and $course->female == 1)
                                            <div class="block col-md-4">
                                                <figure>
                                                    @if($course->cover != null)
                                                        <div><img src="{{asset($course->cover)}}" alt="img05" class="img-responsive"></div>
                                                    @else
                                                        <div><img src="{{asset('public/website/images/b3.jpg')}}" alt="img05" class="img-responsive"></div>
                                                    @endif
                                                    <figcaption class="text-right">
                                                        <h1>
                                                            <label>اسم الدورة</label>
                                                            <span>{{$course->name}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>اسم المدرس</label>
                                                            <span>{{$course->coach ? $course->coach->name : 'غير معروف'}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>عدد الطلبة المشاركين</label>
                                                            <span>{{count($course->trainers)}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>تاريخ بداية الدورة</label>
                                                            <span>{{$course->start_at ? $course->start_at : 'غير معروف'}}</span>
                                                        </h1>
                                                        <h1>
                                                            <label>تقييم الكورس</label>
                                                            <span>
                                                                <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $course->averageRating }}" data-size="xs" disabled="">
                                                            </span>
                                                        </h1>
                                                        <a href="{{route('courses.show', $course->slug)}}">
                                                            <i class="fa fa-eye"></i> مشاهدة الدورة
                                                        </a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                            <!-- /.block -->
                                        @endif
                                    @endguest
                                @endif
                            @endforeach

                        @else
                            <div class="empty-msg text-center animated shake">
                                <h1>
                                    <i class="fa fa-video-camera"></i>
                                    عفوا لا يوجد دورات حتى الان
                                </h1>
                            </div>
                        @endif

                    </div>
                    <!-- /.row -->
                    @if(count($courses) > 0)
                    <div class="all-courses text-center">
                        <a href="{{route('courses.index')}}">عرض جميع الدورات</a>
                    </div>
                    <!-- /.all-courses -->
                    @endif

                </div>
            </div>
            <!-- /.conainer -->
        </div>
        <!-- /.courses -->

        <div class="testominal">
            <div class="overlay"></div>
            <div class="container">
                <div class="testo-head text-center">
                    <h1>قالوا عنا</h1>
                </div>
                <!-- /.testominal-head -->
                <div class="testo-slider text-center">
                    @if(count($sayings) > 0)
                        @foreach($sayings as $saying)
                            <div class="testo-item col-xs-12">
                                <p>{!! $saying->body !!}</p>
                                <div class="testo-img">
                                    @if($saying->image != null)
                                        <img width="100" height="100" src="{{asset($saying->image)}}" alt="" class="img-responsive">
                                    @else
                                        <img width="100" height="100" src="{{asset('public/website/images/comment-02.jpg')}}" alt="" class="img-responsive">
                                    @endif
                                </div>
                                <h1>{{$saying->name}}</h1>
                            </div>
                            <!-- /.testo-item -->
                        @endforeach
                    @endif
                </div>
                <!-- /. testo-slider -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.testominal -->
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $("#input-id").rating();
    </script>
@stop
