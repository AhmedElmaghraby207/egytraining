@section('title')
    الأقسام
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الأقسام</h3>
                    <a href="{{route('admin-categories.create')}}" class="btn btn-success"> إضافة قسم جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">اسم القسم</th>
                            <th class="text-center">الغلاف</th>
                            <th class="text-center">الوصف</th>
                            <th class="text-center">وقت الانشاء</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($categories) > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td class="text-center">{{$category->id}}</td>
                                    <td class="text-center">{{$category->name}}</td>
                                    <td class="text-center">
                                        <a href="{{asset($category->cover? $category->cover : 'لا يوجد')}}">
                                            <img width="100" height="70" src="{{asset($category->cover? $category->cover : 'لا يوجد')}}" class="image img-responsive img-rounded" alt="">
                                        </a>
                                    </td>
                                    <td class="text-center">{!! $category->description? $category->description : 'لا يوجد'  !!}</td>
                                    <td class="text-center">{{$category->created_at->toFormattedDateString()}}</td>
                                    <td class="text-center"><a href="{{route('admin-categories.edit', $category->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>
                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                    var result = confirm('هل أنت متأكد من حذف هذا القسم؟');
                                                        if(result)
                                                        {
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{ $category->id }}').submit();
                                                        }
                                                    "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $category->id }}" action="{{route('admin-categories.destroy', $category->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10" class="text-center h4">لا يوجد أقسام</th>
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
                "autoWidth": false,
                select: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }, {
                    extend: "colvis",
                    className: "btn dark btn-outline",
                    text: "Columns"
                }],
            });
        });
    </script>


@stop

@include('admin.layouts.footer')

