@extends('website.layouts.website')
@section('title')
    سحب مبلغ
@stop
@section('content')
    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>سحب مبلغ من حسابى</h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">

                    <div class="add_lecture in-one">
                        <form action="{{route('payout.submit')}}" method="get">
                            @csrf()
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <div class="lecture-item">
                                <h1>البريد المراد إرسال المبلغ عليه</h1>
                                <input type="text" name="email" placeholder="اضف البريد الاكترونى">
                            </div>

                            <div class="lecture-item">
                                <h1>محتوى الرسالة</h1>
                                <textarea name="description" placeholder="اضف محتوى الرسالة"></textarea>
                            </div>

                            <div class="lecture-item">
                                <h1>المبلغ</h1>
                                <input class="form-control" type="number" name="money" placeholder="اضف المبلغ">
                            </div>

                            <div class="lecture-item confirm-lec">
                                <input type="submit" value="إرسال"
                                       onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                >
                            </div>

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

