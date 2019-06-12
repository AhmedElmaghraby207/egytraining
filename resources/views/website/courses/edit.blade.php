@extends('website.layouts.website')

@section('title')
    تعديل الدورة
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>{{$course->name}} تعديل دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">
                    <div class="add_lecture in-one">
                        <form action="{{route('courses.update', $course->id)}}" method="post" class="add-form" enctype="multipart/form-data">
                            @csrf()
                            <input type="hidden" name="_method" value="put">
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <div class="up_form-item">
                                <h1>عنوان الدورة</h1>
                                <input type="text" name="name" value="{{$course->name}}" placeholder="اضف عنوان الدورة">
                            </div>
                            <!-- /.up_form-item -->
                            <div class="up_form-item">
                                <h1>متطلب سابق</h1>
                                <input type="text" name="needs" value="{{$course->needs}}" placeholder="اضف المتطلبات">
                            </div>
                            <!-- /.up_form-item -->
                            <div class="up_form-item">
                                <h1>القسم</h1>
                                @if($categories)
                                    <select name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                @if($course->category->id == $category->id)
                                                    selected
                                                @endif
                                            >{{$category->name}}</option>
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
                                                <input type="checkbox" id="up-video">
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
                                <input type="text" name="video_link" value="{{$course->video_link}}" placeholder="ادخل رابط فيديو" class="linked">

                            </div>
                            <!-- /.up_form-item -->
                            <div class="up_form-item">
                                <h1>تاريخ بداية الدورة</h1>
                                <input type="text" name="start_at" class="datepicker" value="{{$course->start_at}}" placeholder="اضف تاريخ بداية الدورة">
                            </div>
                            <div class="up_form-item">
                                <h1>تاريخ انتهاء الدورة</h1>
                                <input type="text" name="finish_at" class="datepicker" value="{{$course->finish_at}}" placeholder="اضف تاريخ إنتهاء الدورة">
                            </div>
                            <div class="up_form-item">
                                <h1>وصف الدورة</h1>
                                <textarea name="description" placeholder="اضف وصف الدورة">{{$course->description}}</textarea>
                            </div>
                            <!-- /.up_form-item -->
                            <div class="up_form-item">
                                <h1>الجنس المتوقع</h1>
                                <div class="add_cont text-right">
                                    <label class="text-right">
                                        <input type="checkbox" name="male" value="1"
                                               @if($course->male == 1)
                                                   checked
                                               @endif
                                        >
                                        <span>ذكور</span>
                                    </label>
                                    <label class="text-right">
                                        <input type="checkbox" name="female" value="1"
                                               @if($course->female == 1)
                                                   checked
                                               @endif
                                        >
                                        <span>إناث</span>
                                    </label>
                                </div>
                            </div>

                            <div class="up_form-item">
                                <h1>نوع الدورة</h1>
                                <div class="add_cont text-right">
                                    <label class="text-right">
                                        <input type="radio" name="status" value="1"
                                               @if($course->status == 1)
                                                   checked
                                               @endif
                                        >
                                        <span>مدفوع</span>
                                    </label>
                                    <label class="text-right">
                                        <input type="radio" name="status" value="0"
                                               @if($course->status == 0)
                                               checked
                                                @endif
                                        >
                                        <span>مجاني</span>
                                    </label>

                                    <input type="number" value="{{$course->price}}" name="price" data-toggle="tooltip" data-placement="top" title="اضف سعر الدورة">
                                </div>
                            </div>
                            <!-- /.up_form-item -->

                            <div class="up_form-item up-confirm">
                                <button class="btn btn-lg btn-block btn-success"
                                        onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">
                                    <i class="fa fa-save"></i>  حفظ التعديلات
                                </button>
                            </div>
                            <!-- /.up_form-item -->
                        </form>

                        <a href="#" class="btn btn-lg btn-block btn-danger" title="حذف الدورة"
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
                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop

