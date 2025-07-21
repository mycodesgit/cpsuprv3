<script>
    $(document).ready(function() {
        var grandTotal = 0;
        var dataTable = $('#cart').DataTable({
            "ajax": {
                "url": allCartRoute,
                "type": "GET",
            },
            info: false,
            responsive: true,
            lengthChange: false,
            searching: false,
            paging: false,
            "columns": [
                {
                    data: 'item_descrip',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            // Check if the length of the string exceeds 30 characters
                            if (data.length > 30) {
                                // Truncate the string and append '...' at the end
                                return data.substring(0, 45) + '...';
                            } else {
                                return data;
                            }
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'unit_name'},
                {data: 'qty'},
                {data: 'fitem_cost'},
                { 
                    data: 'total_cost',
                    render: function (data, type, row) {
                        return parseFloat(data).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                },
                {data: 'iid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var button = '<button type="button" value="' + data + '" class="btn btn-outline-danger btn-xs prreq-delete">' +
                                '<i class="fas fa-trash"></i>' +
                                '</button>';
                            return button;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api();
                grandTotal = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                }, 0);
                $(api.column(4).footer()).html(parseFloat(grandTotal).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                $('#grandTotal').text(parseFloat(grandTotal).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                function toggleSubmitButton() {
                    if (grandTotal > 0) {
                        $('#submitPRButton').prop('disabled', false);
                    } else {
                        $('#submitPRButton').prop('disabled', true);
                    }
                }
                toggleSubmitButton();
            },
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.iid); 
            }
        });
        $(document).on('itemAdded', function() {
            dataTable.ajax.reload();
        });
    });
</script>