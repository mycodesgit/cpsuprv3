<script>
    $(document).ready(function() {
        var dataTable = $('#bud').DataTable({
            "ajax": {
                "url": allPendingBudgetRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            "order": [[0, "asc"]], // Order by the first column (cpdate) in descending order
            "columns": [
                {data: 'cpdate',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'campus_abbr'},
                {data: 'transaction_no'},
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
                {data: 'office_abbr'},
                {data: 'purpose_name'},
                {data: 'category_name'},
                {data: 'pstatus',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return '<span class="badge badge-info">Ongoing</span>';
                            case 2:
                                return '<span class="badge badge-warning">Pending</span>';
                            case 3:
                                return '<span class="badge badge-danger">Returned to Client</span>';
                            case 4:
                                return '<span class="badge badge-success" style="font-size: 12px">Checking PR in Procurement</span>';
                            case 5:
                                return '<span class="badge badge-secondary" style="font-size: 12px">Verifying PR in PPMP</span>';
                            case 6:
                                return '<span class="badge badge-warning">Pending/Waiting for checking</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {
                    data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                                buttons += '<button type="button" class="btn btn-sm btn-primary btn-prremarkschecking mr-1" data-id="' + row.pid + '" data-purposeid="' + row.pid + '" data-officeid="' + row.office_id + '" data-campid="' + row.camp_id + '" data-trnsacno="' + row.transaction_no + '" data-userid="' + row.user_id + '" data-purposename="' + row.purpose_name + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-eye"></i></button>';
                                //buttons += '<a href="' + pendingAllListViewRoute + '/' + data + '" class="btn btn-sm btn-primary btn-prremarkschecking mr-1" data-toggle="tooltip" data-placement="top" title="PR Remarks."><i class="fas fa-eye"></i> </a>';
                                
                            return buttons;
                        } else {
                            return data;
                        }
                    },
                },
            ],
        });
        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).on('pendingAllChanges', function() {
            dataTable.ajax.reload();
        });
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 5000);
    });

    $(document).on('click', '.btn-prpdfchecking', function () {
        var pid = $(this).data('id');

        $('#viewPrModal').modal('show');
        $('#modalContent').html('<div class="text-center">Loading...</div>');

        $.ajax({
            url: pendingAllListViewRoute + '/' +pid,
            type: 'GET',
            success: function (response) {
                $('#modalContent').html(response);
            },
            error: function () {
                $('#modalContent').html('<div class="alert alert-danger">Failed to load data.</div>');
            }
        });
    });

    $(document).on('click', '.btn-prremarkschecking', function() {
        var id = $(this).data('id');
        var purposeid = $(this).data('purposeid');
        var officeid = $(this).data('officeid');
        var campid = $(this).data('campid');
        var trnsacno = $(this).data('trnsacno');

        var trnsacno = $(this).data('trnsacno');
        var userid = $(this).data('userid');
        var purposename = $(this).data('purposename');

        $('#editprimpurid').val(id);
        $('#editpurposeid').val(purposeid);
        $('#editofficeid').val(officeid);
        $('#editcampid').val(campid);
        $('#edittrnsacno').val(trnsacno);

        $('#editPRcheckingTrnsacno').val(trnsacno);
        $('#editPRcheckingUserid').val(userid);
        $('#edituserid').val(userid);
        $('#editpurname').val(purposename);

        $('#prcheckingModal').modal('show');
    });

    $('#editprcheckingForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: pendingApprovedPRRoute,
            type: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    $('#prcheckingModal').modal('hide');
                    $(document).trigger('pendingAllChanges');
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
</script>