<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        $('#ppmpForm').submit(function (event) {
            event.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let submitBtn = form.find('button[type=submit]');

            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: ppmpdetailCreateRoute,
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        let url = ppmpRowsGetPartialRoute.replace(':ppid', currentPlanId);

                        $(".load").load(url, function() {
                            initPPMPFormScripts();
                        });


                        let pdfBtn = $('.btn.btn-outline-danger');
                            pdfBtn.removeClass('disabled')
                                .attr('href', routeToPPMP) 
                                .attr('target', '_blank');
                    } else {
                        toastr.error(response.message || 'Something went wrong.');
                    }
                },
                error: function (xhr) {
                    let errorMessage = 'An error occurred';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMessage = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    toastr.error(errorMessage);
                },
                complete: function () {
                    submitBtn.prop('disabled', false).text('Save');
                }
            });
        });
    });

    // $(document).on('click', '.category-delete', function(e) {
    //     var id = $(this).val();
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //     });
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to recover this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 type: "POST",
    //                 url: categoryDeleteRoute.replace(':id', id),
    //                 success: function(response) {
    //                     $("#tr-" + id).delay(1000).fadeOut();
    //                     Swal.fire({
    //                         title: 'Deleted!',
    //                         text: 'Successfully Deleted!',
    //                         icon: 'warning',
    //                         showConfirmButton: false,
    //                         timer: 1500
    //                     });
    //                     if(response.success) {
    //                         toastr.success(response.message);
    //                         console.log(response);
    //                     }
    //                 }
    //             });
    //         }
    //     })
    // });
</script>