@section('title')
    تعديل الاختبار
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل إختبار</p>
        </div>
        <a href="{{route('admin-tests.index')}}" class="btn btn-primary"> عرض الاختبارات <i class="fa fa-list"></i></a>
        <a href="{{route('admin-tests.show', $test->slug)}}" class="btn btn-primary"> عرض هذا الاختبار <i class="fa fa-paper-plane"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-tests.update', $test->id)}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>السؤال</label>
                    <input type="text" required name="question" value="{{$test->question}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>1- الاجابة الاولى</label>
                    <input type="text" required name="first_ans" value="{{$test->first_ans}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>2- الاجابة الثانية</label>
                    <input type="text" required name="second_ans" value="{{$test->second_ans}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>3- الاجابة الثالثة</label>
                    <input type="text" required name="third_ans" value="{{$test->third_ans}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>4- الاجابة الصحيحة</label>
                    <input type="text" required name="correct_ans" value="{{$test->correct_ans}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الدورة</label>
                    <select name="course_id" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                @if($test->course->id == $course->id)
                                    selected
                                    class="text-danger text-bold"
                                @endif
                            >{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>المدرب</label>
                    @if($coaches)
                        <select name="coach_id" id="" class="form-control">
                            @if($course->coach_id != null)
                                @foreach($coaches as $coach)
                                    <option value="{{$coach->id}}"
                                        @if($test->coach->id == $coach->id)
                                            selected
                                            class="text-danger text-bold"
                                        @endif
                                    >{{$coach->name}}</option>
                                @endforeach
                            @else
                                @foreach($coaches as $coach)
                                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    @else
                        <label for="">لا يوجد مدربين</label>
                    @endif
                </div>

                <div class="form-group">
                    <button class="btn btn-info btn-block" type="submit"
                            onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                    >حفظ</button>
                </div>

            </form>
        </div>

    </div>
</div>


@include('admin.layouts.footer')