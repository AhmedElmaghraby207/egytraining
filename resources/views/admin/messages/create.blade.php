@section('title')
    إضافة رسالة
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة رسالة جديدة</p>
        </div>
        <a href="{{route('admin-messages.index')}}" class="btn btn-primary"> عرض الرسائل <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('admin-messages.store')}}" method="POST">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>المحتوى</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب محتوى الرسالة هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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