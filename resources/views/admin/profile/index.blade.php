@section('title')
    الصفحة الشخصية
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الصفحة الشخصية</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="container">
                        <div class="col-sm-4">
                            @if($admin->image != null)
                                <img height="300px" width="200px" src="{{asset($admin->image)}}" class="img-responsive img-rounded">
                            @else
                                <img height="300px" width="200px" src="{{asset('http://via.placeholder.com/300x300')}}" class="img-responsive img-rounded">
                            @endif
                        </div>

                        <div class="col-sm-8 form-group">
                            <div class="form-group">
                                <label for="name">الاسم</label>
                                <p class="h4 form-control">{{$admin->name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="name">البريد الالكترونى</label>
                                <p class="h4 form-control">{{$admin->email}}</p>
                            </div>

                            <a href="{{route('profile.edit', $admin->slug)}}" class="btn btn-info btn-block"> تعديل <i class="fa fa-edit"></i></a>
                            <br><br><br><br>
                        </div>


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

