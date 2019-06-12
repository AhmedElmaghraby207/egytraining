@section('title')
    تعديل الشهادة
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center"><span class="text-info">تعديل شهادة </span>{{$certificate->cer_name}}</p>
        </div>
        <a href="{{route('admin-certificates.index')}}" class="btn btn-primary"> عرض كل الشهادات <i class="fa fa-video-camera"></i></a>
        <a href="{{route('admin-certificates.show', $certificate->slug)}}" class="btn btn-primary"> عرض هذه الشهادة <i class="fa fa-arrow-right"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-certificates.update', $certificate->id)}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="cer_name" value="{{$certificate->cer_name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الجهه المانحة</label>
                    <textarea name="cer_owner" id="" class="form-control" cols="30" rows="5">{{$certificate->cer_owner}}</textarea>
                </div>

                <div class="form-group">
                    <label>الدورة</label>
                    <select name="course_id" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                    @if($certificate->course->id == $course->id)
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
                                        @if($certificate->coach->id == $coach->id)
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
                    <label for="status">التكلفة:  </label>
                    <input type="radio" name="cer_status" value="1"
                           @if($certificate->cer_status == 1)
                               checked
                           @endif
                    >  <span>مدفوع</span>
                    <input type="radio" name="cer_status" value="0"
                           @if($certificate->cer_status == 0)
                               checked
                           @endif
                    >  <span>مجانى</span>
                </div>

                <div class="form-group">
                    <label for="price">إذا كانت الدورة مدفوعة حدد السعر</label>
                    <input type="number" name="cer_price" value="{{$certificate->cer_price}}" class="form-control">
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