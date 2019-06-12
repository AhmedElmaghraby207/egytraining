@section('title')
    تعديل الدورة
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center"><span class="text-info">تعديل دورة </span>{{$course->name}}</p>
        </div>
        <a href="{{route('admin-courses.index')}}" class="btn btn-primary"> عرض كل الدورات <i class="fa fa-th"></i></a>
        <a href="{{route('admin-courses.show', $course->slug)}}" class="btn btn-primary"> عرض هذه الدورة <i class="fa fa-arrow-right"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-courses.update', $course->id)}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="name" value="{{$course->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea name="description" class="form-control" cols="30" rows="5">{{$course->description}}</textarea>
                </div>

                <div class="form-group">
                    <label>القسم</label>
                    <select name="category_id" id="" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if($course->category->id == $category->id)
                                    selected
                                    class="text-danger text-bold"
                                @endif
                            >{{$category->name}}</option>
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
                                            @if($course->coach->id == $coach->id)
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
                    <label for="cover">صورة الغلاف</label>
                    @if($course->cover != null)
                        <img src="{{asset($course->cover)}}" width="100" height="100" class="img-responsive img-rounded">
                    @else
                        <img src="{{asset('http://via.placeholder.com/100x100')}}" width="100" height="100" class="img-responsive img-rounded">
                    @endif
                    <input type="file" name="cover" class="form-control">
                </div>

                <div class="form-group">
                    <label for="video_link">لينك الفيديو</label>
                    <input type="url" name="video_link" value="{{$course->video_link}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="video">اذا اردت رفع فيديو من جهازك</label>
                    @if($course->video != null)
                        <video class="video-js vjs-default-skin" controls="true" width="100%" height="320" >
                            <source src="{{asset($course->video)}}" type='video/mp4' />
                        </video>
                    @else
                        <img src="{{asset('http://via.placeholder.com/100x100')}}" width="100" height="100" class="img-responsive img-rounded">
                    @endif
                    <input type="file" name="video" class="form-control">
                </div>

                <div class="form-group">
                    <label for="start_at">تاريخ بداية الدورة</label>
                    <input type="text" name="start_at" value="{{$course->start_at}}" class="form-control datepicker">
                </div>

                <div class="form-group">
                    <label for="finish_at">تاريخ نهاية الدورة</label>
                    <input type="text" name="finish_at" value="{{$course->finish_at}}" class="form-control datepicker">
                </div>

                <div class="form-group">
                    <label for="needs">متطلبات سابقة</label>
                    <input type="text" name="needs" value="{{$course->needs}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="status">التكلفة:  </label>
                    <input type="radio" name="status" value="1"
                           @if($course->status == 1)
                               checked
                           @endif
                    >  <span>مدفوع</span>
                    <input type="radio" name="status" value="0"
                           @if($course->status == 0)
                               checked
                           @endif
                    >  <span>مجانى</span>
                </div>

                <div class="form-group">
                    <label for="price">إذا كانت الدورة مدفوعة حدد السعر</label>
                    <input type="number" name="price" value="{{$course->price}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="male">الجنس المتوقع</label>
                    <input type="checkbox" value="1" name="male"
                           @if($course->male == 1)
                           checked
                            @endif
                    >  <span>ذكور</span>
                    <input type="checkbox" value="1" name="female"
                           @if($course->female == 1)
                           checked
                            @endif
                    >  <span>إناث</span>
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