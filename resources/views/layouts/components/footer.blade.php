<!-- jQuery (একবার) -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!--plugins-->
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/exporting.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/variable-pie.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/export-data.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/accessibility.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/index2.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Toastr Options
        toastr.options = {
            "timeOut": "3000",
            "positionClass": "toast-top-right"
        };

        // Session Messages
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif

        // Validation Errors
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>

<script>
    new PerfectScrollbar('.customers-list');
    new PerfectScrollbar('.store-metrics');
    new PerfectScrollbar('.product-list');
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
</body>

</html>
