@section('title')
    تعديل متدرب
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="panel panel-success">
        <div class="panel panel-heading">
            <p class="h1 text-center">تعديل المتدرب</p>
        </div>
        <a href="{{route('trainers.index')}}" class="btn btn-primary"> عرض المتدربين <i class="fa fa-rotate-right"></i></a>


        <div class="panel panel-body">
            <form action="{{route('trainers.update', $trainer->id)}}" method="POST" enctype="multipart/form-data">
                @csrf()
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger text-center">{{$error}}</p>
                    @endforeach
                @endif
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" required name="name" value="{{$trainer->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>اسم المستخدم</label>
                    <input type="text" required name="user_name" value="{{$trainer->user_name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الايميل</label>
                    <input type="email" value="{{$trainer->email}}" required name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label>الهاتف</label>
                    <input type="text" value="{{$trainer->phone}}" name="phone" class="form-control">
                </div>

                <div class="form-group">
                    <label>المؤهل</label>
                    <input type="text" required name="qualification" value="{{$trainer->qualification}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>مجال العمل</label>
                    <input type="text" required name="career" value="{{$trainer->career}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>التخصص</label>
                    <input type="text" required name="specialize" value="{{$trainer->specialize}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>عن المدرب</label>
                    <input type="text" required name="about" value="{{$trainer->about}}" class="form-control">
                </div>

                <div class="form-group">
                    <label>الدولة: </label>
                    <select name="country_id" class="form-control">
                        @if($countries)
                            @foreach($countries as $country)
                                <option value="{{$country->id}}"
                                        @if($trainer->country_id == $country->id)
                                        selected
                                        class="text-bold text-danger"
                                        @endif
                                >{{$country->name}}</option>
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
                                <input type="checkbox" class="text-left" name="interests[]" value="{{$interest->id}}"
                                   @foreach($trainer->interests as $i)
                                       @if($interest->id == $i->id)
                                            checked
                                       @endif
                                    @endforeach
                                >
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
                    @if($trainer->image != null)
                        <img src="{{asset($trainer->image)}}" width="100" height="100" class="img-responsive img-circle">
                    @else
                        <img src="{{asset('http://via.placeholder.com/100x100')}}" width="100" height="100" class="img-responsive img-circle">
                    @endif
                    <input type="file" name="image" class="form-control">
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