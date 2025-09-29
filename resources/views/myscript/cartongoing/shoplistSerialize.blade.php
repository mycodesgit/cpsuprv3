<script>
    $(document).ready(function () {
        const table = $('#shoplist').DataTable({
            dom: 'rt<"bottom"ip>',
            ajax: {
                url: shopListRoute,
                type: "GET",
            },
            responsive: true,
            lengthChange: false,
            searching: true, // hide default search
            columns: [
                { 
                    data: 'itid',
                    render: function(data, type, row) {
                        return `<span style="color: transparent;">${data}</span>`;
                    }
                },
                {
                    data: 'item_descrip',
                    render: function (data, type, row) {
                        const fullText = data;
                        const shortText = (type === 'display' && data.length > 30)
                            ? data.substring(0, 45) + '...'
                            : data;
                        return `<span data-toggle="tooltip" title="${fullText.replace(/"/g, '&quot;')}">${shortText}</span>`;
                    }
                },
                { data: 'unit_name' },
                { data: 'item_cost' },
                { data: 'category_name' },
                { 
                    data: 'unit_id_alias',
                    render: function(data, type, row) {
                        return `<span style="color: transparent;">${data}</span>`;
                    }
                },
                { 
                    data: 'category_id',
                    render: function(data, type, row) {
                        return `<span style="color: transparent;">${data}</span>`;
                    }
                },
                {
                    data: 'itid',
                    render: function (data, type, row) {
                        return (type === 'display')
                            ? `<button type="button" data-id="${data}" class="btn btn-outline-success btn-sm btn-selectitem" data-toggle="modal" data-target="#itemModal">
                                <i class="fas fa-cart-shopping"></i> Add Cart
                            </button>` : data;
                    }
                }
            ]
        });

        // Custom search
        $('#customSearch').on('keyup', function () {
            const val = $(this).val();
            //console.log("Searching:", val); // Debug
            table.search(val).draw();
        });
        table.on('draw', function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('#customSearch').on('input', function () {
            const val = $(this).val();
            $('#clearSearch').toggle(val.length > 0);
            table.search(val).draw();
        });
        $('#clearSearch').on('click', function () {
            $('#customSearch').val('');
            $(this).hide();
            table.search('').draw();
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
            var unitId = $(this).closest('tr').find('td:eq(5)').text();
            var unitName = $(this).closest('tr').find('td:eq(2)').text();
            var itemCost = $(this).closest('tr').find('td:eq(3)').text();
            var catID = $(this).closest('tr').find('td:eq(6)').text();

            $('input[name="item_id"]').val(itemId);
            $('input[name="item_name"]').val(itemName);
            $('input[name="unit_id"]').val(unitId);
            $('input[name="unit_name"]').val(unitName);
            $('input[name="item_cost"]').val(itemCost);
            $('input[name="category_id"]').val(catID);

            if (parseFloat(itemCost) === 0) {
                $('input[name="item_cost"]').removeAttr('readonly');
            } else {
                $('input[name="item_cost"]').attr('readonly', true);
            }

            resetFormFields();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.editable-purpose-name').on('blur', function () {
            let $this = $(this);
            let newName = $this.val().trim(); // use val() instead of text()
            let purposeId = $this.data('id');

            $this.css('opacity', '0.6');

            $.ajax({
                url: "{{ route('updatePurposeName', ':id') }}".replace(':id', purposeId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    purpose_name: newName
                },
                success: function(response) {
                    toastr.success('Purpose name updated!');
                    $this.css('opacity', '1');
                },
                error: function() {
                    toastr.error('Failed to update purpose name.');
                    $this.css('opacity', '1');
                }
            });
        });
    });
</script>



