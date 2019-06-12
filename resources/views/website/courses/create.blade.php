@extends('website.layouts.website')

@section('title')
    إضافة دورة
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>إضافة دورة جديدة</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">
                    <div class="add_lecture in-one">
                        <form action="{{route('courses.store')}}" method="post" class="add-form" enctype="multipart/form-data">
                        @csrf()
                        @if(count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger text-center">{{$error}}</p>
                            @endforeach
                        @endif
                        <div class="up_form-item">
                            <h1>عنوان الدورة</h1>
                            <input type="text" name="name" placeholder="اضف عنوان الدورة">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <h1>متطلب سابق</h1>
                            <input type="text" name="needs" placeholder="اضف المتطلبات">
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <h1>القسم</h1>
                            @if($categories)
                            <select name="category_id">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="lecture-item text-right">
                            <div class="fileUpload col-xs-12 text-right">
                                <span><i class="fa fa-image"></i> إضافة صورة غلاف </span>
                                <input type="file" name="cover" class="upload">
                            </div>
                        </div>
                        <!-- /.lecture-item -->
                        <hr>
                        <div class="up_form-item">
                            <h1>رابط فيديو</h1>
                            <div class="add_cont text-right">
                                <div class="lecture-item">
                                    <div class="add_cont text-right">
                                        <label class="text-right">
                                            <input type="checkbox" name="check" value="1" id="up-video">
                                            <span>اذا أردت رفع فيديو من جهازك الشخصي</span>
                                        </label>

                                        <div class="videoUploaded col-xs-12 text-right">
                                            <span><i class="fa fa-video-camera"></i> ارفع فيديو من جهازك</span>
                                            <input type="file" name="video" class="uploaded">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.lecture-item -->
                            </div>
                            <input type="text" name="video_link" placeholder="ادخل رابط فيديو" class="linked">

                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <h1>وصف الدورة</h1>
                            <textarea name="description" placeholder="اضف وصف الدورة"></textarea>
                        </div>
                        <!-- /.up_form-item -->
                        <div class="up_form-item">
                            <h1>الجنس المتوقع</h1>
                            <div class="add_cont text-right">
                                <label class="text-right">
                                    <input name="male" value="1" type="checkbox">
                                    <span>ذكور</span>
                                </label>
                                <label class="text-right">
                                    <input name="female" value="1" type="checkbox">
                                    <span>إناث</span>
                                </label>
                            </div>
                        </div>

                        <div class="up_form-item">
                            <h1>نوع الدورة</h1>
                            <div class="add_cont text-right">
                                <label class="text-right">
                                    <input type="radio" name="status" value="1">
                                    <span>مدفوع</span>
                                </label>
                                <label class="text-right">
                                    <input type="radio" name="status" value="0">
                                    <span>مجاني</span>
                                </label>

                                <input type="number" name="price" data-toggle="tooltip" data-placement="top" title="اضف سعر الدورة">
                            </div>
                        </div>
                        <!-- /.up_form-item -->

                        {{--<div class="up_form-item">--}}
                            {{--<a class="add-cert">اضافة شهادة للدورة</a>--}}
                            {{--<div class="course-cert">--}}
                                {{--<div class="up_form-item">--}}
                                    {{--<h1>إسم الشهادة</h1>--}}
                                    {{--<input type="text" name="cer_name" placeholder="اضف اسم الشهادة">--}}
                                {{--</div>--}}
                                {{--<!-- /.up_form-item -->--}}
                                {{--<div class="up_form-item">--}}
                                    {{--<h1>الجهة المانحة</h1>--}}
                                    {{--<input type="text" name="cer_owner" placeholder="اضف الجهة المانحة">--}}
                                {{--</div>--}}
                                {{--<!-- /.up_form-item -->--}}
                                {{--<div class="up_form-item">--}}
                                    {{--<h1>تكلفة الشهادة</h1>--}}
                                    {{--<div class="add_cont text-right">--}}
                                        {{--<label class="text-right">--}}
                                            {{--<input type="radio" name="cer_status" value="1">--}}
                                            {{--<span>مدفوع</span>--}}
                                        {{--</label>--}}
                                        {{--<label class="text-right">--}}
                                            {{--<input type="radio" name="cer_status" value="0">--}}
                                            {{--<span>مجاني</span>--}}
                                        {{--</label>--}}
                                        {{--<input type="number" name="cer_price" data-toggle="tooltip" data-placement="top" title="اضف سعر الشهادة">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<!-- /.up_form-item -->--}}
                            {{--</div>--}}
                            {{--<!-- /.course-cert -->--}}
                        {{--</div>--}}
                        <!-- /.up_form-item -->

                        <div class="up_form-item up-confirm">
                            <input type="submit" value="اضافة الدورة"
                                   onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                            >
                        </div>
                        <!-- /.up_form-item -->
                    </form>
                    </div>
                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop

