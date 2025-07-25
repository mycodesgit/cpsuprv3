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