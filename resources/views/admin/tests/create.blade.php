@section('title')
    إضافة إختبار
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة إختبار جديد</p>
        </div>
        <a href="{{route('admin-tests.index')}}" class="btn btn-primary"> عرض الاختبارات <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            @if($course_id > 0)
                <form action="{{route('admin-tests.store')}}" method="POST">
                    @csrf()
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger text-center">{{$error}}</p>
                        @endforeach
                    @endif
                        <input type="hidden" name="course_id" value="{{$course_id}}">
                    <div class="form-group">
                        <label>السؤال</label>
                        <input type="text" required name="question" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>1- الاجابة الاولى</label>
                        <input type="text" required name="first_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>2- الاجابة الثانية</label>
                        <input type="text" required name="second_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>3- الاجابة الثالثة</label>
                        <input type="text" required name="third_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>4- الاجابة الصحيحة</label>
                        <input type="text" required name="correct_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>المدرب</label>
                        <select name="coach_id" id="" class="form-control">
                            @foreach($coaches as $coach)
                                <option value="{{$coach->id}}">{{$coach->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-block" type="submit">إضافة</button>
                    </div>
                </form>
            @elseif($course_id == 0)
                <form action="{{route('admin-tests.store')}}" method="POST">
                    @csrf()
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger text-center">{{$error}}</p>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label>السؤال</label>
                        <input type="text" required name="question" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>1- الاجابة الاولى</label>
                        <input type="text" required name="first_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>2- الاجابة الثانية</label>
                        <input type="text" required name="second_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>3- الاجابة الثالثة</label>
                        <input type="text" required name="third_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>4- الاجابة الصحيحة</label>
                        <input type="text" required name="correct_ans" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>الدورة</label>
                        <select name="course_id" id="" class="form-control">
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>المدرب</label>
                        <select name="coach_id" id="" class="form-control">
                            @foreach($coaches as $coach)
                                <option value="{{$coach->id}}">{{$coach->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-block" type="submit"
                                onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                        >إضافة</button>
                    </div>

                </form>
            @endif
        </div>

    </div>
</div>


@include('admin.layouts.footer')