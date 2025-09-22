<script>
    $(document).ready(function() {
        var dataTable = $('#prall').DataTable({
            "ajax": {
                "url": allPrRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray text-light">PR Posted</span>';
                            case 13:
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prapproved').DataTable({
            "ajax": {
                "url": allApprovedRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
                {data: 'cpdate',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'datebud',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            if (!data) return '';
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'campus_abbr'},
                {data: 'pr_no'},
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
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
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 15000);
    });

    $(document).on('click', '.btn-prpdfchecking', function () {
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

    $(document).ready(function() {
        var dataTable = $('#prreceived').DataTable({
            "ajax": {
                "url": allReceivedRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
                {data: 'cpdate',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'datereceived',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            if (!data) return '';
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'campus_abbr'},
                {data: 'pr_no'},
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prcanvassing').DataTable({
            "ajax": {
                "url": allCanvassingRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
                {data: 'cpdate',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'datecanvassing',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            if (!data) return '';
                            return moment(data).format('MMMM D, YYYY h:mm A');
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prcanvassed').DataTable({
            "ajax": {
                "url": allCanvassedRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
                {data: 'cpdate',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY  h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'datecanvassed',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            if (!data) return '';
                            return moment(data).format('MMMM D, YYYY h:mm A');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'campus_abbr'},
                {data: 'pr_no'},
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prphilgep').DataTable({
            "ajax": {
                "url": allPhilgepRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray text-light">PR Posted</span>';
                            case 13:
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prposting').DataTable({
            "ajax": {
                "url": allPostingRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray text-light">PR Posted</span>';
                            case 13:
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#fuckxxyoubid').DataTable({
            "ajax": {
                "url": allBddngLantadRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#consolidatePR').DataTable({
            "ajax": {
                "url": allConsolidatdprRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#praward').DataTable({
            "ajax": {
                "url": allPAwardRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prbakal').DataTable({
            "ajax": {
                "url": allpurchaseRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                { 
                    data: 'purpose_name',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                        return data.length > 80 ? data.substring(0, 30) + '...' : data;
                        }
                        return data;
                    }
                },
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prreturntoidontknow').DataTable({
            "ajax": {
                "url": allreturnedRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                { 
                    data: 'purpose_name',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                        return data.length > 80 ? data.substring(0, 30) + '...' : data;
                        }
                        return data;
                    }
                },
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).ready(function() {
        var dataTable = $('#prpedo').DataTable({
            "ajax": {
                "url": allpedoRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true,
            paging: true,
            order: [[1, 'desc']],
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
                { 
                    data: 'purpose_name',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                        return data.length > 80 ? data.substring(0, 30) + '...' : data;
                        }
                        return data;
                    }
                },
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
                                return '<span class="badge badge-default bg-gray-dark text-light">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple text-light">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink text-light">Awarded</span>';
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
                            var buttons = '<button type="button" class="btn btn-sm btn-danger btn-prpdfchecking mr-1" data-id="' + row.pid + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-file-pdf"></i></button>';
                
                            if (userRole === 'Checker') {
                                var dropdown = '<div class="d-inline-block">' +
                                    '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                    '<div class="dropdown-menu">' +
                                        '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-check"></i> Received PR' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                            '<i class="fa-regular fa-file-lines"></i> For Canvassing' +
                                        '</a>' +
                                        '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed' +
                                        '</a>' +
                                        '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-envelopes-bulk"></i> For Posting' +
                                        '</a>' +
                                        '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-address-book"></i> Posted' +
                                        '</a>' +
                                        '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-person-chalkboard"></i> Bidding' +
                                        '</a>' +
                                        '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                            '<i class="fa-brands fa-get-pocket"></i> For Consolidation' +
                                        '</a>' +
                                        '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                            '<i class="fa-solid fa-award"></i> Awarded' +
                                        '</a>' +
                                        '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-dolly"></i> Purchased' +
                                        '</a>' +
                                        '<a href="' + approvedReturnedViewRoute + '/' + data + '" class="dropdown-item returned-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-person-walking-arrow-loop-left"></i> Returned' +
                                        '</a>' +
                                        '<a href="' + forwardedPedoViewRoute + '/' + data + '" class="dropdown-item forwarded-pr" data-id="' + data + '">' +
                                            '<i class="fas fa-forward"></i> Forwarded to PEDO' +
                                        '</a>' +
                                    '</div>' +
                                '</div>';
                
                                //return viewLink + dropdown; // Show both View PR and dropdown for Checker
                            }
                
                            return buttons + dropdown; // Only show View PR for non-Checker roles
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
        }, 15000);
    });

    $(document).on('click', '.btn-prpdfemnu', function () {
        var pid = $(this).data('id');

        // Show modal
        $('#menuAllModal').modal('show');

        // Store pid into each button's data-id
        $('#menuAllModal .received-pr').data('id', pid);
        $('#menuAllModal .canvassing-pr').data('id', pid);
        $('#menuAllModal .canvassed-pr').data('id', pid);
        $('#menuAllModal .posting-pr').data('id', pid);
        $('#menuAllModal .posted-pr').data('id', pid);
        $('#menuAllModal .bidding-pr').data('id', pid);
        $('#menuAllModal .consolidation-pr').data('id', pid);
        $('#menuAllModal .awarded-pr').data('id', pid);
        $('#menuAllModal .purchased-pr').data('id', pid);
        $('#menuAllModal .returned-pr').data('id', pid);
        $('#menuAllModal .forwarded-pr').data('id', pid);
    });


</script>
