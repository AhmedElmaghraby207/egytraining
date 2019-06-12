@section('title')
    تعديل درس
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center"><span class="text-info">تعديل درس </span>{{$lecture->name}}</p>
        </div>
        <a href="{{route('admin-lectures.index')}}" class="btn btn-primary"> عرض كل الدروس <i class="fa fa-rotate-right"></i></a>
        <a href="{{route('admin-lectures.show', $lecture->slug)}}" class="btn btn-info"> عرض الدرس <i class="fa fa-arrow-right"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-lectures.update', $lecture->id)}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="name" value="{{$lecture->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <input type="text" required name="description" value="{{$lecture->description}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>المدرب</label>
                    <select name="coach_id" id="" class="form-control">
                        @foreach($coaches as $coach)
                            <option value="{{$coach->id}}"
                                @if($lecture->coach->id == $coach->id)
                                    selected
                                    class="text-danger text-bold"
                                @endif
                            >{{$coach->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>الدورة</label>
                    <select name="course_id" id="" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                @if($lecture->course->id == $course->id)
                                    selected
                                    class="text-danger text-bold"
                                @endif
                            >{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="video_link">لينك الفيديو</label>
                    <input type="url" name="video_link" value="{{$lecture->video_link}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="video">اذا اردت رفع فيديو من جهازك</label>
                    @if($lecture->video != null)
                        <video class="video-js vjs-default-skin" controls="true" width="100%" height="320" >
                            <source src="{{asset($lecture->video)}}" type='video/mp4' />
                        </video>
                    @else
                        <img src="{{asset('http://via.placeholder.com/100x100')}}" width="100" height="100" class="img-responsive img-rounded">
                    @endif
                    <input type="file" name="video" class="form-control">
                </div>

                <div class="form-group">
                    <label for="file">إرفاق ملف أو صورة</label>
                    @if($course->cover != null)
                        <img src="{{asset($lecture->file)}}" width="100" height="100" class="img-responsive img-rounded">
                    @else
                        <img src="{{asset('http://via.placeholder.com/100x100')}}" width="100" height="100" class="img-responsive img-rounded">
                    @endif
                    <input type="file" name="file" class="form-control">
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