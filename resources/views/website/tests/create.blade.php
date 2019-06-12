@extends('website.layouts.website')

@section('title')
    إضافة أختبار
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>إضافة اختبار جديد</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">

                    <div class="add_lecture in-one">
                        <form action="{{route('course-tests.store')}}" method="post">
                            @csrf()
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <div class="lecture-item">
                                <h1>اضف السؤال</h1>
                                <textarea name="question" placeholder="اكتب سؤالك هنا"></textarea>
                            </div>
                            <!-- end lecture-item -->

                            <div class="lecture-item">
                                <h1>يجب عليك كتابة الاجابة الصحيحة فى أخر حقل فقط</h1>
                                <ul>
                                    <li>
                                        <input type="text" name="first_ans" placeholder="اكتب الاجابة الاولي">
                                    </li>
                                    <li>
                                        <input type="text" name="second_ans" placeholder="اكتب الاجابة الثانية">
                                    </li>
                                    <li>
                                        <input type="text" name="third_ans" placeholder="اكتب الاجابة الثالثة">
                                    </li>
                                    <li>
                                        <input type="text" name="correct_ans" placeholder="اكتب الاجابة الصحيحة">
                                    </li>
                                </ul>
                            </div>
                            <!-- end lecture-item -->
                            <div class="lecture-item confirm-lec">
                                <input type="submit" value="إضافة الاختبار">
                            </div>
                            <!-- end lecture-item -->
                        </form>
                    </div>
                    <!-- /.add_lecture -->
                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop

@section('scripts')
    <script type="text/javascript">
        $(':checkbox').checkboxpicker({
            onLabel: 'Right',
            offLabel: 'Wrong'
        });
    </script>
@stop