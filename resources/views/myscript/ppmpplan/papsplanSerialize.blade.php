<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adYearPaps').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: papsplanCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $('#addYearPAPsModal').modal('hide');
                        $(document).trigger('papsplanAdded');
                        // $('input[name="fund_name"]').val('');
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

        var dataTable = $('#papspreplanTable').DataTable({
            "ajax": {
                "url": papsplanReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {
                    data: 'papsyearname',
                    render: function (data, type, row) {
                        return 'PROPOSED BUDGET / PROGRAM OF RECEIPTS AND EXPENDITURES (PRE) ' + data;
                    }
                },
                { data: 'papsuserfundsource'},
                {
                    data: 'ppid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var link = '<a href="' + papslanListViewRoute + '/' + data + '" class="btn btn-danger btn-sm btn-edit"><i class="fas fa-eye"></i></a>';
                                //link += '<button type="button" class="btn btn-sm btn-primary btn-prremarkschecking mr-1" data-id="' + row.pid + '" data-purposeid="' + row.pid + '" data-officeid="' + row.office_id + '" data-campid="' + row.camp_id + '" data-trnsacno="' + row.transaction_no + '" data-userid="' + row.user_id + '" data-purposename="' + row.purpose_name + '"  data-toggle="tooltip" data-placement="top" title="View PR."><i class="fas fa-eye"></i></button>';
                            return link;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('papsplanAdded', function() {
            dataTable.ajax.reload();
        }); 
    });
</script>