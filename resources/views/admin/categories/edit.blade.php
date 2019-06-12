@section('title')
    تعديل القسم
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">

        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل القسم</p>
        </div>
        <a href="{{route('admin-categories.index')}}" class="btn btn-primary"> عرض الاقسام <i class="fa fa-rotate-right"></i></a>
        <div class="panel panel-body">
            <form action="{{route('admin-categories.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="cover">اسم القسم</label>
                    <input type="text" name="name" value="{{$category->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cover">الوصف</label>
                    <textarea id="editor1" class="textarea" name="description" placeholder="إكتب الوصف هنا" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$category->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="over">الفلاف</label>
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