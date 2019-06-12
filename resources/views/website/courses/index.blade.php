@extends('website.layouts.website')

@section('title')
    جميع الدورات
@stop

@section('content')

    <div class="allcourses-box">
        <div class="allcourses-head text-center">
            <div class="container">
                <h1>جميع الدورات</h1>

            </div>
            <!-- /.container -->
        </div>
        <!-- /.allcourses-head -->

        <div class="search-categories text-center">
            <div class="container">
                <div class="cat-item">
                    <div class="cat-inner col-md-6 col-sm-6 col-xs-6 pull-right">
{{--                        <a href="#" class="show-cat">  جميع الدورات ({{count(App\Course::where('active', 1)->where('published', 1)->get())}}) <i class="fa fa-caret-down"></i></a>--}}
                        <a href="#" class="show-cat">  جميع الدورات ({{count(App\Course::where([['active', '=', 1], ['published', '=', 1]])->get())}}) <i class="fa fa-caret-down"></i></a>
                        <div class="hidden-cat">
                            <ul>
                                <li>
                                    <a href="{{route('courses.index')}}">  جميع الدورات ({{count(App\Course::where([['active', '=', 1], ['published', '=', 1]])->get())}}) </a>
                                </li>
                                @foreach($categories as $our_category)
                                    <li>
                                        <a href="{{route('categories.show', $our_category->slug)}}">
                                            {{$our_category->name}}  ({{count(App\Course::where([
                                                                    ['category_id', '=', $our_category->id],
                                                                    ['active', '=', 1],
                                                                    ['published', '=', 1]
                                                                    ])->get())}})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /. cat-inner -->
                    <div class="cat-inner col-md-6 col-sm-6 col-xs-6 pull-left">
                        <form action="{{url('/results')}}" method="get">
                            <input type="search" name="query" required title="إبحث عن دورات أخرى">
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- /. cat-inner -->
                </div>
                <!-- /.cat-item -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.search-categories -->

        <div class="allcourses-body">
            <div class="container">
                <div class="row">
                    <div class="row block-container">

                        @if(count($courses) > 0 )
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
                                                        <label>اسم الكورس</label>
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
                                                            <label>اسم الكورس</label>
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
                                                            <label>اسم الكورس</label>
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
                                        @endif
                                    @endguest
                                @endif
                            @endforeach
                        @else
                            <div class="empty-msg text-center animated shake">
                                <h1>
                                    <i class="fa fa-video-camera"></i>
                                    عفوا لا يوجد كورسات حتى الان
                                </h1>
                            </div>
                        @endif


                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->

                <div class="inner col-xs-12 text-center">
                    {{$courses->render()}}
                </div>
                <!-- end inner -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /.allcourses-body -->
    </div>
    <!-- /.allcourses-box -->

@stop