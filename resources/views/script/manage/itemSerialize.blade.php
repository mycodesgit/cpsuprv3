<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adItem').submit(function(event) {
            event.preventDefault();
            
            var formData = $(this).serialize();

            $.ajax({
                url: itemCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('itemAdded');
                        $('#addItemModal').modal('hide');
                        $('textarea[name="item_descrip"]').val('');
                        $('input[name="item_cost"]').val('');
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

        var dataTable = $('#itemTable').DataTable({
            "ajax": {
                "url": itemReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            order: [[0, 'asc']],
            "columns": [
                {data: 'item_descrip'},
                {data: 'unit_name'},
                {data: 'item_cost'},
                {data: 'category_name'},
                {
                    data: 'itid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-primary btn-itemedit mr-1" data-id="' + row.itid + '" data-catename="' + row.category_id + '" data-unitname="' + row.unit_id + '" data-itemdesc="' + row.item_descrip + '" data-itemcost="' + row.item_cost + '" data-toggle="tooltip" data-placement="top" title="Edit Item.">';
                            buttons += '<i class="fas fa-pen"></i> </button>';
                            if (isAdmin, isProcurementOfficer, isChecker) {
                                buttons += '<button type="button" value="' + data + '" class="btn btn-sm btn-danger item-delete" data-toggle="tooltip" data-placement="top" title="Delete Item."><i class="fas fa-trash"></i> </button>';
                            }
                            return buttons;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.itid); 
            }
        });
        $(document).on('itemAdded', function() {
            dataTable.ajax.reload();
        });
        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });

    $(document).on('click', '.btn-itemedit', function() {
        var id = $(this).data('id');
        var catName = $(this).data('catename');
        var unitName = $(this).data('unitname');
        var itemdesc = $(this).data('itemdesc');
        var itemCost = $(this).data('itemcost');

        $('#editItemId').val(id);
        $('#editItemCategory').val(catName);
        $('#editItemUnit').val(unitName);
        $('#editItemDescripName').val(itemdesc);
        $('#editItemCost').val(itemCost);

        $('#editItemModal').modal('show');
    });

    $('#editItemForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: itemUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editItemModal').modal('hide');
                    $(document).trigger('itemAdded');
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

    $(document).on('click', '.item-delete', function(e) {
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
                    url: itemDeleteRoute.replace(':id', id),
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