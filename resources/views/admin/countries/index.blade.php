@section('title')
    الدول
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الدول</h3>
                    <a href="{{route('countries.create')}}" class="btn btn-success"> إضافة دولة جديدة <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">اسم الدولة</th>
                            <th class="text-center">وقت الانشاء</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($countries) > 0)
                            @foreach($countries as $country)
                                <tr>
                                    <td class="text-center">{{$country->id}}</td>
                                    <td class="text-center">{{$country->name}}</td>
                                    <td class="text-center">{{$country->created_at->toFormattedDateString()}}</td>
                                    <td class="text-center"><a href="{{route('countries.edit', $country->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذه الدولة؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $country->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $country->id }}" action="{{route('countries.destroy', $country->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="6" class="text-center h4">لا يوجد دول</th>
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

