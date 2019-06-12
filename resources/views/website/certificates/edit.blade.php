@extends('website.layouts.website')

@section('title')
    تعديل الشهادة
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>{{$certificate->cer_name}} تعديل شهادة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">
                    <div class="add_lecture in-one">
                        <form action="{{route('certificates.update', $certificate->id)}}" method="post" class="add-form">
                            @csrf()
                            <input type="hidden" name="_method" value="put">
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="hidden" name="course_id" value="{{$certificate->course->id}}">
                            <div class="up_form-item">
                                <div class="up_form-item">
                                    <h1>إسم الشهادة</h1>
                                    <input type="text" name="cer_name" value="{{$certificate->cer_name}}" placeholder="اضف اسم الشهادة">
                                </div>
                                <!-- /.up_form-item -->
                                <div class="up_form-item">
                                    <h1>الجهة المانحة</h1>
                                    <input type="text" name="cer_owner" value="{{$certificate->cer_owner}}" placeholder="اضف الجهة المانحة">
                                </div>
                                <!-- /.up_form-item -->
                                <div class="up_form-item">
                                    <h1>تكلفة الشهادة</h1>
                                    <div class="add_cont text-right">
                                        <label class="text-right">
                                            <input type="radio" name="cer_status" value="1"
                                            @if($certificate->cer_status == 1)
                                                checked
                                            @endif
                                            >
                                            <span>مدفوع</span>
                                        </label>
                                        <label class="text-right">
                                            <input type="radio" name="cer_status" value="0"
                                            @if($certificate->cer_status == 0)
                                                checked
                                            @endif
                                            >
                                            <span>مجاني</span>
                                        </label>
                                        <input type="number" name="cer_price" value="{{$certificate->cer_price}}" data-toggle="tooltip" data-placement="top" title="اضف سعر الشهادة">
                                    </div>
                                </div>
                                <!-- /.up_form-item -->
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

                        <a href="#" class="btn btn-lg btn-block btn-danger" title="حذف الشهادة"
                           onclick="
                                   var result = confirm('هل أنت متأكد من حذف هذه الشهادة؟');
                                   if(result)
                                   {
                                   event.preventDefault();
                                   document.getElementById('delete-form-{{ $certificate->id }}').submit();
                                   }
                                   "
                        >
                            <i class="fa fa-trash"></i>   حذف الشهادة
                        </a>
                        <form id="delete-form-{{ $certificate->id }}" action="{{route('certificates.destroy', $certificate->id)}}" method="POST">
                            @csrf()
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="course_id" value="{{$certificate->course->id}}">
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

