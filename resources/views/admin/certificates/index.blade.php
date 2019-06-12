@section('title')
    الشهادات
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الشهادات</h3>
                    <a href="{{route('admin-certificates.create')}}" class="btn btn-success"> إضافة شهادة جديدة <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الاسم</th>
                            <th class="text-center">الجهة المانحة</th>
                            <th class="text-center">الكورس</th>
                            <th class="text-center">المدرب</th>
                            <th class="text-center">عرض</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($certificates) > 0)
                            @foreach($certificates as $certificate)
                                <tr>
                                    <td class="text-center">{{$certificate->id}}</td>
                                    <td class="text-center">{{$certificate->cer_name}}</td>
                                    <td class="text-center">{{$certificate->cer_owner}}</td>
                                    <td class="text-center">{{$certificate->course->name}}</td>
                                    <td class="text-center">{{$certificate->coach->name}}</td>
                                    <td class="text-center"><a href="{{route('admin-certificates.show', $certificate->slug)}}" class="btn btn-sm btn-primary">عرض</a></td>

                                    <td class="text-center">
                                        @if($certificate->active)
                                            <a href="{{route('admin-certificate.deActive', $certificate->id)}}" class="btn btn-sm btn-warning">تعطيل</a>
                                        @else
                                            <a href="{{route('admin-certificate.active', $certificate->id)}}" class="btn btn-sm btn-success">تنشيط</a>
                                        @endif
                                    </td>

                                    <td class="text-center"><a href="{{route('admin-certificates.edit', $certificate->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
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
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $certificate->id }}" action="{{route('admin-certificates.destroy', $certificate->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد شهادات حتى الان</th>
                            </tr>
                        @endif
                        </tbody>

                    </table>
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

