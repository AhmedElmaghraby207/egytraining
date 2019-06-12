@section('title')
    بيانات المتدرب
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="container">
                    <div class="row">
                        <br>
                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2 toppad" >
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center"><p style="margin-top: 0px" class="text-center h3">متدرب</p>{{$trainer->name}}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        @if($trainer->image != null)
                                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{asset($trainer->image)}}" class="img-circle img-responsive"> </div>
                                        @else
                                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{asset('http://via.placeholder.com/350x350')}}" class="img-circle img-responsive"> </div>
                                        @endif
                                        <div class=" col-md-9 col-lg-9 ">
                                            <table class="table table-user-information">
                                                <tbody>
                                                <tr>
                                                    <td>اسم المستخدم: </td>
                                                    <td>{{$trainer->user_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>البريد الالكترونى: </td>
                                                    <td>{{$trainer->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td>رقم الهاتف: </td>
                                                    <td>{{$trainer->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الدولة: </td>
                                                    <td>{{$trainer->country? $trainer->country->name : "غير معروف"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>المؤهل: </td>
                                                    <td>{{$trainer->qualification}}</td>
                                                </tr>
                                                <tr>
                                                    <td>مجال العمل: </td>
                                                    <td>{{$trainer->career}}</td>
                                                </tr>
                                                <tr>
                                                    <td>التخصص: </td>
                                                    <td>{{$trainer->specialize}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الاهتمامات: </td>
                                                    @if($trainer->interests)
                                                        @foreach($trainer->interests as $interests)
                                                            <td class="pull-left"><span class="badge label-success">{{$interests->name}}</span></td>
                                                        @endforeach
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>عن المتدرب</td>
                                                    <td>{{$trainer->about}}</td>
                                                </tr>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="panel-footer">
                                    @if($trainer->active)
                                        <a href="{{route('trainer.deActive', $trainer->id)}}" style="margin-right: 20px;" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pause"> تعطيل</i></a>
                                    @else
                                        <a href="{{route('trainer.active', $trainer->id)}}" style="margin-right: 20px;" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-star"> تنشيط</i></a>
                                    @endif

                                    <a href="{{route('trainers.edit', $trainer->slug)}}" style="margin-right: 20px;" data-toggle="tooltip" type="button" class="btn btn-sm btn-info pull-left"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                    <a href="{{route('trainers.create')}}" style="margin-right: 20px;" data-toggle="tooltip" type="button" class="btn btn-sm btn-success pull-right"><i class="fa fa-user-plus"> إضافة متدرب</i></a>
                                    <a href="{{route('trainers.index')}}" style="margin-right: 20px;" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary pull-right"><i class="glyphicon glyphicon-list"> عرض المتدربين</i></a>

                                    <a href="#" class="text-danger bold btn btn-sm btn-danger" style="margin-right: 20px" data-toggle="tooltip" class="pull-left"
                                       onclick="
                                               var result = confirm('هل أنت متأكد من حذف هذا المتدرب؟');
                                               if(result)
                                               {
                                               event.preventDefault();
                                               document.getElementById('delete-form-{{ $trainer->id }}').submit();
                                               }
                                               "
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <i class="glyphicon glyphicon-remove"></i> حذف
                                    </a>
                                    <form id="delete-form-{{ $trainer->id }}" action="{{route('trainers.destroy', $trainer->id)}}" method="POST">
                                        @csrf()
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
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

