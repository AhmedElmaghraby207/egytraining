@extends('website.layouts.website')

@section('title')
    من نحن
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>من نحن</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box about-box">
            <div class="container">
                <div class="about-img col-md-4 col-xs-12 pull-left">
                    @if(App\Setting::first()->about_image != null)
                        <img src="{{asset(App\Setting::first()->about_image)}}" class="img-responsive" alt="">
                    @else
                        <img src="{{asset('public/website/images/3lom.jpg')}}" class="img-responsive" alt="">
                    @endif
                </div>
                <!-- end about-img -->
                <div class="about-data col-md-8 col-xs-12 pull-right text-right">
                    <p>{!! App\Setting::first()->about_content !!}</p>
                </div>
                <!-- end about-data -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop