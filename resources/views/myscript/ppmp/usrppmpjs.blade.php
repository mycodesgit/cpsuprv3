<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $('#categories').select2({
        width: '100%',
        dropdownParent: $('#modal-userppmp')
    });
    $(document).ready(function() {
        var dataTable = $('#ppmpuserviewTable').DataTable({
            "ajax": {
                "url": ppmpUserReadRoute,
                "type": "GET",
            },
            destroy: true,
            info: true,
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                { data: 'no' },
                { data: 'campus' },
                { data: 'office' },
                { data: 'name' },
                { 
                    data: 'categories',
                    render: function(data) {
                        return data.map(cat => 
                            `<span class="badge bg-secondary">${cat}</span>`
                        ).join(' ');
                    }
                },
                {
                    data: 'puid',
                    render: function(data, type, row) {
                        return `
                            <button class="btn btn-success btn-sm btn-edit text-light"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-userppmp"
                                data-id="${data}"
                                data-categories='${JSON.stringify(row.category_ids)}'>
                                <i class="ti ti-pencil"></i>
                            </button>
                        `;
                    }
                }
            ],
            "createdRow": function (row, data, index) {
                $(row).attr('id', 'tr-' + data.id); 
            }
        });
        $(document).on('categoryAdded', function() {
            dataTable.ajax.reload();
        });

        dataTable.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    });

    $(document).on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let categories = $(this).data('categories');

        if (typeof categories === 'string') {
            categories = JSON.parse(categories);
        }

        let actionUrl = ppmpUserUpdateRoute.replace(':id', id);

        $('#userppmpForm').attr('action', actionUrl);

        $('#puid').val(id);

        $('#categories').val(categories).trigger('change');
    });

    $('#userppmpForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });
                $('#modal-userppmp').modal('hide');
                $('#ppmpuserviewTable').DataTable().ajax.reload();
            },
            error: function(err) {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: err.responseJSON?.message || 'Something went wrong'
                });
            }
        });
    });
</script>