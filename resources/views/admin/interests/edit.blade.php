@section('title')
    تعديل الاهتمامات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">

        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل الدول</p>
        </div>
        <a href="{{route('interests.index')}}" class="btn btn-primary"> عرض الاهتمامات <i class="fa fa-rotate-right"></i></a>
        <div class="panel panel-body">
            <form action="{{route('interests.update', $interest->id)}}" method="POST">
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="cover">اسم الدولة</label>
                    <input type="text" name="name" value="{{$interest->name}}" class="form-control">
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