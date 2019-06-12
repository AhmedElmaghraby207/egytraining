@extends('website.layouts.website')

@section('title')
    تغيير كلمة المرور
@stop

@section('content')


    <div class="profile-content empty-course" style="padding: 20px 0 300px 0">
        <div class="container">
            <div class="left_tap-box col-md-10 col-xs-12 col-sm-offset-1">
                <div class="left_box-inner">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in  active" id="home">
                            <div class="home-head">
                                <h1>
                                    <i class="fa fa-user"></i>
                                    تعديل كلمة المرور
                                    <a href="{{route('my_profile.index')}}" class="edit-personal">
                                        <i class="fa fa-cog"></i>
                                        إلغاء التعديل
                                    </a>
                                </h1>
                            </div>
                            <!-- /.home-head -->

                            <form action="{{route('password.update', $user->id)}}" method="post">
                                @csrf()
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger text-center">{{$error}}</p>
                                    @endforeach
                                @endif
                                <input type="hidden" name="_method" value="PUT">

                                <div class="home-content">

                                    <div class="home_data col-md-10 col-sm-10 col-xs-12 text-center">
                                        <div class="home_data-item all-set col-xs-6 col-sm-offset-3 text-center">
                                            <div>
                                                <i class="fa fa-user-secret"></i>
                                                <h1>كلمة المرور القديمة</h1>
                                                <input class="pull-left" style="margin-top: 7px" type="password" name="old_password">
                                            </div>
                                            <div>
                                                <i class="fa fa-user-secret"></i>
                                                <h1>كلمة المرور الجديدة</h1>
                                                <input class="pull-left" style="margin-top: 7px" type="password" name="new_password">
                                            </div>
                                            <div>
                                                <i class="fa fa-user-secret"></i>
                                                <h1>إعادة كلمة المرور الجديدة</h1>
                                                <input class="pull-left" style="margin-top: 7px; margin-bottom: 10px" type="password" name="new_password_confirmation">
                                            </div>
                                        </div>
                                        <!-- /.home_data-item -->
                                    </div>
                                    <!-- ./home_data -->
                                    <div class="home_data-item all-set col-md-12 col-sm-12  col-xs-12 pull-right">
                                        <input type="submit" class="btn btn-block btn-info" value="حفظ التعديلات"
                                               onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                        >
                                    </div>
                                </div>
                            </form>
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


@stop