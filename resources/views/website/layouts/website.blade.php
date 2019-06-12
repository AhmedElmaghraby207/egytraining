<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 ie-all" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 9]><html class="ie9 ie-all" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 10]><html class="ie10 ie-all" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if !IE]><!-->
<!--<![endif]-->
<html>

<head>
    <title>@yield('title', 'الرئيسية')</title>
    <meta name="author" content="Amir Nageh">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Css Files -->
    <link href="{{asset('public/website/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/animate.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/owl.carousel.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/owl.theme.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/video-js.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/style.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/css/reset.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('public/website/images/favicon.png')}}" rel="icon" type="text/css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('public/website/css/toastr.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('public/website/css/rating.css')}}">--}}

    @yield('styles')
</head>

<body>

    <!-- start the loading screen -->
    <div class="wrap">
        <div class="loading">
            <div class="bounceball"></div>
            <div class="text">NOW LOADING</div>
        </div>
    </div>

    <!-- end the loading screen -->

    <div class="wrapper st-container" id="st-container">
        <!-- content push wrapper -->
        <div class="st-pusher">

            <nav class="st-menu st-effect-8" id="menu-8">
                <h2 class="icon icon-stack">
                    @if(App\Setting::first() != null)
                    <img src="{{asset(App\Setting::first()->logo)}}" class="img-responsive">
                    @else
                    <img src="{{asset('public/website/images/logo.png')}}" class="img-responsive">
                    @endif

                </h2>
                <ul>
                    <li><a class="icon icon-data" href="{{url('/home')}}"><i class="fa fa-home"></i> الرئيسية</a></li>
                    <li><a class="icon icon-location" href="{{route('categories.index')}}"><i class="fa fa-rocket"></i>الاقسام</a></li>
                    @if (Auth::user())
                    @if(Auth::user()->coach == 1)
                    <li><a class="icon icon-study" href="{{route('courses.create')}}"><i class="fa fa-plus"></i>اضافة دورة</a></li>
                    @endif
                    @endif
                    <li><a class="icon icon-data" href="{{route('courses.index')}}"><i class="fa fa-database"></i> الدورات</a></li>
                    {{--<li><a class="icon icon-data" href="{{route('certificates.index')}}"><i class="fa fa-graduation-cap"></i> الشهادات</a></li>--}}
                    <li><a id="sd" class="icon icon-location" href="{{route('about-us.index')}}"><i class="fa fa-group"></i>من نحن</a></li>
                    <li><a class="icon icon-photo" href="{{route('contact-us.index')}}"><i class="fa fa-phone"></i>اتصل بنا</a></li>
                    @if(Auth::user())
                    <li><a class="icon icon-photo" href="{{route('my_profile.index')}}"><i class="fa fa-user"></i>حسابى</a></li>
                    @endif
                </ul>
            </nav>
            <div class="st-content">
                <div class="dividers">
                    <span class="t1"></span>
                    <span class="t2"></span>
                    <span class="t3"></span>
                    <span class="t4"></span>
                    <span class="t5"></span>
                    <span class="t1"></span>
                    <span class="t2"></span>
                    <span class="t3"></span>
                    <span class="t4"></span>
                    <span class="t5"></span>
                </div>
                <!-- /.dividers -->

                {{--@if (Auth::user())--}}
                <div id="st-trigger-effects" class="column">
                    <button data-effect="st-effect-8" class="st_show">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                {{--@endif--}}
                <header>
                    <div class="error-detect">
                        <div class="container">
                            <div class="error text-center">
                                <h1 class="danger-l">اي كلام اي كلام اي كلام يا حسني اي كلام يا حسني اي كلام</h1>
                                <h1 class="message-l">اي كلام اي كلام اي كلام يا حسني اي كلام يا حسني اي كلام</h1>
                                <h1 class="success-l">اي كلام اي كلام اي كلام يا حسني اي كلام يا حسني اي كلام</h1>
                            </div>
                            <!-- /.error-danger -->
                        </div>
                        <!-- /.container -->
                    </div>
                    <!-- /.error-detect -->

                    <div class="login-area">
                        <div class="container">
                            <form action="{{route('login')}}" method="post">
                                {{csrf_field()}}
                                @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                <p class="alert alert-danger">{{$error}}</p>
                                @endforeach
                                @endif
                                <div class="login-form col-md-6 col-xs-12 text-right pull-right">
                                    <h1>تسجيل الدخول</h1>
                                    <div class="login-item">
                                        <input type="text" name="email" value="{{old('email')}}" placeholder="البريد الالكترونى">
                                    </div>
                                    <!-- /.login-item -->
                                    <div class="login-item">
                                        <input type="password" name="password" placeholder="كلمة السر">
                                    </div>
                                    <!-- /.login-item -->
                                    <div class="login-item">
                                        <label class="pull-right">
                                            <input type="checkbox">
                                            <span>تذكر كلمة السر دائماً</span>
                                        </label>
                                        <label class="pull-left">
                                            <a href="#" class="forget">هل نسيت كلمة المرور ؟</a>
                                        </label>
                                    </div>
                                    <!-- /.login-item -->
                                    <div class="login-item">
                                        <input type="submit" value="دخول">
                                    </div>
                                    <!-- /.login-item -->
                                </div>
                                <!-- /.login-form -->
                            </form>

                            <div class="signup-form col-md-6 col-xs-12 text-right">
                                <h1>تسجيل عضوية جديدة</h1>
                                <p>اذا كنت مستخدم جديد لموقعنا فيمكنك ان تتصفح معظم الكورسات الموجودة الان امامك ولكن لن تستطيع الحصول علي معلومات الكورس او الاشتراك به الا اذا كنت تمتلك حساب لدينا لذلك تستطيع تسجيل حساب جديد من هنا </p>
                                <a href="{{route('register')}}">
                                    <i class="fa fa-user-plus"></i> تسجيل عضوية
                                </a>
                            </div>
                            <!-- /.signup-form -->

                            <!-- =========================================================================================================================================== -->

                            <div class="panel-pop modal" id="forget">
                                <div class="lost-inner">
                                    <h1>هل نسيت كلمة المرور ؟</h1>
                                    <div class="lost-item">
                                        <input type="text" placeholder="الايميل المستخدم في تسجيل الدخول">
                                    </div>
                                    <!-- /.lost-item -->
                                    <div class="text-center">
                                        <input type="submit" value="إعادة ضبط">
                                    </div>
                                    <!-- /.lost-item -->
                                </div>
                                <!-- /.lost-inner -->
                            </div>
                            <!-- /.modal -->

                            <!-- =========================================================================================================================================== -->

                        </div>
                        <!-- /.container -->
                    </div>
                    <!-- /.login-area -->


                    <div class="header-nav">
                        <div class="container">
                            <div class="nav-right col-md-6 col-xs-12 pull-right">
                                <div class="logo">
                                    <a href="{{url('/home')}}" title="العلوم العصرية للتدريب">
                                        @if(App\Setting::first())
                                        <img src="{{asset(App\Setting::first()->logo)}}" alt="site-logo" width="110" height="70">
                                        @else
                                        <img src="{{asset('public/website/images/logo.png')}}" alt="site-logo" width="110" height="70">
                                        @endif
                                    </a>
                                </div>
                                <!-- /.logo -->
                            </div>
                            <!-- /.nav-logo -->
                            @guest
                            <div class="nav-left col-md-4 col-xs-12 pull-left">
                                <div class="user-controls">
                                    <ul>
                                        <li>
                                            <a href="#" class="show-login">
                                                <i class="fa fa-user"></i> منطقة تسجيل الدخول
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('register')}}">
                                                <i class="fa fa-user-plus"></i> تسجيل عضوية
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /.user-controls -->
                            </div>
                            @else
                            <div class="nav-left user_nav-left col-md-6 col-xs-12 pull-left">
                                <div class="user-logged">
                                    <ul>
                                        <li>
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" class="hvr-underline-reveal">
                                                <span class="cont-img">
                                                    @if(Auth::user())
                                                    @if(Auth::user()->image != null)
                                                    <img src="{{asset(Auth::user()->image)}}" width="35" height="35" alt="User-Img">
                                                    @else
                                                    <img src="{{asset('public/website/images/s.png')}}" width="35" height="35" alt="User-Img">
                                                    @endif
                                                    @endif
                                                </span>
                                                <b>{{ Auth::user()->name }}</b>
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                                <div class="drop drop-links col-xs-12">
                                                    <div class="drop-links">
                                                        <ul>
                                                            <li>
                                                                <a href="{{route('my_profile.index')}}">
                                                                    <i class="fa fa-user"></i>&nbsp; حسابي
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{route('logout')}}">
                                                                    <i class="fa fa-power-off"></i>&nbsp; خروج
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- end drop-links -->
                                                </div>
                                                <!-- end drop -->
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="show-user_search">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="show-notification" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-bell"></i>
                                            </a>
                                            <ul class="dropdown-menu notification-box" role="menu" aria-labelledby="dropdownMenu">
                                                <div class="drop drop-links col-xs-12">
                                                    <ul>
                                                        @if(count(App\Message::all()) > 0)
                                                        @foreach((App\Message::all()) as $message)
                                                        <li>
                                                            <a href="#">
                                                                @if($message->coach)
                                                                @if($message->coach->image != null)
                                                                <img src="{{asset($message->coach->image)}}" alt="" class="img-circle pull-right">
                                                                @else
                                                                <img src="{{asset('public/website/images/avatar5.png')}}" alt="" class="img-circle pull-right">
                                                                @endif
                                                                @else
                                                                <img src="{{asset('public/website/images/avatar5.png')}}" alt="" class="img-circle pull-right">
                                                                @endif
                                                                <h4>
                                                                    {{$message->coach? $message->coach->name : App\Setting::first()->site_name}}
                                                                    <small><i class="fa fa-clock-o"></i>{{$message->created_at? $message->created_at->diffForHumans() : 'غير معروف'}}</small>
                                                                </h4>
                                                                <p>{!! $message->content !!}</p>
                                                                <hr>
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        @endif
                                                    </ul>
                                                </div>
                                                <!-- end drop -->
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /.user-controls -->
                            </div>
                            {{--@endguest--}}
                            @endif
                            <!-- /.nav-user -->
                        </div>
                        <!-- /.container -->
                        <div class="input-container user-search col-md-12 col-xs-12 input-lft">
                            <div class="container">
                                <form action="{{url('/results')}}" method="get">
                                    <input type="text" required name="query" title="إبحث عن الدورات ">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- /.container -->
                        </div>
                        <!-- /.input-container -->
                    </div>
                    <!-- /.header-nav -->
                </header>
                <!-- /header -->

                @yield('search')

                @yield('content')




                <footer>
                    <div class="container">
                        <div class="footer-sub col-md-2 col-xs-12 text-center pull-right">
                            <ul>
                                <li>
                                    <a href="{{route('about-us.index')}}">من نحن</a>
                                </li>

                                <li>
                                    <a href="{{route('contact-us.index')}}">إتصل بنا</a>
                                </li>
                            </ul>
                        </div>
                        <!-- end footer-sub -->
                        <div class="copyrights col-md-8 col-xs-12 text-center pull-right">
                            <p>حميع الحقوق محفوظة لدي العلوم العصرية للتدريب</p>
                        </div>
                        <!-- /.copyrights -->
                        <div class="footer-links col-md-2 col-xs-12 pull-left text-center">
                            <ul>
                                <li>
                                    @if(App\Setting::first())
                                    <a target="_blank" href="{{App\Setting::first()->facebook}}" data-toggle="tooltip" data-placement="top" title="facebook">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    @else
                                    @endif
                                </li>

                                <li>
                                    @if(App\Setting::first())
                                    <a target="_blank" href="{{App\Setting::first()->twitter}}" data-toggle="tooltip" data-placement="top" title="twitter">
                                        <i class="fa fa-twitter-square"></i>
                                    </a>
                                    @else
                                    @endif
                                </li>

                                <li>
                                    @if(App\Setting::first())
                                    <a target="_blank" href="{{App\Setting::first()->linkedin}}" data-toggle="tooltip" data-placement="top" title="linkedin">
                                        <i class="fa fa-linkedin-square"></i>
                                    </a>
                                    @else
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <!-- /.footer-links -->
                    </div>
                    <!-- /.container -->
                </footer>

            </div>
            <!-- /st-content -->
        </div>
    </div>
    <!-- /.wrapper -->

    <div class="toTop col-xs-12 text-center">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- /.toTop -->

    @yield('models')

    <!-- Javascript Files -->
    <script src="{{asset('public/website/js/jquery-2.2.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/html5shiv.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/jquery-smoothscroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/modernizr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/owl.carousel.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/placeholdem.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/toucheffects.js')}}"></script>
    <script src="{{asset('public/website/js/jquery.selectric.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/classie.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/jquery.nicescroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/video.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/website/js/script.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.js"></script>

    <script src="{{ asset('public/website/js/toastr.min.js') }}"></script>
    <script>
        @if(Session::has('success'))
        toastr.success("{{Session::get('success')}}")
        @endif

        @if(Session::has('info'))
        toastr.info("{{Session::get('info')}}")
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{Session::get('warning')}}")
        @endif

        @if(Session::has('error'))
        toastr.error("{{Session::get('error')}}")
        @endif
    </script>

    {{--<script src="{{asset('public/website/js/jquery-1.12.4.js')}}" type="text/javascript"></script>--}}
    <script src="{{asset('public/website/js/jquery-ui.js')}}" type="text/javascript"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker();
        });
    </script>


    @yield('scripts')

</body>

</html>