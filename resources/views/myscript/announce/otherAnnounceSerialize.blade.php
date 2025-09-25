<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adOtherAnnounce').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: otherAnounceCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('otheranncAdded');
                        $('#modal-addOtherAnnounceModal').modal('hide');
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

        var dataTable = $('#otherAnnounce').DataTable({
            "ajax": {
                "url": otherAnounceReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'otherannouncement'},
                {
                    data: null,
                    render: function(data, type, row) {
                        var firstname = data.fname;
                        var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                        var lastName = data.lname;
                        
                        return lastName + ', ' + firstname + ' ' + middleInitial;
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            if (data == 1) {
                                return '<span class="badge badge-success">Enabled</span>';
                            } else if (data == 2) {
                                return '<span class="badge badge-danger">Disabled</span>';
                            } else {
                                return '<span class="badge badge-secondary">Unknown</span>';
                            }
                        }
                        return data;
                    }
                },
                {
                    data: 'rid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-primary btn-otheranncedit mr-1" ' +
                            'data-id="' + row.rid + '" ' +
                            'data-status="' + row.status + '" ' +
                            'data-toggle="tooltip" data-placement="top" title="Edit Other Announcement."' +
                            '><i class="fas fa-pen"></i></button>' +
                            '<input type="hidden" class="hidden-announcement" value="' + encodeURIComponent(row.otherannouncement) + '">';
                            buttons += '<button type="button" value="' + data + '" class="btn btn-sm btn-danger otherannce-delete" data-toggle="tooltip" data-placement="top" title="Delete Category."><i class="fas fa-trash"></i> </button>';
                            return buttons;
                        } else {
                            return data;
                        }
                    }     
                }
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('otheranncAdded', function() {
            dataTable.ajax.reload();
        });

        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });

    $(document).on('click', '.btn-otheranncedit', function() {
        var id = $(this).data('id');

        var otherannouncementName = decodeURIComponent($(this).closest('li, tr').find('.hidden-announcement').val());
        var otherannouncementStatus = $(this).data('status');

        $('#editOtherAnnounceId').val(id);
        $('#editOtherAnnounceName').summernote('code', otherannouncementName);
        $('#editOtherAnnounceStatus').val(otherannouncementStatus);

        $('#editOtherAnnounceModal').modal('show');
    });

    $('#editOtherAnnounceForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: otherAnounceUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editOtherAnnounceModal').modal('hide');
                    $(document).trigger('otheranncAdded');
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

    $(document).on('click', '.otherannce-delete', function(e) {
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
                    url: otherAnounceDeleteRoute.replace(':id', id),
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