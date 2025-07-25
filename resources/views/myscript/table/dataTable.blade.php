<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true,
            "autoWidth": true,
            "info": false,
            "lengthChange": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


        $("#example3").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

        }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

        $("#example4").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "searching": true,
            "buttons": ["excel"]

        }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    });
</script>