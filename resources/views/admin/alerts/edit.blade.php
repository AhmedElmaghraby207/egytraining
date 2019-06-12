@section('title')
    تعديل التنويه
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-info">

        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل التنويه</p>
        </div>
        <a href="{{route('admin-alerts.index')}}" class="btn btn-primary"> عرض التنويهات <i class="fa fa-rotate-right"></i></a>
        <div class="panel panel-body">
            <form action="{{route('admin-alerts.update', $alert->id)}}" method="POST">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="cover">العنوان</label>
                    <input type="text" name="title" value="{{$alert->title}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="content">المحتوى</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب محتوى التنويه هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$alert->content}}</textarea>
                </div>

                <div class="form-group">
                    <label>الدورة</label>
                    <select name="course_id" id="" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}"
                                @if($alert->course->id == $course->id)
                                    selected
                                    class="text-bold text-danger"
                                @endif
                            >{{$course->name}}</option>
                        @endforeach
                    </select>
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