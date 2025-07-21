<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right"
    };
    $(document).ready(function(){
        $('#requestpr').submit(function(e){
            e.preventDefault(); 
            var formData = $(this).serialize();
            
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                success: function(response){
                    if(response.success) {
                        toastr.success(response.message);
                        $('#itemModal').modal('hide');
                        $('#tbodycart').prepend(response.message.newrow);
                        $('#granTotal').html(response.message.totalcost);

                        $(document).trigger('itemAdded');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error){
                    console.error(xhr.responseText);
                    toastr.error(response.message);
                }
            });
        });
    });
</script>