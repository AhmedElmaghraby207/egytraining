@section('title')
    إضافة درس
@stop

@include('admin.layouts.head')
@include('admin.layouts.header')
@include('admin.layouts.sidebar')

<div class="content-wrapper">
    @if($course_id != 0)
        <div class="panel panel-success">
            <div class="panel panel-heading">
                <p class="h1 text-center">إضافة درس جديد لدورة</p>
                <p class="h1 text-center">{{App\Course::where('id', $course_id)->first()->name}}</p>
            </div>
            <a href="{{route('admin-lectures.index')}}" class="btn btn-primary"> عرض الدروس <i class="fa fa-rotate-right"></i></a>


            <div class="panel panel-body">
                <form action="{{route('admin-lectures.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf()
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger text-center">{{$error}}</p>
                        @endforeach
                    @endif
                    <input type="hidden" name="course_id" value="{{$course_id}}">
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" required name="name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>الوصف</label>
                        <input type="text" required name="description" class="form-control">
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
                        <label for="video_link">لينك الفيديو</label>
                        <input type="url" name="video_link" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="video">اذا اردت رفع فيديو من جهازك</label>
                        <input type="file" name="video" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="file">إرفاق ملف أو صورة</label>
                        <input type="file" name="file" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-block" type="submit">إضافة</button>
                    </div>

                </form>
            </div>

        </div>
    @else
        <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة درس جديد</p>
        </div>
        <a href="{{route('admin-lectures.index')}}" class="btn btn-primary"> عرض الدروس <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('admin-lectures.store')}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <input type="text" required name="description" class="form-control">
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
                    <label>الدورة</label>
                    <select name="course_id" id="" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="video_link">لينك الفيديو</label>
                    <input type="url" name="video_link" class="form-control">
                </div>

                <div class="form-group">
                    <label for="video">اذا اردت رفع فيديو من جهازك</label>
                    <input type="file" name="video" class="form-control">
                </div>

                <div class="form-group">
                    <label for="file">إرفاق ملف أو صورة</label>
                    <input type="file" name="file" class="form-control">
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



