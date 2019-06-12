@section('title')
    قالوا عنا
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">الاقاويل</h3>
                    <a href="{{route('sayings.create')}}" class="btn btn-success"> إضافة قول جديد <i class="fa fa-plus"></i></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">اسم صاحب القول</th>
                            <th class="text-center">الصورة</th>
                            <th class="text-center">القول</th>
                            <th class="text-center">وقت الانشاء</th>
                            <th class="text-center">تعديل</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($sayings) > 0)
                            @foreach($sayings as $saying)
                                <tr>
                                    <td class="text-center">{{$saying->id}}</td>
                                    <td class="text-center">{{$saying->name}}</td>
                                    <td class="text-center">
                                        <a href="{{asset($saying->image? $saying->image : 'لا يوجد')}}">
                                            <img width="70" height="50" src="{{asset($saying->image? $saying->image : 'لا يوجد')}}" class="align-content-center image img-responsive img-rounded" alt="">
                                        </a>
                                    </td>
                                    <td class="text-center">{!!$saying->body!!}</td>
                                    <td class="text-center">{{$saying->created_at->toFormattedDateString()}}</td>
                                    <td class="text-center"><a href="{{route('sayings.edit', $saying->slug)}}" class="btn btn-sm btn-info">تعديل</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذا القول؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $saying->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $saying->id }}" action="{{route('sayings.destroy', $saying->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="7" class="text-center h4">لا يوجد أقاويل حتى الان</th>
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

