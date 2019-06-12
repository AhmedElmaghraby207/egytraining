@extends('website.layouts.website')

@section('title')
    تسجيل عضوية جديدة
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>يرجي تسجيل حساب جديد</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">

                    <form action="{{route('register')}}" method="post">
                        @csrf()
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="up_form-item">
                            <span id="error-form">من فضلك ادخل البيانات الصحيحة</span>
                            <input type="text" name="name" required placeholder="الإسم بالكامل">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="user_name" required placeholder="إسم المستخدم">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="email" name="email" required placeholder="البريد الإلكتروني">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="password" name="password" required placeholder="كلمة المرور">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="password" name="password_confirmation" required placeholder="إعادة كلمة المرور">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="phone"required placeholder="رقم الهاتف">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="qualification" placeholder="المؤهل">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="career" placeholder="مجال العمل">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="specialize" placeholder="التخصص">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <input type="text" name="about" placeholder="عنى">
                        </div>
                        <!-- /.up_form-item -->
                        <hr>
                        <div class="up_form-item">
                            <h1>:الدولة</h1>
                            <select name="country_id">
                                @if($countries)
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- /.up_form-item -->
                        <hr>
                        <div class="up_form-item text-right">
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
                        <!-- /.up_form-item -->
                        <hr>
                        <div class="up_form-item">
                            <h1>:الجنس</h1>
                            <select name="gender">
                                <option value="1">مذكر</option>
                                <option value="0">مؤنث</option>
                            </select>
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item text-right">
                            <label>
                                <input type="checkbox" name="coach" value="1">
                                <span>مدرب</span>
                                <a href="#" class="show-privacy">تعرف علي سياسة الخصوصية كمدرب</a>
                            </label>
                            <label>
                                <input type="checkbox" name="trainer" value="1">
                                <span>متدرب</span>
                                <a href="#" class="show-privacy">تعرف علي سياسة الخصوصية كمتدرب</a>
                            </label>
                        </div>
                        <!-- /.up_form-item -->

                        <div class="policy text-right">
                            <label class="text-right policy">
                                <input type="checkbox" required>
                                <span>هل انت موافق علي سياسة الخصوصية</span>
                            </label>
                        </div>
                        <!-- /.policy -->

                        <div class="up_form-item up-confirm">
                            <input type="submit" value="تسجيل">
                        </div>
                        <!-- /.up_form-item -->
                    </form>

                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop



@section('models')

    <div class="panel-pop modal" id="trainer-modal">
        <div class="lost-inner">
            <h1>
                <i class="fa fa-cube"></i> تعرف علي سياسة الخصوصية
            </h1>
            <div class="lost-item">
                <p>
                    سياسة الخصوصية كمتدرب سياسة الخصوصية كمتدرب سياسة الخصوصية كمتدرب
                </p>
            </div>
        </div>
    </div>
    <!-- /.modal -->

@stop
