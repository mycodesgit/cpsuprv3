<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adOffice').submit(function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url: officeCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('officeAdded');
                        $('input[name="office_name"]').val('');
                        $('input[name="office_abbr"]').val('');
                    } else {
                        toastr.error(response.message);
                        console.log(response);
                    }
                },
                error: function(xhr, status, error, message) {
                    var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });

        var dataTable = $('#officeTable').DataTable({
            "ajax": {
                "url": officeReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'office_name'},
                {data: 'office_abbr'},
                {
                    data: 'id',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-primary btn-officeedit mr-1" data-id="' + row.id + '" data-offname="' + row.office_name + '" data-offabbr="' + row.office_abbr + '" data-toggle="tooltip" data-placement="top" title="Edit Office.">';
                            buttons += '<i class="fas fa-pen"></i> </button>';
                            if (isAdmin, isProcurementOfficer, isChecker) {
                                buttons += '<button type="button" value="' + data + '" class="btn btn-sm btn-danger office-delete" data-toggle="tooltip" data-placement="top" title="Delete Office."><i class="fas fa-trash"></i> </button>';
                            }
                            return buttons;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('officeAdded', function() {
            dataTable.ajax.reload();
        });
        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });

    $(document).on('click', '.btn-officeedit', function() {
        var id = $(this).data('id');
        var offName = $(this).data('offname');
        var offAbbr = $(this).data('offabbr');

        $('#editOfficeId').val(id);
        $('#editOfficeName').val(offName);
        $('#editOfficeAbbr').val(offAbbr);

        $('#editOfficeModal').modal('show');
    });

    $('#editOfficeForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: officeUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editOfficeModal').modal('hide');
                    $(document).trigger('officeAdded');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });

    $(document).on('click', '.office-delete', function(e) {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to recover this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: officeDeleteRoute.replace(':id', id),
                    success: function(response) {
                        $("#tr-" + id).delay(1000).fadeOut();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Successfully Deleted!',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if(response.success) {
                            toastr.success(response.message);
                            console.log(response);
                        }
                    }
                });
            }
        })
    });
</script>