@section('title')
    تعديل الصفحة الشخصية
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">تعديل الصفحة الشخصية</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="container">
                        <div class="col-sm-4">
                            <img height="300px" width="200px" src="{{asset($admin->image ? $admin->image : 'http://via.placeholder.com/300x300')}}" alt="" class="img-responsive img-rounded">                        </div>

                        <form action="{{route('profile.update', $admin->id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <p class="alert alert-danger text-center">{{$error}}</p>
                                @endforeach
                            @endif
                            <input type="hidden" name="_method" value="put">
                            <div class="col-sm-8 form-group">
                                <div class="form-group">
                                    <label for="name">الاسم</label>
                                    <input class="form-control" required type="text" name="name" value="{{$admin->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">البريد الالكترونى</label>
                                    <input class="form-control" required type="email" name="email" value="{{$admin->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="password">كلمة المرور</label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="image">الصورة الشخصية</label>
                                    <input class="form-control" type="file" name="image">
                                </div>

                                <button class="btn btn-success btn-block"
                                        onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                > حفظ <i class="fa fa-save"></i></button>
                            </div>
                        </form>

                    </div>
                </div>


                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
</div>

@section('scripts')

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>

@stop

@include('admin.layouts.footer')

