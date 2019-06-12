@extends('website.layouts.website')

@section('title')
    عرض الاختبارات
@stop

@section('content')

    <div class="up-container">
        <div class="up-header text-center">
            <div class="container">
                <h1><a class="text-primary" href="{{route('courses.show', $course->slug)}}">{{$course->name}}</a> دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form">
                    <div id="tabsleft" class="tabbable tabs-left">
                        <ul>
                            {{--@for($i=1; $i<= count($course->tests); $i++)--}}
                            @if(count($course->tests) > 0)
                                @foreach($course->tests as $test)
                                    <li><a href="#tabsleft-tab{{$test->id}}" data-toggle="tab"> الخطوة {{$test->id}} </a></li>
                                @endforeach
                            @endif
                            {{--@endfor--}}
                        </ul>
                        <div id="bar" class="progress progress-info progress-striped">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>
                        <div class="tab-content">
                            @if(count($course->tests) > 0)
                                {{--@for($i=1; $i<= count($course->tests); $i++)--}}
                                @foreach($course->tests as $test)

                                    <div class="tab-pane" id="tabsleft-tab{{$test->id}}">
                                        <div class="quest text-right">
                                            <div class="quest-head">
                                                <h1>{{$test->question}}</h1>
                                            </div>
                                            <!-- end quest-head -->
                                            <div class="quest-answers">
                                                <div class="answer">
                                                    <label>
                                                        <input type="radio" name="first_ans" id="make-answer">
                                                        <span>{{$test->first_ans}}</span>
                                                    </label>
                                                </div>
                                                <!-- end answer -->

                                                <div class="answer">
                                                    <label>
                                                        <input type="radio" name="second_ans" id="make-answer">
                                                        <span>{{$test->second_ans}}</span>
                                                    </label>
                                                </div>
                                                <!-- end answer -->

                                                <div class="answer">
                                                    <label>
                                                        <input type="radio" name="third_ans" id="make-answer">
                                                        <span>{{$test->third_ans}}</span>
                                                    </label>
                                                </div>
                                                <!-- end answer -->

                                                <div class="answer">
                                                    <label>
                                                        <input type="radio" name="correct_ans" id="make-answer">
                                                        <span>{{$test->correct_ans}}</span>
                                                    </label>
                                                </div>
                                                <!-- end answer -->
                                            </div>
                                            <!-- end quest-answers -->
                                        </div>
                                        <!-- end quest -->
                                    </div>

                                @endforeach
                                {{--@endfor--}}
                            @endif

                            <ul class="pager wizard">
                                <!--                        <li class="previous first"><a href="javascript:;">First</a></li>-->
                                <li class="previous"><a href="javascript:;">الخطوة السابقة</a></li>
                                <!--                        <li class="next last"><a href="javascript:;">Last</a></li>-->
                                <li class="next"><a href="javascript:;">الخطوة التالية</a></li>
                                <li class="next finish" style="display:none;"><a href="javascript:;">انهاء</a></li>
                            </ul>

                        </div>
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

@section('scripts')

    <script>
        $('#tabsleft').bootstrapWizard({
            'tabClass': 'nav nav-tabs',
            'debug': false,
            onTabShow: function (tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#tabsleft .progress-bar').css({
                    width: $percent + '%'
                });

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#tabsleft').find('.pager .next').hide();
                    $('#tabsleft').find('.pager .finish').show();
                    $('#tabsleft').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#tabsleft').find('.pager .next').show();
                    $('#tabsleft').find('.pager .finish').hide();
                }

            }
        });

        $('#tabsleft .finish').click(function () {
            alert('Finished!, Starting over!');
            $('#tabsleft').find("a[href*='tabsleft-tab1']").trigger('click');
        });
    </script>
@stop