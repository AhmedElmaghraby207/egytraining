@section('title')
    بيانات الشهادة
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
                                    <h3 class="panel-title text-center"><p style="margin-top: 0px" class="text-center h3">شهادة</p>{{$certificate->cer_name}}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-9 col-sm-offset-2">
                                            <table class="table table-user-information">
                                                <tbody>
                                                <tr>
                                                    <td>اسم الشهادة:</td>
                                                    <td>{{$certificate->cer_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الجهه المانحة</td>
                                                    <td>{{$certificate->cer_owner}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الكورس:</td>
                                                    <td>{{$certificate->course->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>المدرب:</td>
                                                    <td>{{$certificate->coach->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>الحالة</td>
                                                    @if($certificate->active == 0)
                                                        <td><p class="text-danger">متوقفة</p></td>
                                                    @else
                                                        <td><p class="text-primary">مفعلة</p></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>النوع</td>
                                                    @if($certificate->cer_status == 0)
                                                        <td><p class="text-primary">مجانى</p></td>
                                                    @else
                                                        <td><p class="text-danger">مدفوع</p></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td>السعر</td>
                                                    @if($certificate->cer_status == 0)
                                                        <td>----------</td>
                                                    @else
                                                        <td>{{$certificate->cer_price}} $</td>
                                                    @endif
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    @if($certificate->active)
                                        <a href="{{route('admin-certificate.deActive', $certificate->id)}}" data-original-title="تعطيل" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"> تعطيل</i></a>
                                    @else
                                        <a href="{{route('admin-certificate.active', $certificate->id)}}" data-original-title="تنشيط" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-edit"> تنشيط</i></a>
                                    @endif

                                    <a href="{{route('admin-certificates.edit', $certificate->id)}}" data-original-title="تعديل" style="margin-right: 20px" data-toggle="tooltip" type="button" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-edit"> تعديل</i></a>
                                    <a href="{{route('admin-certificates.index')}}" data-original-title="عرض الشهادات" style="margin-right: 20px" data-toggle="tooltip" type="button" class="pull-right btn btn-sm btn-primary"><i class="glyphicon glyphicon-th"> كل الشهادات</i></a>
                                    <a href="{{route('admin-certificates.create')}}" data-original-title="إضافة شهادة" style="margin-right: 20px" data-toggle="tooltip" type="button" class="pull-right btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"> إضافة شهادة</i></a>

                                    <a href="#" class="text-danger bold btn btn-sm btn-danger" style="margin-right: 20px" data-toggle="tooltip" class="pull-left"
                                       onclick="
                                               var result = confirm('هل أنت متأكد من حذف هذه الشهادة؟');
                                               if(result)
                                               {
                                               event.preventDefault();
                                               document.getElementById('delete-form-{{ $certificate->id }}').submit();
                                               }
                                               "
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <i class="glyphicon glyphicon-remove"></i> حذف
                                    </a>
                                    <form id="delete-form-{{ $certificate->id }}" action="{{route('admin-certificates.destroy', $certificate->id)}}" method="POST">
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

