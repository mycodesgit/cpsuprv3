<script>
    $(document).ready(function() {
        var urlParams = new URLSearchParams(window.location.search);
        var year = urlParams.get('year') || ''; 

        var dataTable = $('#prarchiveTable').DataTable({
            "ajax": {
                "url": allApprovedRoute,
                "type": "GET",
                "data": { 
                    "year": year
                }
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
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
                {data: 'pr_no'},
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
                            case 7:
                                return '<span class="badge badge-success">PR has been Approved by the Budget Office</span>';
                            case 8:
                                return '<span class="badge badge-default bg-teal">PR has been Received</span>';
                            case 9:
                                return '<span class="badge badge-default bg-yellow">For Canvassing</span>';
                            case 10:
                                return '<span class="badge badge-default bg-orange">PR Canvassed</span>';
                            case 11:
                                return '<span class="badge badge-default bg-blue">For Philgeps Posting</span>';
                            case 12:
                                return '<span class="badge badge-default bg-gray">PR Posted</span>';
                            case 13:
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink">Awarded</span>';
                            case 16:
                                return '<span class="badge badge-default bg-red">Purchased</span>';
                            case 17:
                                return '<span class="badge badge-default bg-cyan">Returned</span>';
                            case 18:
                                return '<span class="badge badge-default bg-warning">Forwarded to PEDO</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {
                    data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfarchiveviewchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                                //buttons += '<a href="' + pendingAllListViewRoute + '/' + data + '" class="btn btn-sm btn-primary btn-prremarkschecking mr-1" data-toggle="tooltip" data-placement="top" title="PR Remarks."><i class="fas fa-eye"></i> </a>';
                                buttons += '<button type="button" class="btn btn-sm btn-secondary btn-prpdfemnu mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View Menu."><i class="fas fa-eye"></i></button>';
                                
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
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 10000);
    });

    $(document).on('click', '.btn-prpdfarchiveviewchecking', function () {
        var pid = $(this).data('id');

        $('#viewPrModal').modal('show');
        $('#modalContent').html('<div class="text-center">Loading...</div>');

        $.ajax({
            url: approvedAllListViewRoute + '/' +pid,
            type: 'GET',
            success: function (response) {
                $('#modalContent').html(response);
            },
            error: function () {
                $('#modalContent').html('<div class="alert alert-danger">Failed to load data.</div>');
            }
        });
    });
</script>