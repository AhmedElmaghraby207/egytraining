@extends('website.layouts.website')

@section('content')
    @if($method->state == 'approved')
        <div class="text-center" style="margin: 100px; padding: 50px;">
            <h1 class="h1">
                {{--Thank you for payment and join our course,--}}
                لقد تم الدفع وإشتراكك فى الدورة بنجاح,
                <p>
                    <a class="btn btn-success" href="{{route('courses.show', $course_slug)}}" style="margin: 30px;">
                        إبدأ الدورة الآن
                    </a>
                </p>
            </h1>
        </div>
    @else
        <div class="text-center" style="margin: 100px; padding: 50px;">
            <h1 class="h1 text-danger">
                حدث خطأ ما أثناء عملية الدفع,
                <p>
                    <a class="btn btn-primary" href="{{route('courses.show', $course_slug)}}" style="margin: 30px;">
                        حاول مرة أخرى
                    </a>
                </p>
            </h1>
        </div>
    @endif
@stop

