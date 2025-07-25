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

<script>
    function resetFormFields() {
        $('input[name="qty"]').val('');
        $('input[name="total_cost"]').val('');
    }
    $(document).ready(function() {
        $(document).on('click', '.btn-selectitem', function(e) {
            e.preventDefault();

            var itemId = $(this).data('id');
            var itemName = $(this).closest('tr').find('td:eq(1)').text();
            var unitId = $(this).closest('tr').find('td:eq(0)').text();
            var unitName = $(this).closest('tr').find('td:eq(2)').text();
            var itemCost = $(this).closest('tr').find('td:eq(3)').text();

            $('input[name="item_id"]').val(itemId);
            $('input[name="item_name"]').val(itemName);
            $('input[name="unit_id"]').val(unitId);
            $('input[name="unit_name"]').val(unitName);
            $('input[name="item_cost"]').val(itemCost);

            resetFormFields();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'GET',
            url: '{{ route('getCategories') }}',
            dataType: 'json',
            success: function(response) {
                var select = $('#categorySelect');
                select.empty();
                select.append('<option disabled selected>Select</option>');
                $.each(response.categories, function(index, category) {
                    select.append('<option value="' + category.id + '">' + category
                        .category_name + '</option>');
                });
            },
            error: function(error) {
                console.error('Error fetching categories:', error);
            }
        });

        $('.shop-btn').on('click', function() {
            var categoryId = $(this).data('category-id');
            var categoryName = $(this).closest('.rounded').find('h3').text();
            var selectedCategoryDropdown = $('#categorySelect');

            selectedCategoryDropdown.find('option[value="selectedCategory"]').remove();

            if (categoryId) {
                selectedCategoryDropdown.append('<option value="' + categoryId + '" selected>' +
                    categoryName + '</option>');
            } else {
                selectedCategoryDropdown.append('<option disabled selected>Select</option>');
            }
        });
    });
</script>