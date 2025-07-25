<script>
    $(document).ready(function() {
        var dataTable = $('#canceltable').DataTable({
            "ajax": {
                "url": allCancelRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            "columns": [
                {data: 'campus_abbr'},
                {data: 'transaction_no'},
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
                            case 19:
                                return '<span class="badge badge-danger">Canceled PR</span>';
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
        }, 5000);
    });
</script>