<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#addUser').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: userCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $(document).trigger('userAdded');
                        $('#modal-user').modal('hide');
                        $('input[name="username"]').val('');
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

        var dataTable = $('#userviewTable').DataTable({
            "ajax": {
                "url": allUsersRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'lname'},
                {data: 'fname'},
                {data: 'mname'},
                {data: 'campus_name'},
                {data: 'office_abbr'},
                {data: 'username'},
                {data: 'role'},
                {data: 'ustatus',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return '<span class="badge badge-info">Enabled</span>';
                            case 2:
                                return '<span class="badge badge-danger">Disabled</span>';
                            case 3:
                                return '<span class="badge badge-warning">Deleted</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {data: 'isAllowed'},
                {
                    data: 'uid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-primary btn-useredit mr-1" data-id="' + row.uid + '" data-fname="' + row.fname + '" data-mname="' + row.mname + '" data-lname="' + row.lname + '" data-username="' + row.username + '" data-office="' + row.office_id + '" data-gender="' + row.gender + '" data-role="' + row.role + '" data-campus="' + row.campus_id + '" data-permission="' + row.isAllowed + '" data-toggle="tooltip" data-placement="top" title="Edit User."><i class="fas fa-pen"></i> </button>';
                                buttons += '<button type="button" class="btn btn-sm btn-light btn-passedit mr-1" data-id="' + row.uid + '" data-password="' + row.password + '" data-toggle="tooltip" data-placement="top" title="Edit User Password."><i class="fas fa-lock"></i> </button>';
                                buttons += '<button type="button" class="btn btn-sm btn-warning btn-ustatusedit mr-1" data-id="' + row.uid + '" data-ustatus="' + row.ustatus + '" data-toggle="tooltip" data-placement="top" title="Enabled/Disabled."><i class="fas fa-toggle-on"></i> </button>';
                            if (isAdmin, isChecker) {
                                buttons += '<button type="button" value="' + data + '" class="btn btn-sm btn-danger userpr-delete" data-toggle="tooltip" data-placement="top" title="Delete Category."><i class="fas fa-trash"></i> </button>';
                            }
                            return buttons;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.uid); 
            }
        });
        $(document).on('userAdded', function() {
            dataTable.ajax.reload();
        });

        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });
    

    $(document).on('click', '.btn-useredit', function() {
        var id = $(this).data('id');
        var fName = $(this).data('fname');
        var mName = $(this).data('mname');
        var lName = $(this).data('lname');
        var userName = $(this).data('username');
        var office = $(this).data('office');
        var gender = $(this).data('gender');
        var role = $(this).data('role');
        var campus = $(this).data('campus');
        var permission = $(this).data('permission');

        $('#edituserId').val(id);
        $('#editfirstname').val(fName);
        $('#editmiddlename').val(mName);
        $('#editlastname').val(lName);
        $('#editusername').val(userName);
        $('#editoffice').val(office);
        $('#editgender').val(gender);
        $('#editrole').val(role);
        $('#editcampus').val(campus);
        $('#editpermission').val(permission);

        $('#editInfoModal').modal('show');
    });

    $(document).on('click', '.btn-passedit', function() {
        var id = $(this).data('id');
        var password = $(this).data('password');

        $('#editPasswordId').val(id);
        $('#editPassword').val(password);

        $('#editPasswordModal').modal('show');
    });

    $(document).on('click', '.btn-ustatusedit', function() {
        var id = $(this).data('id');
        var ustatus = $(this).data('ustatus');

        $('#editUstatusId').val(id);
        $('#editUstatusName').val(ustatus);

        $('#editUstatusModal').modal('show');
    });

    $('#editInfoForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: userUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editInfoModal').modal('hide');
                    $(document).trigger('userAdded');
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

    $('#editPasswordForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: userPassUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editPasswordModal').modal('hide');
                    $(document).trigger('userAdded');
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

    $('#editUstatusForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: userStatusUpdateRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#editUstatusModal').modal('hide');
                    $(document).trigger('userAdded');
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

    $(document).on('click', '.userpr-delete', function(e) {
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
                    url: userDeleteRoute.replace(':id', id),
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