@section('title')
    إضافة تعليق
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    @if($lecture_id != 0)
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة تعليق على درس</p>
            <p class="h3 text-center text-primary">{{App\Lecture::where('id', $lecture_id)->first()->name}}</p>
        </div>
        <a href="{{route('admin-comments.index')}}" class="btn btn-primary"> عرض كل التعليقات <i class="fa fa-rotate-right"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-comments.store')}}" method="POST">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="lecture_id" value="{{$lecture_id}}">
                <div class="form-group">
                    <label>التعليق</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب التعليق على الدرس هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">إضافة</button>
                </div>

            </form>
        </div>

    </div>

    @elseif($course_id != 0)
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة تعليق على دورة</p>
            <p class="h3 text-center text-primary">{{App\Course::where('id', $course_id)->first()->name}}</p>
        </div>
        <a href="{{route('admin-comments.index')}}" class="btn btn-primary"> عرض كل التعليقات <i class="fa fa-rotate-right"></i></a>
        <div class="panel panel-body">
            <form action="{{route('admin-comments.store')}}" method="POST">
                @csrf()
                <input type="hidden" name="course_id" value="{{$course_id}}">
                <div class="form-group">
                    <label>التعليق</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب التعليق على الدورة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">إضافة</button>
                </div>

            </form>
        </div>
    </div>
    {{-------------------------------------------------------------------------------------------------}}
    @else
        <div class="panel panel-success col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-heading">
                <p class="h1 text-center">إضافة تعليق على درس</p>
            </div>
            <a href="{{route('admin-comments.index')}}" class="btn btn-primary"> عرض كل التعليقات <i class="fa fa-rotate-right"></i></a>
            <div class="panel panel-body">
                <form action="{{route('admin-comments.store')}}" method="POST">
                    @csrf()
                    <div class="form-group">
                        <label>التعليق</label>
                        <textarea id="editor1" class="textarea" name="content" placeholder="إكتب التعليق على الدورة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>

                    <div class="form-group">
                        <label>الدرس</label>
                        <select name="lecture_id" id="" class="form-control">
                            @foreach($lectures as $lecture)
                                <option value="{{$lecture->id}}">{{$lecture->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-block" type="submit">إضافة</button>
                    </div>

                </form>
            </div>

        </div>
        <div class="panel panel-success col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-heading">
                <p class="h1 text-center">إضافة تعليق على دورة</p>
            </div>
            <a href="{{route('admin-comments.index')}}" class="btn btn-primary"> عرض كل التعليقات <i class="fa fa-rotate-right"></i></a>
            <div class="panel panel-body">
                <form action="{{route('admin-comments.store')}}" method="POST">
                    @csrf()
                    <div class="form-group">
                        <label>التعليق</label>
                        <textarea id="editor1" class="textarea" name="content" placeholder="إكتب التعليق على الدورة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                        <button class="btn btn-success btn-block" type="submit"
                                onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                        >إضافة</button>
                    </div>

                </form>
            </div>
        </div>
    @endif
</div>


@include('admin.layouts.footer')