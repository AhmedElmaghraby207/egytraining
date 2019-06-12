@extends('website.layouts.website')

@section('title')
    الاقسام
@stop

@section('content')

    <div class="allcourses-box">
        <div class="allcourses-head text-center">
            <div class="container">
                <h1>الاقسام</h1>

            </div>
            <!-- /.container -->
        </div>
        <!-- /.allcourses-head -->

        <div class="allcourses-body">
            <div class="container">
                <div class="row">
                    <div class="row block-container">

                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                            <div class="block col-md-4">
                                <figure>
                                    @if($category->cover != null)
                                        <div><img src="{{asset($category->cover)}}" alt="img05" class="img-responsive"></div>
                                    @else
                                        <div><img src="{{asset('public/website/images/b3.jpg')}}" class="img-responsive img-rounded"></div>
                                    @endif
                                    <figcaption class="text-right">
                                        <h1>
                                            <label>اسم القسم</label>
                                            <span>{{$category->name}}</span>
                                        </h1>
                                        <h1>
                                            <label>عدد الكورسات</label>
                                            <span>{{count($category->courses)}}</span>
                                        </h1>

                                        <a href="{{route('categories.show', $category->slug)}}">
                                            <i class="fa fa-eye"></i> الذهاب إلى القسم
                                        </a>
                                    </figcaption>
                                </figure>
                            </div>
                            <!-- /.block -->
                            @endforeach
                        @else
                            <div class="empty-msg text-center animated shake">
                                <h1>
                                    <i class="fa fa-video-camera"></i>
                                    عفوا لا يوجد أقسام
                                </h1>
                            </div>
                        @endif


                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.row -->

                <div class="inner col-xs-12 text-center">
                    {{$categories->render()}}
                </div>
                <!-- end inner -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /.allcourses-body -->
    </div>
    <!-- /.allcourses-box -->

@stop