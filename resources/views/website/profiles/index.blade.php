@extends('website.layouts.website')

@section('title')
    الصفحة الشخصية
@stop

@section('content')


    <div class="profile-content empty-course">
        <div class="col-sm-3 pull-right" style="margin-top: -20px; margin-bottom: 10px">
            <a href="{{route('payout.create')}}" class="btn btn-success btn-block">سحب مبلغ</a>
        </div>
        <div class="container">

            <div class="right_tap-box col-md-3 col-xs-12 hidden-xs hidden-sm pull-right">
                <div class="right_box-inner">
                    <!-- Nav tabs -->
                    <a class="toggle-slidenav hidden-xs hidden-sm">
                        <i class="fa fa-close"></i>
                    </a>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i> الملف الشخصي
                            </a>
                        </li>
                        <li>
                            <a href="{{route('password.edit', Auth::user()->slug)}}" aria-controls="password">
                                <i class="fa fa-lock"></i>تغيير كلمة المرور
                            </a>
                        </li>

                        <li role="presentation">
                            <a href="#interests" aria-controls="interests" role="tab" data-toggle="tab">
                                <i class="fa fa-diamond"></i> الاهتمامات
                            </a>
                        </li>
                        @if(Auth::user()->coach == 1)
                            <li role="presentation">
                                <a href="#cv" aria-controls="cv" role="tab" data-toggle="tab">
                                    <i class="fa fa-file-text-o"></i> السيرة الذاتية
                                </a>
                            </li>
                            {{--<li role="presentation">--}}
                            {{--<a href="#courses" aria-controls="courses" role="tab" data-toggle="tab">--}}
                            {{--<i class="fa fa-database"></i> الدورات--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            <li role="presentation">
                                <a href="#all-courses" aria-controls="all-courses" role="tab" data-toggle="tab">
                                    <i class="fa fa-eye"></i> تصفح دوراتي
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#my_courses" aria-controls="my_courses" role="tab" data-toggle="tab">
                                    <i class="fa fa-folder-open-o"></i> دوراتي كمتدرب
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#my_certf" aria-controls="my_certf" role="tab" data-toggle="tab">
                                    <i class="fa fa-table"></i> شهاداتي كمتدرب
                                </a>
                            </li>
                        @else
                            <li role="presentation">
                                <a href="#my_courses" aria-controls="my_courses" role="tab" data-toggle="tab">
                                    <i class="fa fa-folder-open-o"></i> الدورات المشترك فيها
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#my_certf" aria-controls="my_certf" role="tab" data-toggle="tab">
                                    <i class="fa fa-table"></i> شهاداتي
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
                <!-- /.right_box-inner -->
            </div>
            <!-- /.right_tap-box -->

            <div class="mobile_tap-box col-md-12 col-xs-12 hidden-lg text-center">
                <div class="right_box-inner">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab" title="الملف الشخصي">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('password.edit', Auth::user()->slug)}}" aria-controls="password"
                               title="تغيير كلمة المرور">
                                <i class="fa fa-lock"></i>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#interests" aria-controls="interests" role="tab" data-toggle="tab"
                               title="الاهتمامات">
                                <i class="fa fa-diamond"></i>
                            </a>
                        </li>
                        @if(Auth::user()->coach == 1)
                            <li role="presentation">
                                <a href="#cv" aria-controls="cv" role="tab" data-toggle="tab" title="السيرة الذاتية">
                                    <i class="fa fa-file-text-o"></i>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#all-courses" aria-controls="all-courses" role="tab" data-toggle="tab"
                                   title="تصفح دوراتي">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </li>

                            <li role="presentation">
                                <a href="#my_courses" aria-controls="my_courses" role="tab" data-toggle="tab"
                                   title="دوراتي كمتدرب">
                                    <i class="fa fa-folder-open-o"></i>
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#my_certf" aria-controls="my_certf" role="tab" data-toggle="tab"
                                   title="شهاداتي كمتدرب">
                                    <i class="fa fa-table"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /.right_box-inner -->
            </div>
            <!-- /.mobile_tap-box -->

            <div class="left_tap-box col-md-9 col-xs-12 pull-left">
                <div class="left_box-inner">
                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane fade in  active" id="home">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-user"></i>
                                    الملف الشخصي
                                    <a href="{{route('my_profile.edit', Auth::user()->slug)}}" class="edit-personal">
                                        <i class="fa fa-cog"></i>
                                        تعديل البيانات
                                    </a>
                                    {{--<a href="#" class="edit-personal">--}}
                                    {{--<i class="fa fa-cog"></i>--}}
                                    {{--تعديل البيانات--}}
                                    {{--</a>--}}
                                    <button class="cancel-personal" type="reset">
                                        <i class="fa fa-times"></i>
                                        إلغاء التعديل
                                    </button>
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <form action="{{route('my_profile.update', $user->slug)}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf()
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger text-center">{{$error}}</p>
                                    @endforeach
                                @endif
                                <div class="home_img  text-center">
                                    <div class="home_img-inner">
                                        <div class="left-caption col-xs-12">
                                            <div class="imgcontent col-xs-12">
                                                <div class="bstext">
                                                        <span>
                                              <i class="fa fa-camera"></i><br>
                                              Upload an image
                                          </span>
                                                </div>
                                                <!-- /.bstext -->
                                                <output id="list"></output>
                                                <input type="file" id="show-adj8" name="myFileSelect">
                                            </div>
                                            <!-- /.imgcontent -->
                                        </div>
                                        <!-- /.Fption -->
                                        @if(Auth::user()->image != null)
                                            <img src="{{asset(Auth::user()->image)}}" alt="" width="150" height="150">
                                        @else
                                            <img src="{{asset('public/website/images/s.png')}}" alt="" width="150"
                                                 height="150">
                                        @endif
                                    </div>
                                </div>
                                <!-- /.home_img -->
                                <div class="home-content">

                                    <div class="home_data col-md-10 col-sm-10 col-xs-12 text-right">
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-user-secret"></i>
                                                <h1>الإسم بالكامل</h1>
                                                <input type="text" name="name" id="edit-area" value="{{$user->name}}"
                                                       placeholder="الاسم بالكامل">
                                                <span>{{Auth::user()->name}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-user"></i>
                                                <h1>إسم المستخدم</h1>
                                                <input type="text" id="edit-area" name="user_name"
                                                       value="{{$user->user_name}}" placeholder="إسم المستخدم">
                                                <span>{{Auth::user()->user_name}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-phone"></i>
                                                <h1>رقم الهاتف</h1>
                                                <input type="email" id="edit-area" name="email" value="{{$user->email}}"
                                                       placeholder="رقم الهاتف">
                                                <span>{{Auth::user()->phone}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-envelope"></i>
                                                <h1>البريد الإلكتروني</h1>
                                                <input type="email" id="edit-area" placeholder="البريد الإلكتروني">
                                                <span>{{Auth::user()->email}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-globe"></i>
                                                <h1>الدولة</h1>
                                                @if($countries)
                                                    <select name="country_id" id="edit-area">
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}"
                                                                    @if($user->country->id == $country->id) selected @endif>{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <span>{{Auth::user()->country->name}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-male"></i>
                                                <h1>الجنس</h1>
                                                <select name="gender" id="edit-area">
                                                    <option value="1" @if($user->gender == 1) selected @endif>مذكر
                                                    </option>
                                                    <option value="0" @if($user->gender == 0) selected @endif>مؤنث
                                                    </option>
                                                </select>
                                                @if(Auth::user()->gender == 1)
                                                    <span>مذكر</span>
                                                @else
                                                    <span>مؤنث</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6 col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-globe"></i>
                                                <h1>مدرب / متدرب</h1>
                                                <div id="edit-area" class="edit-area">
                                                    <div class="col-xs-4 pull-right edit-area">
                                                        <input type="checkbox" class="text-left edit-area" name="coach"
                                                               value="1"
                                                               @if($user->coach == 1)
                                                               checked
                                                                @endif
                                                        >
                                                        <span>مدرب</span>
                                                    </div>
                                                    <div class="col-xs-4 pull-left">
                                                        <input type="checkbox" class="text-left edit-area"
                                                               name="trainer" value="1"
                                                               @if($user->trainer == 1)
                                                               checked
                                                                @endif
                                                        >
                                                        <span>متدرب</span>
                                                    </div>
                                                </div>

                                                @if(Auth::user()->coach == 1 && Auth::user()->trainer == 1)
                                                    <span>مدرب - متدرب</span>
                                                @elseif(Auth::user()->coach == 1 && Auth::user()->trainer == 0)
                                                    <span>مدرب</span>
                                                @elseif(Auth::user()->coach == 0 && Auth::user()->trainer == 1)
                                                    <span>متدرب</span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-graduation-cap"></i>
                                                <h1> المؤهل</h1>
                                                <input type="text" id="edit-area" name="qualification"
                                                       value="{{$user->qualification}}" placeholder="المؤهل">
                                                <span>{{Auth::user()->qualification}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-cogs"></i>
                                                <h1>مجال العمل</h1>
                                                <input type="text" id="edit-area" name="career"
                                                       value="{{$user->career}}" placeholder="مجال العمل">
                                                <span>{{Auth::user()->career}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->

                                        <div class="home_data-item all-set col-md-6 col-sm-6  col-xs-12 pull-right">
                                            <div>
                                                <i class="fa fa-briefcase"></i>
                                                <h1>التخصص</h1>
                                                <input type="text" id="edit-area" name="specialize"
                                                       value="{{$user->specialize}}" placeholder="التخصص">
                                                <span>{{Auth::user()->specialize}}</span>
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                    </div>
                                    <!-- ./home_data -->
                                    <div class="home_data-item all-set col-md-12 col-sm-12  col-xs-12 pull-right">
                                        <input type="submit" class="confirm-set" value="حفظ التعديلات">
                                    </div>
                                </div>
                                <!-- /.home-content -->
                            </form>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="password">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-lock"></i>
                                    كلمة المرور
                                </h1>
                                <a href="{{route('password.edit', Auth::user()->slug)}}" class="edit-password">
                                    <i class="fa fa-cog"></i> تعديل البيانات
                                </a>
                                {{--<button class="cancel-password" type="reset">--}}
                                {{--<i class="fa fa-times"></i> إلغاء التعديل--}}
                                {{--</button>--}}
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="home_data-item all-pass col-md-12  col-xs-12 pull-right">
                                        <div>
                                            <i class="fa fa-lock"></i>
                                            <h1>كلمة المرور القديمة</h1>
                                            <input type="text" id="edit-area">
                                            <span>......</span>

                                        </div>
                                    </div>
                                    <!-- /.home_data-item -->

                                    <div class="home_data-item all-pass col-md-12  col-xs-12 pull-right">
                                        <div>
                                            <i class="fa fa-unlock"></i>
                                            <h1>كلمة المرور الجديدة</h1>
                                            <input type="text" id="edit-area">
                                            <span>.........</span>
                                        </div>
                                    </div>
                                    <!-- /.home_data-item -->

                                    <div class="home_data-item all-pass col-md-12  col-xs-12 pull-right">
                                        <div>
                                            <i class="fa fa-lock"></i>
                                            <h1>إعادة كتابة كلمة المرور الجديدة</h1>
                                            <input type="text" id="edit-area">
                                            <span>............</span>
                                        </div>
                                    </div>
                                    <!-- /.home_data-item -->
                                    <div class="home_data-item all-pass col-md-12 col-sm-12  col-xs-12 pull-right">
                                        <input type="submit" value="حفظ التعديلات" class="confirm-set-password">
                                    </div>
                                    <!-- /.home_data-item -->
                                </div>
                                <!-- ./home_data -->
                            </div>
                            <!-- /.home-content -->
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="cv">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-file"></i>
                                    أضف ملف سيرتك الذاتية
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="home_data-item col-md-12  col-xs-12 pull-right">
                                        <div>
                                            <form class="cv-file" action="{{route('cv.update', Auth::user()->id)}}" method="post">
                                                @csrf()
                                                <input type="hidden" name="_method" value="PUT">

                                                <h1>أضف رابط خارجي لملف السيرة الذاتية</h1>
                                                <input type="text" class="form-control" style="border-color: gainsboro" placeholder="رابط خارجي" name="cv_url" value="{{Auth::user()->cv_url? Auth::user()->cv_url : ''}}">

                                                <h1>او يمكنك كتابتها بنفسك من خلال</h1>
                                                <textarea placeholder="اكتب سيرتك الذاتية" name="cv">{{Auth::user()->cv? Auth::user()->cv : ''}}</textarea>

                                                <input type="submit" value="حفظ">
                                                <a class="show-cv">عرض ملف السيرة الذاتية</a>
                                            </form>
                                        </div>
                                        <div class="cv-container text-center">
                                            <p>{{Auth::user()->cv? Auth::user()->cv : ''}}</p>
                                            @if(Auth::user()->cv_url != null)
                                            <a href="{{Auth::user()->cv_url}}">
                                                <i class="fa fa-cloud-download"></i> تحميل ملف السيرة الذاتية
                                            </a>
                                            @endif
                                        </div>
                                        <!-- /.cv-container -->
                                    </div>
                                    <!-- /.home_data-item -->
                                </div>
                                <!-- ./home_data -->
                            </div>
                            <!-- /.home-content -->
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="interests">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-diamond"></i>
                                    الاهتمامات
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="interest-show">
                                        <ul>
                                            @if(count($user->interests) > 0)
                                                @foreach($user->interests as $interest)
                                                    <li>
                                                        <span class="inter-item">{{$interest->name}}
                                                            <form action="{{route('deleteInterest', $interest->id)}}"
                                                                  method="get">
                                                                @csrf()
                                                                <button>
                                                                     <i class="fa fa-times" id="del-item"></i>
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            @else
                                                <p class="text-center">لا يوجد لديك إهتمامات</p>
                                            @endif
                                        </ul>
                                    </div>
                                    <!-- /.interest-show -->
                                    <div class="add-interest">
                                        <a>
                                            <i class="fa fa-plus"></i> أضف اهتمامات أخري
                                        </a>
                                    </div>
                                    <!-- /.add-interest -->
                                    <div class="home_data-item col-md-12  col-xs-12 pull-right">
                                        @if(count($interests) > 0)
                                            <form action="{{route('addInterests')}}" method="post">
                                                @csrf()
                                                <div class="interest-cont col-xs-12">
                                                    @foreach($interests as $interest)
                                                        <div class="interest-item col-md-4 col-sm-4 col-xs-6"
                                                                {{--@foreach($user->interests as $user_interest)--}}
                                                                {{--@if($interest->id == $user_interest->id)--}}
                                                                {{--style="display: none"--}}
                                                                {{--@endif--}}
                                                                {{--@endforeach--}}
                                                        >
                                                            <label>
                                                                <input type="checkbox" name="interests[]"
                                                                       value="{{$interest->id}}"
                                                                       @foreach($user->interests as $user_interest)
                                                                       @if($interest->id == $user_interest->id)
                                                                       disabled checked
                                                                        @endif
                                                                        @endforeach
                                                                >
                                                                <span>{{$interest->name}}</span>
                                                            </label>
                                                        </div>
                                                        <!-- /.interest-item -->
                                                    @endforeach
                                                </div>
                                                <!-- /.interest-cont -->
                                                <div class="interst-gender col-xs-12">
                                                    <div class="cv-file text-left">
                                                        <input type="submit" value="حفظ">
                                                    </div>
                                                </div>
                                                <!-- /.interest-gender -->
                                            </form>
                                        @else
                                            <p class="text-center">عفوا لايوجد إهتمامات لدى الموقع حتى الان</p>
                                        @endif
                                    </div>
                                    <!-- /.home_data-item -->
                                </div>
                                <!-- ./home_data -->
                            </div>
                            <!-- /.home-content -->
                        </div>

                        {{--تصفح دوراتى (دورات المدرب)--}}
                        <div role="tabpanel" class="tab-pane fade" id="all-courses">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-folder-open-o"></i>
                                    دوراتى
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="my_courses-container">
                                        <div>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#currentmy" aria-controls="current" role="tab" data-toggle="tab">
                                                        الدورات الحالية
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#commingmy" aria-controls="current" role="tab" data-toggle="tab">
                                                        الدورات القادمة
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#finishedmy" aria-controls="comming" role="tab" data-toggle="tab">
                                                        الدورات المنتهية
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="currentmy">
                                                    <div class="type col-xs-12">
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                @if($course->completed == 0 && $course->published == 1)
                                                                    @if($course->coach->id == Auth::user()->id)
                                                                        <div class="card col-md-6 col-xs-12 pull-right">
                                                                            <div class="card-inner">
                                                                                <span class="corse-type">{{$course->category->name}}</span>
                                                                                <div class="card-img">
                                                                                    @if($course->cover != null)
                                                                                        <img src="{{asset($course->cover)}}" alt="" class="img-responsive">
                                                                                    @else
                                                                                        <img src="{{asset('public/website/images/bg-4.jpg')}}" alt="" class="img-responsive">
                                                                                    @endif
                                                                                    <div class="lessons-number text-center">
                                                                                        <h1>
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                            {{count($course->lectures)}}
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.lessons-number -->
                                                                                </div>
                                                                                <!-- /.card-img -->
                                                                                <div class="card-data">
                                                                                    <div class="course_name text-right">
                                                                                        <h1>
                                                                                            <a href="#">{{$course->name}}</a>
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.course-name -->
                                                                                    <div class="course_setting text-right">
                                                                                        <span class="course_date">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                            من: {{$course->start_at? $course->start_at : 'لم يحدد'}} إلى: {{$course->finish_at? $course->finish_at : 'لم يحدد'}}
                                                                                        </span>
                                                                                    </div>
                                                                                    <!-- /.course_setting -->
                                                                                    <div class="course_instructor-data">
                                                                                        <span>
                                                                                            @if($course->coach)
                                                                                                @if($course->coach->image != null)
                                                                                                    <img src="{{asset($course->coach->image)}}" width="70" height="70" class="img-responsive">
                                                                                                @else
                                                                                                    <img src="{{asset('public/website/images/s.png')}}" width="70" height="70" class="img-responsive">
                                                                                                @endif
                                                                                            @endif
                                                                                        </span>
                                                                                        <a href="#">
                                                                                            <i class="fa fa-user"></i>{{$course->coach? $course->coach->name : App\Setting::first()->site_name}}
                                                                                        </a>
                                                                                    </div>
                                                                                    <!-- /.course_instructor-data -->
                                                                                    <div class="corse-action">
                                                                                        <a href="{{route('courses.show', $course->slug)}}" class="gonna-corse">
                                                                                            <i class="fa fa-paper-plane"></i> إذهب الي
                                                                                            الدورة
                                                                                        </a>
                                                                                        <a href="#" class="out-corse" title="حذف الكورس"
                                                                                           onclick="
                                                                                                   var result = confirm('هل أنت متأكد من حذف هذه الدورة؟');
                                                                                                   if(result)
                                                                                                   {
                                                                                                   event.preventDefault();
                                                                                                   document.getElementById('delete-form-{{ $course->id }}').submit();
                                                                                                   }
                                                                                                   "
                                                                                        >
                                                                                            <i class="fa fa-trash"></i>   حذف الدورة
                                                                                        </a>
                                                                                        <form id="delete-form-{{ $course->id }}" action="{{route('courses.destroy', $course->id)}}" method="POST">
                                                                                            @csrf()
                                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.corse-action -->
                                                                                </div>
                                                                                <!-- /.card-data -->
                                                                            </div>
                                                                            <!-- /.card-inner -->
                                                                        </div>
                                                                        <!-- /.card -->
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.type -->
                                                </div>

                                                <div role="tabpanel" class="tab-pane fade in active" id="commingmy">
                                                    <div class="type col-xs-12">
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                @if($course->published == 0)
                                                                    @if($course->coach->id == Auth::user()->id)
                                                                        <div class="card col-md-6 col-xs-12 pull-right">
                                                                            <div class="card-inner">
                                                                                <span class="corse-type">{{$course->category->name}}</span>
                                                                                <div class="card-img">
                                                                                    @if($course->cover != null)
                                                                                        <img src="{{asset($course->cover)}}" alt="" class="img-responsive">
                                                                                    @else
                                                                                        <img src="{{asset('public/website/images/bg-4.jpg')}}" alt="" class="img-responsive">
                                                                                    @endif
                                                                                    <div class="lessons-number text-center">
                                                                                        <h1>
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                            {{count($course->lectures)}}
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.lessons-number -->
                                                                                </div>
                                                                                <!-- /.card-img -->
                                                                                <div class="card-data">
                                                                                    <div class="course_name text-right">
                                                                                        <h1>
                                                                                            <a href="#">{{$course->name}}</a>
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.course-name -->
                                                                                    <div class="course_setting text-right">
                                                                                        <span class="course_date">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                            من: {{$course->start_at? $course->start_at : 'لم يحدد'}} إلى: {{$course->finish_at? $course->finish_at : 'لم يحدد'}}
                                                                                        </span>
                                                                                    </div>
                                                                                    <!-- /.course_setting -->
                                                                                    <div class="course_instructor-data">
                                                                                        <span>
                                                                                            @if($course->coach)
                                                                                                @if($course->coach->image != null)
                                                                                                    <img src="{{asset($course->coach->image)}}" width="70" height="70" class="img-responsive">
                                                                                                @else
                                                                                                    <img src="{{asset('public/website/images/s.png')}}" width="70" height="70" class="img-responsive">
                                                                                                @endif
                                                                                            @endif
                                                                                        </span>
                                                                                        <a href="#">
                                                                                            <i class="fa fa-user"></i>{{$course->coach? $course->coach->name : App\Setting::first()->site_name}}
                                                                                        </a>
                                                                                    </div>
                                                                                    <!-- /.course_instructor-data -->
                                                                                    <div class="corse-action">
                                                                                        <a href="{{route('courses.show', $course->slug)}}" class="gonna-corse">
                                                                                            <i class="fa fa-paper-plane"></i> إذهب الي
                                                                                            الدورة
                                                                                        </a>
                                                                                        <a href="#" class="out-corse" title="حذف الكورس"
                                                                                           onclick="
                                                                                                   var result = confirm('هل أنت متأكد من حذف هذه الدورة؟');
                                                                                                   if(result)
                                                                                                   {
                                                                                                   event.preventDefault();
                                                                                                   document.getElementById('delete-form-{{ $course->id }}').submit();
                                                                                                   }
                                                                                                   "
                                                                                        >
                                                                                            <i class="fa fa-trash"></i>   حذف الدورة
                                                                                        </a>
                                                                                        <form id="delete-form-{{ $course->id }}" action="{{route('courses.destroy', $course->id)}}" method="POST">
                                                                                            @csrf()
                                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.corse-action -->
                                                                                </div>
                                                                                <!-- /.card-data -->
                                                                            </div>
                                                                            <!-- /.card-inner -->
                                                                        </div>
                                                                        <!-- /.card -->
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.type -->
                                                </div>

                                                <div role="tabpanel" class="tab-pane fade in active" id="finishedmy">
                                                    <div class="type col-xs-12">
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                @if($course->completed == 1 && $course->published == 1)
                                                                    @if($course->coach->id == Auth::user()->id)
                                                                        <div class="card col-md-6 col-xs-12 pull-right">
                                                                            <div class="card-inner">
                                                                                <span class="corse-type">{{$course->category->name}}</span>
                                                                                <div class="card-img">
                                                                                    @if($course->cover != null)
                                                                                        <img src="{{asset($course->cover)}}" alt="" class="img-responsive">
                                                                                    @else
                                                                                        <img src="{{asset('public/website/images/bg-4.jpg')}}" alt="" class="img-responsive">
                                                                                    @endif
                                                                                    <div class="lessons-number text-center">
                                                                                        <h1>
                                                                                            <i class="fa fa-play-circle"></i>
                                                                                            {{count($course->lectures)}}
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.lessons-number -->
                                                                                </div>
                                                                                <!-- /.card-img -->
                                                                                <div class="card-data">
                                                                                    <div class="course_name text-right">
                                                                                        <h1>
                                                                                            <a href="#">{{$course->name}}</a>
                                                                                        </h1>
                                                                                    </div>
                                                                                    <!-- /.course-name -->
                                                                                    <div class="course_setting text-right">
                                                                                        <span class="course_date">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                            من: {{$course->start_at? $course->start_at : 'لم يحدد'}} إلى: {{$course->finish_at? $course->finish_at : 'لم يحدد'}}
                                                                                        </span>
                                                                                    </div>
                                                                                    <!-- /.course_setting -->
                                                                                    <div class="course_instructor-data">
                                                                                        <span>
                                                                                            @if($course->coach)
                                                                                                @if($course->coach->image != null)
                                                                                                    <img src="{{asset($course->coach->image)}}" width="70" height="70" class="img-responsive">
                                                                                                @else
                                                                                                    <img src="{{asset('public/website/images/s.png')}}" width="70" height="70" class="img-responsive">
                                                                                                @endif
                                                                                            @endif
                                                                                        </span>
                                                                                        <a href="#">
                                                                                            <i class="fa fa-user"></i>{{$course->coach? $course->coach->name : App\Setting::first()->site_name}}
                                                                                        </a>
                                                                                    </div>
                                                                                    <!-- /.course_instructor-data -->
                                                                                    <div class="corse-action">
                                                                                        <a href="{{route('courses.show', $course->slug)}}" class="gonna-corse">
                                                                                            <i class="fa fa-paper-plane"></i> إذهب الي
                                                                                            الدورة
                                                                                        </a>
                                                                                        <a href="#" class="out-corse" title="حذف الكورس"
                                                                                           onclick="
                                                                                                   var result = confirm('هل أنت متأكد من حذف هذه الدورة؟');
                                                                                                   if(result)
                                                                                                   {
                                                                                                   event.preventDefault();
                                                                                                   document.getElementById('delete-form-{{ $course->id }}').submit();
                                                                                                   }
                                                                                                   "
                                                                                        >
                                                                                            <i class="fa fa-trash"></i>   حذف الدورة
                                                                                        </a>
                                                                                        <form id="delete-form-{{ $course->id }}" action="{{route('courses.destroy', $course->id)}}" method="POST">
                                                                                            @csrf()
                                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                                        </form>
                                                                                    </div>
                                                                                    <!-- /.corse-action -->
                                                                                </div>
                                                                                <!-- /.card-data -->
                                                                            </div>
                                                                            <!-- /.card-inner -->
                                                                        </div>
                                                                        <!-- /.card -->
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.type -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.my_courses-container -->
                                </div>
                                <!-- ./home_data -->
                            </div>
                            <!-- /.home-content -->
                        </div>


                        {{--دوراتى كمتدرب (للمدرب)--}}
                        {{--الدورات المشترك فيها (للمتدرب)--}}
                        <div role="tabpanel" class="tab-pane fade" id="my_courses">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-folder-open-o"></i>
                                    الدورات المشترك فيها
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="my_courses-container">
                                        <div>

                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li role="presentation" class="active">
                                                    <a href="#current" aria-controls="comming" role="tab" data-toggle="tab">
                                                        الدورات الحالية
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#finished" aria-controls="comming" role="tab" data-toggle="tab">
                                                        الدورات المنتهية
                                                    </a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade in active" id="current">
                                                    <div class="type col-xs-12">
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                @if($course->completed == 0)
                                                                    @if(count($course->trainers) > 0)
                                                                        @foreach($course->trainers as $trainer)
                                                                            @if($trainer->id == Auth::user()->id)
                                                                            <div class="card col-md-6 col-xs-12 pull-right">
                                                                                <div class="card-inner">
                                                                                    <span class="corse-type">{{$course->category->name}}</span>
                                                                                    <div class="card-img">
                                                                                        @if($course->cover != null)
                                                                                            <img src="{{asset($course->cover)}}" alt="" class="img-responsive">
                                                                                        @else
                                                                                            <img src="{{asset('public/website/images/bg-4.jpg')}}" alt="" class="img-responsive">
                                                                                        @endif
                                                                                        <div class="lessons-number text-center">
                                                                                            <h1>
                                                                                                <i class="fa fa-play-circle"></i>
                                                                                                {{count($course->lectures)}}
                                                                                            </h1>
                                                                                        </div>
                                                                                        <!-- /.lessons-number -->
                                                                                    </div>
                                                                                    <!-- /.card-img -->
                                                                                    <div class="card-data">
                                                                                        <div class="course_name text-right">
                                                                                            <h1>
                                                                                                <a href="#">{{$course->name}}</a>
                                                                                            </h1>
                                                                                        </div>
                                                                                        <!-- /.course-name -->
                                                                                        <div class="course_setting text-right">
                                                                                                <span class="course_date">
                                                                                                    <i class="fa fa-calendar"></i>
                                                                                                    من: {{$course->start_at? $course->start_at : 'لم يحدد'}} إلى: {{$course->finish_at? $course->finish_at : 'لم يحدد'}}
                                                                                                </span>
                                                                                        </div>
                                                                                        <!-- /.course_setting -->
                                                                                        <div class="course_instructor-data">
                                                                                                <span>
                                                                                                    @if($course->coach)
                                                                                                        @if($course->coach->image != null)
                                                                                                            <img src="{{asset($course->coach->image)}}" width="70" height="70" class="img-responsive">
                                                                                                        @else
                                                                                                            <img src="{{asset('public/website/images/s.png')}}" width="70" height="70" class="img-responsive">
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </span>
                                                                                            <a href="#">
                                                                                                <i class="fa fa-user"></i>{{$course->coach? $course->coach->name : App\Setting::first()->site_name}}
                                                                                            </a>
                                                                                        </div>
                                                                                        <!-- /.course_instructor-data -->
                                                                                        <div class="corse-action">
                                                                                            <a href="{{route('courses.show', $course->slug)}}" class="gonna-corse">
                                                                                                <i class="fa fa-paper-plane"></i> إذهب الي
                                                                                                الدورة
                                                                                            </a>

                                                                                            <a href="#" class="out-corse" title="إنسحاب من الدورة"
                                                                                               onclick="
                                                                                                       var result = confirm('هل أنت متأكد من الإنسحاب من الدورة؟');
                                                                                                       if(result)
                                                                                                       {
                                                                                                       event.preventDefault();
                                                                                                       document.getElementById('out-current-form-{{ $course->id }}').submit();
                                                                                                       }
                                                                                                       "
                                                                                            >
                                                                                                <i class="fa fa-sign-out"></i>  إنسحاب من الدورة
                                                                                            </a>
                                                                                            <form id="out-current-form-{{ $course->id }}" action="{{route('courses.out', $course->id)}}" method="get">
                                                                                                @csrf()
                                                                                                {{--<input type="hidden" name="_method" value="DELETE">--}}
                                                                                            </form>
                                                                                        </div>
                                                                                        <!-- /.corse-action -->
                                                                                    </div>
                                                                                    <!-- /.card-data -->

                                                                                </div>
                                                                                <!-- /.card-inner -->
                                                                            </div>
                                                                            <!-- /.card -->
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.type -->
                                                </div>

                                                <div role="tabpane" class="tab-pane fade in active" id="finished">
                                                    <div class="type col-xs-12">
                                                        @if(count($courses) > 0)
                                                            @foreach($courses as $course)
                                                                @if($course->completed == 1)
                                                                    @if(count($course->trainers) > 0)
                                                                        @foreach($course->trainers as $trainer)
                                                                            @if($trainer->id == Auth::user()->id)
                                                                            <div class="card col-md-6 col-xs-12 pull-right">
                                                                                <div class="card-inner">
                                                                                    <span class="corse-type">{{$course->category->name}}</span>
                                                                                    <div class="card-img">
                                                                                        @if($course->cover != null)
                                                                                            <img src="{{asset($course->cover)}}" alt="" class="img-responsive">
                                                                                        @else
                                                                                            <img src="{{asset('public/website/images/bg-4.jpg')}}" alt="" class="img-responsive">
                                                                                        @endif
                                                                                        <div class="lessons-number text-center">
                                                                                            <h1>
                                                                                                <i class="fa fa-play-circle"></i>
                                                                                                {{count($course->lectures)}}
                                                                                            </h1>
                                                                                        </div>
                                                                                        <!-- /.lessons-number -->
                                                                                    </div>
                                                                                    <!-- /.card-img -->
                                                                                    <div class="card-data">
                                                                                        <div class="course_name text-right">
                                                                                            <h1>
                                                                                                <a href="#">{{$course->name}}</a>
                                                                                            </h1>
                                                                                        </div>
                                                                                        <!-- /.course-name -->
                                                                                        <div class="course_setting text-right">
                                                                                                <span class="course_date">
                                                                                                    <i class="fa fa-calendar"></i>
                                                                                                    من: {{$course->start_at? $course->start_at : 'لم يحدد'}} إلى: {{$course->finish_at? $course->finish_at : 'لم يحدد'}}
                                                                                                </span>
                                                                                        </div>
                                                                                        <!-- /.course_setting -->
                                                                                        <div class="course_instructor-data">
                                                                                                <span>
                                                                                                    @if($course->coach)
                                                                                                        @if($course->coach->image != null)
                                                                                                            <img src="{{asset($course->coach->image)}}" width="70" height="70" class="img-responsive">
                                                                                                        @else
                                                                                                            <img src="{{asset('public/website/images/s.png')}}" width="70" height="70" class="img-responsive">
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </span>
                                                                                            <a href="#">
                                                                                                <i class="fa fa-user"></i>{{$course->coach? $course->coach->name : App\Setting::first()->site_name}}
                                                                                            </a>
                                                                                        </div>
                                                                                        <!-- /.course_instructor-data -->
                                                                                        <div class="corse-action">
                                                                                            <a href="{{route('courses.show', $course->slug)}}" class="gonna-corse">
                                                                                                <i class="fa fa-paper-plane"></i> إذهب الي
                                                                                                الدورة
                                                                                            </a>
                                                                                            <a href="#" class="out-corse" title="إنسحاب من الدورة"
                                                                                               onclick="
                                                                                                       var result = confirm('هل أنت متأكد من الإنسحاب من الدورة؟');
                                                                                                       if(result)
                                                                                                       {
                                                                                                       event.preventDefault();
                                                                                                       document.getElementById('out-finished-form-{{ $course->id }}').submit();
                                                                                                       }
                                                                                                       "
                                                                                            >
                                                                                                <i class="fa fa-sign-out"></i>  إنسحاب من الدورة
                                                                                            </a>
                                                                                            <form id="out-finished-form-{{ $course->id }}" action="{{route('courses.out', $course->id)}}" method="get">
                                                                                                @csrf()
                                                                                                {{--<input type="hidden" name="_method" value="DELETE">--}}
                                                                                            </form>
                                                                                        </div>
                                                                                        <!-- /.corse-action -->
                                                                                    </div>
                                                                                    <!-- /.card-data -->

                                                                                </div>
                                                                                <!-- /.card-inner -->
                                                                            </div>
                                                                            <!-- /.card -->
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @else
                                                                    {{--<div role="tabpanel" class="tab-pane fade" id="finishedmy">--}}
                                                                        {{--<div class="flash_empty text-center">--}}
                                                                            {{--<h1 class="animated shake">--}}
                                                                                {{--<i class="fa fa-frown-o"></i>--}}
                                                                                {{--عفواً لا يوجد دورات منتهية--}}
                                                                            {{--</h1>--}}
                                                                        {{--</div>--}}
                                                                        {{--<!-- /.flash_empty -->--}}
                                                                    {{--</div>--}}
                                                                    {{--<!-- /#finishedmy -->--}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <!-- /.type -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /.my_courses-container -->
                                </div>
                                <!-- ./home_data -->
                            </div>
                            <!-- /.home-content -->
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="my_certf">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-file"></i>
                                    الشهادات التي حصلت عليها من انهاء الدورات
                                </h1>
                            </div>
                            <!-- /.home-head -->
                            <div class="home-content pass-content col-xs-12">
                                <div class="home_data col-xs-12 pull-right text-right">
                                    <div class="home_data-item col-md-12  col-xs-12 pull-right">
                                        <div class="my-sertf">
                                            <ul>
                                                @if($courses)
                                                    @foreach($courses as $course)
                                                        @foreach($course->trainers as $trainer)
                                                            @if($trainer->id == Auth::user()->id)
                                                                {{--@if() --}}  {{--لو المتدرب خلص الدورة بالاختبار--}}
                                                                    @if($course->certificate != null)
                                                                        <li>
                                                                            <h1>
                                                                                <i class="fa fa-file"></i>
                                                                                {{$course->certificate->cer_name}}
                                                                            </h1>
                                                                            <a href="{{route('certificates.show', $course->certificate->slug)}}">
                                                                                <i class="fa fa-paper-plane"></i>عرض الشهادة
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                {{--@endif--}}
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                               @endif
                                            </ul>
                                        </div>
                                        <!-- end my-certf -->
                                    </div>
                                    <!-- /.home_data-item -->
                                </div>
                                <!-- ./home_data -->
                            </div>
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

    <div class="courses">
        <div class="container">
            @if(Auth::user()->coach == 1)
                <div class="courses-head text-center">
                    <h1>دوراتي للطالب</h1>
                </div>
                <!-- /.testominal-head -->
                <div class="row block-container">
                    @if($courses)
                        @foreach($courses as $course)
                            @if($course->coach_id == Auth::user()->id)
                                <div class="block col-md-4">
                                    <figure>
                                        <div>
                                            @if($course->cover != null)
                                                <img src="{{asset($course->cover)}}" alt="img05" class="img-responsive">
                                            @else
                                                <img src="{{asset('public/website/images/b3.jpg')}}" alt="img05"
                                                     class="img-responsive">
                                            @endif
                                        </div>
                                        <figcaption class="text-right">
                                            <h1>
                                                <label>اسم الكورس</label>
                                                <span>{{$course->name}}</span>
                                            </h1>
                                            <h1>
                                                <label>القسم</label>
                                                <span>{{$course->category->name}}</span>
                                            </h1>
                                            <h1>
                                                <label>المدرب</label>
                                                <span>{{$course->coach->name}}</span>
                                            </h1>
                                            <h1>
                                                <label>عدد الطلبة المشتركة</label>
                                                <span>{{count($course->trainers)}}</span>
                                            </h1>
                                            <h1>
                                                <label>تاريخ بداية الكورس</label>
                                                <span>{{$course->start_at? $course->start_at : 'لم يحدد بعد'}}</span>
                                            </h1>
                                            <h1>
                                                <label>تقييم الكورس</label>
                                                <span>جيد</span>
                                            </h1>
                                            <a href="{{route('courses.show', $course->slug)}}">
                                                <i class="fa fa-eye"></i> مشاهدة الكورس
                                            </a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <!-- /.block -->
                            @endif
                        @endforeach
                    @endif

                </div>
                <!-- /.row -->
            @endif


            @if(Auth::user()->trainer == 1)
                <div class="courses-head text-center">
                    <h1>الدورات المشترك فيها</h1>
                </div>
                <!-- /.testominal-head -->
                <div class="row block-container">
                    @if($courses)
                        @foreach($courses as $course)
                            @foreach($course->trainers as $trainer)
                                @if($trainer->id == Auth::user()->id)
                                    <div class="block col-md-4">
                                        <figure>
                                            <div>
                                                @if($course->cover != null)
                                                    <img src="{{asset($course->cover)}}" alt="img05"
                                                         class="img-responsive">
                                                @else
                                                    <img src="{{asset('public/website/images/b3.jpg')}}" alt="img05"
                                                         class="img-responsive">
                                                @endif
                                            </div>
                                            <figcaption class="text-right">
                                                <h1>
                                                    <label>اسم الكورس</label>
                                                    <span>{{$course->name}}</span>
                                                </h1>
                                                <h1>
                                                    <label>القسم</label>
                                                    <span>{{$course->category->name}}</span>
                                                </h1>
                                                <h1>
                                                    <label>المدرب</label>
                                                    <span>{{$course->coach->name}}</span>
                                                </h1>
                                                <h1>
                                                    <label>عدد الطلبة المشتركة</label>
                                                    <span>{{count($course->trainers)}}</span>
                                                </h1>
                                                <h1>
                                                    <label>تاريخ بداية الكورس</label>
                                                    <span>{{$course->start_at? $course->start_at : 'لم يحدد بعد'}}</span>
                                                </h1>
                                                <h1>
                                                    <label>تقييم الكورس</label>
                                                    <span>جيد</span>
                                                </h1>
                                                <a href="{{route('courses.show', $course->slug)}}">
                                                    <i class="fa fa-eye"></i> مشاهدة الكورس
                                                </a>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <!-- /.block -->
                                @endif
                            @endforeach
                        @endforeach
                    @endif

                </div>
                <!-- /.row -->
            @endif

            <div class="all-courses text-center">
                <a href="{{route('courses.index')}}">عرض جميع الكورسات</a>

            </div>
            <!-- /.all-courses -->

        </div>
        <!-- /.conainer -->
    </div>
    <!-- /.courses -->


@stop