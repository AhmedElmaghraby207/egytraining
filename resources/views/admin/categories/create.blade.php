@section('title')
    إضافة قسم
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة قسم جديد</p>
        </div>
        <a href="{{route('admin-categories.index')}}" class="btn btn-primary"> عرض الاقسام <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('admin-categories.store')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>اسم القسم</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>الوصف</label>
                    <textarea id="editor1" class="textarea" name="description" placeholder="إكتب الوصف هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>

                <div class="form-group">
                    <label for="cover">الغلاف</label>
                    <input type="file" name="cover" class="form-control">
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