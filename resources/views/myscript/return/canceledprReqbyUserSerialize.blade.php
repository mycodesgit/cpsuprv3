<script>
    $(document).ready(function() {
        var dataTable = $('#reqcancelprbud').DataTable({
            "ajax": {
                "url": allreqCancelRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
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
                                return '<span class="badge badge-success">PR has been Approved</span>';
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
                                return '<span class="badge badge-default bg-gray-dark">Bidding</span>';
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
                            var link = '<a href="' + cancelreqprRoute + '/' + data + '" class="btn btn-outline-danger btn-sm canceled-pr" data-id="' + data + '" data-toggle="tooltip" data-placement="top" title="Cancel this PR.">' +
                                '<i class="fas fa-ban"></i>' +
                                '</a>';
                            return link;
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

<script>
    $(document).on('click', '.canceled-pr', function(e) {
        e.preventDefault();
        var cancelreqprRoute = '{{ route('cancelreqheadPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
        title: 'Are you sure you want to cancel this PR?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: cancelreqprRoute,
            method: 'POST',
            data: {
                id: prId
            },
            success: function(response) {
                Swal.fire(
                'Canceled!',
                'The purchase request has been canceled.',
                'success'
                );
                console.log(response);
            },
            error: function(xhr, status, error) {
                Swal.fire(
                'Error!',
                'An error occurred while canceling the purchase request.',
                'error'
                );
                console.error(error);
            }
            });
        }
        });
    });
</script>