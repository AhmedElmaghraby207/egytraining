@section('title')
    إضافة دورة
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة دورة جديدة</p>
        </div>
        <a href="{{route('admin-courses.index')}}" class="btn btn-primary"> عرض الدورات <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('admin-courses.store')}}" method="POST" enctype="multipart/form-data">
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
                    <label>القسم</label>
                    <select name="category_id" id="" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="cover">صورة الغلاف</label>
                    <input type="file" name="cover" class="form-control">
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
                    <label for="start_at">تاريخ بداية الدورة</label>
                    <input type="text" name="start_at" class="form-control datepicker">
                </div>

                <div class="form-group">
                    <label for="finish_at">تاريخ نهاية الدورة</label>
                    <input type="text" name="finish_at" class="form-control datepicker">
                </div>

                <div class="form-group">
                    <label for="needs">متطلبات سابقة</label>
                    <input type="text" name="needs" class="form-control">
                </div>

                <div class="form-group">
                    <label for="status">التكلفة:  </label>
                    <input type="radio" name="status" value="1">  <span>مدفوع</span>
                    <input type="radio" name="status" value="0">  <span>مجانى</span>
                </div>

                <div class="form-group">
                    <label for="price">إذا كانت الدورة مدفوعة حدد السعر</label>
                    <input type="number" name="price" class="form-control">
                </div>

                <div class="form-group">
                    <label for="male">الجنس المتوقع</label>
                    <input type="checkbox" value="1" name="male">  <span>ذكور</span>
                    <input type="checkbox" value="1" name="female">  <span>إناث</span>
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


{{--@section('scripts')--}}
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#price-input').click(function () {--}}
                {{--if ($(this).prop("checked") === true) {--}}
                    {{--$('.cerWithPrice').stop();--}}
                    {{--$('.cerWithPrice').slideDown();--}}
                    {{--$('.linked').fadeOut();--}}
                {{--} else if ($(this).prop("checked") === false) {--}}
                    {{--$('.cerWithPrice').stop();--}}
                    {{--$('.cerWithPrice').slideUp();--}}
                    {{--$('.linked').fadeIn();--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
{{--@stop--}}

@include('admin.layouts.footer')
