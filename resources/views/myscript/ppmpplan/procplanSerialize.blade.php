<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#adYearPPMP').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: ppmpplanCreateRoute,
                type: "POST",
                data: formData,
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                        $('#addYearPPMPModal').modal('hide');
                        $(document).trigger('ppmpplanAdded');
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

        var dataTable = $('#ppmpplanTable').DataTable({
            "ajax": {
                "url": ppmpplanReadRoute,
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
                    data: 'pryearname',
                    render: function (data, type, row) {
                        return 'PROJECT PROCUREMENT MANAGEMENT PLAN ' + data;
                    }
                },
                { data: 'pryearname'},
                {
                    data: 'ppid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var link = '<a href="' + ppmpplanListViewRoute + '/' + data + '" class="btn btn-danger btn-sm btn-edit"><i class="fas fa-eye"></i></a>';
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
        $(document).on('ppmpplanAdded', function() {
            dataTable.ajax.reload();
        }); 
    });
</script>