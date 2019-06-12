@extends('website.layouts.website')

@section('title')
    عرض الشهادة
@stop

@section('content')

    <div class="up-container" id="certificatePrinting">
        <div class="up-header text-center">
            <div class="container">
                <h1>{{$certificate->course->name}} شهادة اتمام دورة </h1>
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-header -->
        <div class="up-box">
            <div class="container">
                <div class="up-form certf-container">
                    <div class="certficat-box text-center" id="Certification">
                        <span style="font-size: 30px"> شهادة</span>
                        <h1>{{$certificate->cer_name}}</h1>
                        <span>تمنح من قبل</span>
                        <p>{{$certificate->cer_owner? $certificate->cer_owner : 'EgyTraining'}}</p>
                        <span>تمنح الي الطالب</span>
                        @if(Auth::user()->id != $certificate->coach->id)
                            <h2>{{Auth::user()->name}}</h2>
                        @else
                            <h2>اسم الطالب</h2>
                        @endif
                        <h4>لإجتيازه اختبار دورة</h4>
                        <p>{{$certificate->course->name}}</p>

                        <div class="admin-log">
                            <div class="cer-date">
                                تاريخ
                            </div>
                            <div class="date">
                                {{$certificate->course->finish_at}}
                            </div>
                        </div>
                        <div class="admin-log1">
                            <div class="cer-date">
                                توقيع
                            </div>
                            <div class="date">
                                {{$certificate->coach->name}}
                            </div>
                        </div>

                    </div>
                    <!-- end certificate-box -->
                </div>
                <!-- /.up-form -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.up-box -->
    </div>
    <!-- /.up-container -->
    <div class="certf text-center animated bounceIn">
        <h1>تهانينا لقد انتهيت من هذه الدورة بنجاح </h1>
        <a href="#" onClick="printReport()">
            <i class="fa fa-print"></i> تستطيع طباعة الشهادة
        </a>
    </div>


@stop

@section('scripts')
    <script type="text/javascript">
        function printReport()
        {
            var prtContent = document.getElementById("certificatePrinting");
            var WinPrint = window.open();
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>
@stop