@section('title')
    التواصل
@stop
@include('admin.layouts.head')

@include('admin.layouts.header')

@include('admin.layouts.sidebar')


<div class="content-wrapper">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class=" text-center">رسائل التواصل</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">الاسم</th>
                            <th class="text-center">البريد الالكترونى</th>
                            <th class="text-center">الرسالة</th>
                            <th class="text-center">وقت الارسال</th>
                            <th class="text-center">ارسال بريد</th>
                            <th class="text-center">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($contacts) > 0)
                            @foreach($contacts as $contact)
                                <tr>
                                    <td class="text-center">{{$contact->id}}</td>
                                    <td class="text-center">{{$contact->name}}</td>
                                    <td class="text-center">{{$contact->email}}</td>
                                    <td class="text-center">{{$contact->message}}</td>
                                    <td class="text-center">{{ Carbon\Carbon::parse($contact->created_at)->format('Y-m-d') }}</td>
                                    {{--<td class="text-center">{{$contact->created_at->toFormattedDateString()}}</td>--}}
                                    <td class="text-center"><a class="btn btn-sm btn-success" href="{{route('send.email', $contact->id)}}">ارسال</a></td>

                                    <td class="text-center">
                                        <a href="#" class="text-danger bold btn btn-sm btn-danger"
                                           onclick="
                                                   var result = confirm('هل أنت متأكد من حذف هذه الرسالة؟');
                                                   if(result)
                                                   {
                                                   event.preventDefault();
                                                   document.getElementById('delete-form-{{ $contact->id }}').submit();
                                                   }
                                                   "
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            حذف
                                        </a>
                                        <form id="delete-form-{{ $contact->id }}" action="{{route('contacts.destroy', $contact->id)}}" method="POST">
                                            @csrf()
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="8" class="text-center h4">لا يوجد رسائل حتى الان</th>
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

