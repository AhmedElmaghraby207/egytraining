@extends('website.layouts.website')

@section('title')
    إضافة درس
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>إضافة درس جديد</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">

                    <div class="add_lecture in-one">
                        <form action="{{route('lectures.store')}}" method="post" enctype="multipart/form-data">
                            @csrf()
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <div class="lecture-item">
                                <h1>اسم الدرس</h1>
                                <input type="text" name="name" placeholder="اضف اسم الدرس">
                            </div>
                            <!-- /.lecture-item -->
                            <div class="lecture-item">
                                <h1>اضف رابط خارجي للفيديو</h1>
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
                                <input type="text" name="video_link" placeholder="{{null}}" class="linked">
                            </div>
                            <!-- /.lecture-item -->
                            <div class="lecture-item">
                                <h1>وصف الدرس</h1>
                                <textarea name="description" placeholder="اضف وصف الدرس"></textarea>
                            </div>
                            <!-- /.lecture-item -->
                            <div class="lecture-item text-right">
                                <div class="fileUpload col-xs-12 text-right">
                                    <span><i class="fa fa-file"></i> إضافة ملف </span>
                                    <input type="file" name="file" class="upload">
                                </div>
                                <span class="hint"> Image او Word او Powerpoint او Pdf الملف يمكن ان يكون </span>
                            </div>
                            <!-- /.lecture-item -->
                            <div class="lecture-item confirm-lec">
                                <input type="submit" value="إضافة الدرس"
                                       onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                >
                            </div>
                            <!-- /.lecture-item -->

                        </form>
                    </div>
                    <!-- /.add_lecture -->
                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop