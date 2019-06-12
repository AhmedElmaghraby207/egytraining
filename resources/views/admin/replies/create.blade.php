@section('title')
    إضافة رد
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة رد على التعليق</p>
        </div>
        <a href="{{route('admin-replies.index')}}" class="btn btn-primary"> عرض كل الردود <i class="fa fa-rotate-right"></i></a>

        <div class="panel panel-body">
            <form action="{{route('admin-replies.store')}}" method="POST">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="comment_id" value="{{$comment_id}}">

                <div class="form-group">
                    <label>الرد</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب الرد على التعليق هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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