<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).on('click', '.received-pr', function(e) {
        e.preventDefault();

        var approvedReceivedViewRoute = '{{ route('receivedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to mark this PR as received?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedReceivedViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as received!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.canvassing-pr', function(e) {
        e.preventDefault();
        var approvedCanvassingViewRoute = '{{ route('canvassingPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            // title: 'Are you sure?',
            // text: "Do you want to mark this PR as canvassing?",
            title: 'Do you want to mark this PR as canvassing? Select a date:',
            html: `
                <input type="date" id="canvassingDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('canvassingDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedCanvassingViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as Canvassing!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.canvassed-pr', function(e) {
        e.preventDefault();
        var approvedCanvassedViewRoute = '{{ route('canvassedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Do you want to mark this PR as canvassed? Select a date:',
            html: `
                <input type="date" id="canvassedDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('canvassedDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedCanvassedViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as canvassed!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.posting-pr', function(e) {
        e.preventDefault();
        var approvedPostingViewRoute = '{{ route('philgepspostingPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Do you want to mark this PR for posting? Select a date:',
            html: `
                <input type="date" id="postingDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('postingDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedPostingViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as posting!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.posted-pr', function(e) {
        e.preventDefault();
        var approvedPostedViewRoute = '{{ route('postedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Do you want to mark this PR for posted? Select a date:',
            html: `
                <input type="date" id="postedDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('postedDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedPostedViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as posted!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.bidding-pr', function(e) {
        e.preventDefault();
        var approvedBiddingViewRoute = '{{ route('biddingPR') }}';
        var prId = $(this).data('id');

         Swal.fire({
            title: 'Do you want to mark this PR for bidding? Select a date:',
            html: `
                <input type="date" id="biddingDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('biddingDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedBiddingViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as bidding!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.consolidation-pr', function(e) {
        e.preventDefault();
        var approvedConsolidationViewRoute = '{{ route('consolidationPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Do you want to mark this PR for consolation? Select a date:',
            html: `
                <input type="date" id="consolidateDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('consolidateDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedConsolidationViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as consolidation!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.awarded-pr', function(e) {
        e.preventDefault();
        var approvedAwardViewRoute = '{{ route('awardedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Do you want to mark this PR as awarded? Select a date:',
            html: `
                <input type="date" id="awardDate" class="swal2-input" required>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const selectedDate = document.getElementById('awardDate').value;
                if (!selectedDate) {
                    Swal.showValidationMessage('Please select a date');
                }
                return selectedDate;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedAwardViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        selected_date: result.value,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as award!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.purchased-pr', function(e) {
        e.preventDefault();
        var approvedPurchasedViewRoute = '{{ route('purchasedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to mark this PR as purchased?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedPurchasedViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as purchased!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.returned-pr', function(e) {
        e.preventDefault();
        var approvedReturnedViewRoute = '{{ route('rerturnedPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to mark this PR as returned?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: approvedReturnedViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as returned!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).on('click', '.forwarded-pr', function(e) {
        e.preventDefault();
        var forwardedPedoViewRoute = '{{ route('forwardedPedoPR') }}';
        var prId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to mark this PR as forwarded?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, mark it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: forwardedPedoViewRoute,
                    method: 'POST',
                    data: {
                        id: prId,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Marked as forwarded!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong!',
                            text: error,
                            customClass: {
                                container: 'my-swal-on-top'
                            }
                        });
                        console.error(error);
                    }
                });
            }
        });
    });
</script>