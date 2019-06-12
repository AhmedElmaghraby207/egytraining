@section('title')
    إضافة مدرب
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">إضافة مدرب جديد</p>
        </div>
        <a href="{{route('coaches.index')}}" class="btn btn-primary"> عرض المدربين <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('coaches.store')}}" method="POST" enctype="multipart/form-data">
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
                    <label>اسم المستخدم</label>
                    <input type="text" required name="user_name" class="form-control">
                </div>

                <div class="form-group">
                    <label>الايميل</label>
                    <input type="email" required name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>الهاتف</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label>المؤهل</label>
                    <input type="text" required name="qualification" class="form-control">
                </div>

                <div class="form-group">
                    <label>مجال العمل</label>
                    <input type="text" required name="career" class="form-control">
                </div>

                <div class="form-group">
                    <label>التخصص</label>
                    <input type="text" required name="specialize" class="form-control">
                </div>

                <div class="form-group">
                    <label>عن المدرب</label>
                    <input type="text" required name="about" class="form-control">
                </div>

                <div class="form-group">
                    <label>الدولة: </label>
                    <select name="country_id" class="form-control">
                        @if($countries)
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <hr>
                <div class="form-group">
                    <label class="checkbox block">الاهتمامات: </label>
                    @if($interests)
                        @foreach($interests as $interest)
                            <label>
                                <input type="checkbox" class="text-left" name="interests[]" value="{{$interest->id}}">
                                <span>{{$interest->name}}</span>
                            </label>
                        @endforeach
                    @endif
                </div>

                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" required name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label>إعادة كلمة المرور</label>
                    <input type="password" name="password_confirmation" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="image">الصورة الشخصية</label>
                    <input type="file" name="image" class="form-control">
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