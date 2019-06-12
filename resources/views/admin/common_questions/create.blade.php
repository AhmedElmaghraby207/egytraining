@section('title')
    إضافة سؤال
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة سؤال جديد</p>
        </div>
        <a href="{{route('questions.index')}}" class="btn btn-primary"> عرض الاسئلة <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('questions.store')}}" method="POST">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>السؤال</label>
                    <input type="text" name="question" class="form-control">
                </div>

                <div class="form-group">
                    <label>الاجابة</label>
                    <textarea id="editor1" class="textarea" name="answer" placeholder="إكتب الاجابة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit"
                            onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                    >حفظ</button>
                </div>

            </form>
        </div>

    </div>
</div>


@include('admin.layouts.footer')