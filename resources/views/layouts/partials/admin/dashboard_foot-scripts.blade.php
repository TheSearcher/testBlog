<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>

<!-- FORM VALIDATION -->
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<!-- ChartJS -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js')}}"></script>


<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/dist/js/demo.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/dist/js/pages/dashboard2.js')}}"></script>

<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{ asset('assets/plugins/codemirror/codemirror.js')}}"></script>
<script src="{{ asset('assets/plugins/codemirror/codemirror.js')}}"></script>
<script src="{{ asset('assets/plugins/codemirror/mode/css/css.js')}}"></script>
<script src="{{ asset('assets/plugins/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{ asset('assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
<script src="{{ asset('assets/dist/js/demo.js')}}"></script>

<script>
    $(function () {
        //Add text editor
        $('#compose-textarea').summernote()
    })

    $(function () {
        // Summernote
        $('#summernote').summernote()

        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
            mode: "htmlmixed",
            theme: "monokai"
        });
    })
</script>

{{--@include('layout.partials.forms.messages.sitewide_ajax_calls')--}}

