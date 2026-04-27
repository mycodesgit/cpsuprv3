<script>
    $(document).ready(function() {
        var dataTable = $('#exampleTech').DataTable({
            "ajax": {
                "url": allPendingTechRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            "columns": [
                //{data: 'id', name: 'id', orderable: false, searchable: false},
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
                    data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-success btn-prpdfchecking mb-1 text-light" data-id="' + row.pid + '"  data-bs-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>'+'&nbsp;';
                                buttons += '<button type="button" class="btn btn-sm btn-primary btn-prremarkschecking mb-1" data-id="' + row.pid + '" data-prstatus="' + row.prstatus + '" data-trnsacno="' + row.transaction_no + '" data-userid="' + row.user_id + '" data-prno="' + row.pr_no + '"  data-bs-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-eye"></i></button>'+'&nbsp;';
                                //buttons += '<a href="' + pendingAllListViewRoute + '/' + data + '" class="btn btn-sm btn-primary btn-prremarkschecking mr-1" data-toggle="tooltip" data-placement="top" title="PR Remarks."><i class="fas fa-eye"></i> </a>';
                                
                            return buttons;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            // initComplete: function(settings, json) {
            //     var api = this.api();
            //     api.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // },
            // "createdRow": function (row, data, dataIndex) {
            //     $(row).attr('id', 'tr-' + data.id);
            // }
        });
        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).on('pendingAllChanges', function() {
            dataTable.ajax.reload();
        });
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 10000);
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
        var prstatus = $(this).data('prstatus');
        var ppmpremarks = $(this).data('ppmpremarks');
        var prverifystatus = $(this).data('prverifystatus');

        var trnsacno = $(this).data('trnsacno');
        var userid = $(this).data('userid');
        var prno = $(this).data('prno');

        $('#editPRcheckingId').val(id);
        $('#editPRstatus').val(prstatus);
        $('#editPRremarks').val(ppmpremarks);
        $('#prverifystatus').val(prverifystatus);

        $('#editPRcheckingTrnsacno').val(trnsacno);
        $('#editPRcheckingUserid').val(userid);
        $('#editPRcheckingPRno').val(prno);

        $('#prcheckingModal').modal('show');
    });

    $('#editprcheckingForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: pendingAllCheckingStatusUpdateRoute,
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