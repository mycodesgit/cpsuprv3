<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        var dataTable = $('#mycartlist').DataTable({
            "ajax": {
                "url": mycartPrRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'type_request',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return 'Purchase Request';
                            case 2:
                                return 'POW';
                            case 3:
                                return 'Letter Request';
                            case 4:
                                return 'Others';
                            default:
                                return 'Unknown Status';
                        }
                    },
                },
                {data: 'category_name'},
                {data: 'purpose_name'},
                {data: 'created_at',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'pstatus',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return '<span class="badge bg-info">Ongoing</span>';
                            case 2:
                                return '<span class="badge bg-warning">Pending</span>';
                            case 3:
                                return '<span class="badge bg-danger">Returned to End User</span>';
                            case 4:
                                return '<span class="badge bg-success" style="font-size: 12px">Checking PR in Procurement</span>';
                            case 5:
                                return '<span class="badge bg-secondary" style="font-size: 12px">Verifying PR in PPMP</span>';
                            case 6:
                                return '<span class="badge bg-warning">Pending in Budget Office</span>';
                            case 99:
                                return '<span class="badge bg-warning">Pending in MIS - Specification Review</span>';
                            default:
                                return '<span class="badge bg-secondary">Unknown Status</span>';
                        }
                    },
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<a href="' + row.view_url + '" class="btn btn-sm btn-success mr-1 text-light"><i class="fas fa-eye"></i></a>' +'&nbsp;';
                            buttons += '<button type="button" class="btn btn-sm btn-warning btn-categoryedit mr-1 text-light" data-id="' + row.id + '" data-categoryname="' + row.category_name + '" data-toggle="tooltip" data-placement="top" title="Edit Category."><i class="fas fa-pen"></i> </button>' +'&nbsp;';
                            buttons += '<button type="button" class="btn btn-sm btn-secondary btn-categoryedit mr-1 text-light" data-id="' + row.id + '" data-categoryname="' + row.category_name + '" data-toggle="tooltip" data-placement="top" title="Edit Category."><i class="fas fa-server"></i> </button>' +'&nbsp;';
                            buttons += '<button type="button" value="' + data + '" class="btn btn-sm btn-danger cart-delete" data-toggle="tooltip" data-placement="top" title="Delete Category."><i class="fas fa-trash"></i> </button>';
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
        $(document).on('mycartAdded', function() {
            dataTable.ajax.reload();
        });

        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });

    $(document).on('click', '.cart-delete', function(e) {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: mycartDeleteRoute.replace(':id', id),
                    success: function(response) {
                        $("#tr-" + id).delay(1000).fadeOut();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Successfully Deleted!',
                            type: 'success',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                });
            }
        })
    });
</script>