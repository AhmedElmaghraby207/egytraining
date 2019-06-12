@extends('website.layouts.website')

@section('title')
    اتصل بنا
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1>اتصل بنا </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box contact-box text-right">
            <div class="container">
                <div class="contact-form col-md-6 col-xs-12 pull-right">
                    <div class="inner">
                        <h1>اتصل بنا </h1>
                        <form action="{{route('contact-us.store')}}" method="post">
                            @csrf()
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <div class="contact-item">
                                <i class="fa fa-user"></i>
                                <input name="name" type="text" placeholder="الاسم بالكامل">
                            </div>
                            <!-- end contact-item -->
                            <div class="contact-item">
                                <i class="fa fa-envelope"></i>
                                <input name="email" type="email" placeholder="ادخل ايميلك">
                            </div>
                            <!-- end contact-item -->
                            <div class="contact-item">
                                <i class="fa fa-comment-o"></i>
                                <textarea name="message" placeholder="اكتب رسالتك "></textarea>
                            </div>
                            <!-- end contact-item -->
                            <div class="contact-item">
                                <input type="submit" value="إرســال">
                            </div>
                            <!-- end contact-item -->
                        </form>
                    </div>
                    <!-- end inner -->
                </div>
                <!-- end contact-form -->
                <div class="FAQ col-md-6 col-xs-12 pull-left">
                    <div class="inner">
                        <h1>الاسئلة الشائعة</h1>
                        <div class="faq-item">
                            @if(count($questions) > 0)
                                @foreach($questions as $question)
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="button" role="tab" id="headingOne"
                                                 role="button" data-toggle="collapse" data-parent="#accordion"
                                                 href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h4 class="panel-title">
                                                    <a>
                                                        <h5>
                                                            <i class="fa fa-question-circle"></i>
                                                        </h5>
                                                        {{$question->question}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                                 aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <p>{!! $question->answer !!}</p>
                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /#collapseOne -->
                                        </div>
                                        <!-- /.panel-default -->
                                    </div>
                                    <!-- /.panel-group -->
                                @endforeach
                            @else
                                <div class="empty-msg text-center animated shake">
                                    <h1>
                                        <i class="fa fa-frown-o"></i>لا توجد اسئلة الان
                                    </h1>
                                </div>
                                <!-- end empty-msg -->
                            @endif
                        </div>
                        <!-- end faq-item -->
                    </div>
                    <!-- end inner -->
                </div>
                <!-- end FAQ -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->

@stop