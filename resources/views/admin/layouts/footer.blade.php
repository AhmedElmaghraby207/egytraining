<footer class="main-footer text-center">
    .<strong>Copyright &copy; 2018 <a href="{{url('/home')}}">{{App\Setting::first()->site_name}}</a>,</strong> All rights
    reserved
</footer>



</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('public/cpanel/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('public/cpanel/js/jquery-1.12.4.js')}}"></script>

<script src="{{asset('public/cpanel/js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('public/cpanel/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('public/cpanel/js/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('public/cpanel/js/fastclick.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('public/cpanel/js/jquery.dataTables.js')}}"></script>
{{--<script src="{{asset('public/cpanel/js/dataTables.bootstrap.min.js')}}"></script>--}}

<!-- AdminLTE App -->
<script src="{{asset('public/cpanel/js/app.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/cpanel/js/demo.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('public/cpanel/js/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('public/cpanel/js/ckeditor.js')}}"></script>
<script src="{{asset('public/cpanel/js/video.js')}}" type="text/javascript"></script>
<script src="{{asset('public/cpanel/js/script.js')}}" type="text/javascript"></script>

{{--<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.4/js/dataTables.tableTools.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.flash.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>--}}



<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>

<script src="{{ asset('public/cpanel/js/toastr.min.js') }}"></script>
<script>

    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}")
    @endif

    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}")
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{Session::get('warning')}}")
    @endif

    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}")
    @endif

</script>

{{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    } );
</script>

@yield('scripts')

</body>
</html>
