@section('title')
    تعديل الرد
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-info">

        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل الرد</p>
        </div>
        <a href="{{route('admin-replies.index')}}" class="btn btn-primary"> عرض كل الردود <i class="fa fa-reply-all"></i></a>
        <a href="{{route('admin-comments.show', $reply->comment->slug)}}" class="btn btn-primary"> عرض التعليق <i class="fa fa-comment"></i></a>
        <div class="panel panel-body">
            <form action="{{route('admin-replies.update', $reply->id)}}" method="POST">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="content">الرد</label>
                    <textarea id="editor1" class="textarea" name="content" placeholder="إكتب محتوى الرد هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$reply->content}}</textarea>
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