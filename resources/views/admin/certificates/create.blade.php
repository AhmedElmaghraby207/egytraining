@section('title')
    إضافة شهادة
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة شهادة جديدة</p>
        </div>
        <a href="{{route('admin-certificates.index')}}" class="btn btn-primary"> عرض الشهادات <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('admin-certificates.store')}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="cer_name" class="form-control">
                </div>

                <div class="form-group">
                    <label>الجهه المانحة</label>
                    <input type="text" required name="cer_owner" class="form-control">
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
                    <label for="status">التكلفة:  </label>
                    <input type="radio" name="cer_status" value="1">  <span>مدفوع</span>
                    <input type="radio" name="cer_status" value="0">  <span>مجانى</span>
                </div>

                <div class="form-group">
                    <label for="price">إذا كانت الشهادة مدفوعة حدد السعر</label>
                    <input type="number" name="cer_price" class="form-control">
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit"
                            onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                    >إضافة</button>
                </div>

            </form>
        </div>

    </div>
</div>


@include('admin.layouts.footer')