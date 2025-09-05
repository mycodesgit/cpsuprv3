<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    function bindPapsFormSubmit() {
        $('#papsForm').off('submit').on('submit', function(event) {
            event.preventDefault();

            let form = $(this);
            let formData = form.serialize();
            let submitBtn = form.find('button[type=submit]');

            submitBtn.prop('disabled', true).text('Saving...');

            $.ajax({
                url: papsdetailCreateRoute,
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        let url = papsRowsGetPartialRoute.replace(':ppid', currentPlanId);

                        $(".load").load(url, function(response, status, xhr) {
                            if (status === "success") {
                                //initpapsFormScripts();
                                bindPapsFormSubmit(); // ✅ rebind submit
                                //console.log("✅ .load() completed for:", url);
                            } else if (status === "error") {
                                //console.error("❌ Error loading content from:", url, "\nStatus:", xhr.status, "\nMessage:", xhr.statusText);
                                toastr.error("Failed to reload form. Please refresh the page.");
                            }
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
    }

    $(document).ready(function() {
        bindPapsFormSubmit();
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Block everything except letters, numbers, spaces, dash, and dot
    const invalidChars = /[^a-zA-Z0-9\s\.\-]/; 

    const saveBtn = document.querySelector("#saveAllBtn");
    if (saveBtn) saveBtn.style.display = "none"; // hidden initially

    // Function to validate ALL inputs in template and ppmp-rows
    function validateAllInputs() {
        let inputs = document.querySelectorAll(
            ".ppa_catsub-input, .tinput, .ppmp-row input[type='text'], .ppmp-row select"
        );

        let allValid = true;

        inputs.forEach(input => {
            let value = input.value;

            if (invalidChars.test(value)) {
                Swal.fire({
                    icon: "warning",
                    title: "Invalid Characters Found!",
                    text: "Please remove symbols like / @ # $ % & etc.",
                    confirmButtonText: "OK"
                });

                // auto-remove invalid chars
                input.value = value.replace(invalidChars, "");
                allValid = false;
            }

            if (input.value.trim() === "") {
                allValid = false;
            }
        });

        if (saveBtn) {
            saveBtn.style.display = allValid ? "inline-block" : "none";
        }
    }

    // Watch ALL inputs dynamically
    document.addEventListener("input", function (e) {
        if (
            e.target.matches(".ppa_catsub-input, .ppmp-row input[type='text'], .ppmp-row select")
        ) {
            validateAllInputs();
        }
    });
});
</script>