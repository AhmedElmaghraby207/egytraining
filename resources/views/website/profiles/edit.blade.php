@extends('website.layouts.website')

@section('title')
    تعديل الصفحة الشخصية
@stop

@section('content')


    <div class="profile-content empty-course" style="padding: 20px 0 300px 0">
        <div class="container">
            <div class="left_tap-box col-md-10 col-xs-12 col-sm-offset-1">
                <div class="left_box-inner">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in  active" id="home">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-user"></i>
                                    تعديل الملف الشخصي
                                    <a href="{{route('my_profile.index')}}" class="edit-personal">
                                        <i class="fa fa-cog"></i>
                                        إلغاء التعديل
                                    </a>
                                </h1>
                            </div>
                            <!-- /.home-head -->

                            <form action="{{route('my_profile.update', $user->id)}}" method="post" enctype="multipart/form-data">
                                @csrf()
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger text-center">{{$error}}</p>
                                    @endforeach
                                @endif
                                <input type="hidden" name="_method" value="PUT">
                                <div class="home_img  text-center">
                                    <div class="home_img-inner">
                                        @if($user->image != null)
                                            <img src="{{asset($user->image)}}" alt="" width="200" height="200">
                                        @else
                                            <img src="{{asset('public/website/images/s.png')}}" alt="" width="150" height="150">
                                        @endif
                                    </div>
                                </div>
                                <div style="margin-top: 10px" class="home_data-item all-set col-sm-4 col-sm-offset-4">
                                    <input type="file" name="image" class="btn btn-block btn-default" value="حفظ التعديلات">
                                </div>
                                <!-- /.home_img -->
                                <div class="home-content">

                                    <div class="home_data col-md-10 col-sm-10 col-xs-12 text-right">
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-user-secret"></i>
                                                <h1>الإسم بالكامل</h1>
                                                <input type="text" name="name" value="{{$user->name}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-user"></i>
                                                <h1>إسم المستخدم</h1>
                                                <input type="text" name="user_name" value="{{$user->user_name}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-phone"></i>
                                                <h1>رقم الهاتف</h1>
                                                <input type="text" name="phone" value="{{$user->phone}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-envelope"></i>
                                                <h1>البريد الإلكتروني</h1>
                                                <input type="email" name="email" value="{{$user->email}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-globe"></i>
                                                <h1>الدولة</h1>
                                                @if($countries)
                                                <select name="country_id">
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}" @if($user->country->id == $country->id) selected @endif>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-male"></i>
                                                <h1>الجنس</h1>
                                                <select name="gender">
                                                    <option value="1" @if($user->gender == 1) selected @endif>مذكر</option>
                                                    <option value="0" @if($user->gender == 0) selected @endif>مؤنث</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div style="margin: 0" class="h1 home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div style="padding-right:1px" class="col-xs-4 pull-right">
                                                <h1 style="padding: 0"><i class="fa fa-user-secret fa-globe"></i>مدرب / متدرب</h1>
                                            </div>
                                            <div class="col-xs-4 pull-right">
                                                <input type="checkbox" class="text-left" name="coach" value="1"
                                                    @if($user->coach == 1)
                                                        checked
                                                    @endif
                                                >
                                                <span>مدرب</span>
                                            </div>
                                            <div class="col-xs-4 pull-left">
                                                <input type="checkbox" class="text-left" name="trainer" value="1"
                                                    @if($user->trainer == 1)
                                                        checked
                                                    @endif
                                                >
                                                <span>متدرب</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-graduation-cap"></i>
                                                <h1> المؤهل</h1>
                                                <input type="text" name="qualification" value="{{$user->qualification}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-cogs"></i>
                                                <h1>مجال العمل</h1>
                                                <input type="text" name="career" value="{{$user->career}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div style="margin-top: -55px" class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-briefcase"></i>
                                                <h1>التخصص</h1>
                                                <input type="text" name="specialize" value="{{$user->specialize}}">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                    </div>
                                    <!-- ./home_data -->
                                    <div class="home_data-item all-set col-md-12 col-sm-12  col-xs-12 pull-right">
                                        <input type="submit" class="btn btn-block btn-info" value="حفظ التعديلات"
                                               onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                        >
                                    </div>
                                </div>
                            </form>
                            <!-- /.home-content -->
                        </div>
                    </div>
                    <!-- /.tap-content -->
                </div>
                <!-- /.left_tap-box -->
            </div>
            <!-- /.left_tap-box -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.profile-content -->


@stop