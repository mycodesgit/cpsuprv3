@extends('layouts.master')

@section('body')
    <style>
        /* Background Colors */
        .bg-teal {
            background-color: #20c997 !important;
            color: #fff;
        }

        .bg-yellow {
            background-color: #ffc107 !important;
            color: #212529;
        }

        .bg-orange {
            background-color: #fd7e14 !important;
            color: #fff;
        }

        .bg-blue {
            background-color: #0d6efd !important;
            color: #fff;
        }

        .bg-gray {
            background-color: #6c757d !important;
            color: #fff;
        }

        .bg-gray-dark {
            background-color: #343a40 !important;
            color: #fff;
        }

        .bg-purple {
            background-color: #6f42c1 !important;
            color: #fff;
        }

        .bg-pink {
            background-color: #e83e8c !important;
            color: #fff;
        }

        .bg-red {
            background-color: #dc3545 !important;
            color: #fff;
        }

        .bg-cyan {
            background-color: #169db8 !important;
            color: #ffffff;
        }
        .swal2-container {
    z-index: 99999 !important;
}

.swal2-popup .swal2-input {
    pointer-events: auto !important;
}
    </style>
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-4 mb-4">Approved PR</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List of Approved PR
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-2 p-2">
                                    <table id="exampleTech" class="table table-hover" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Campus</th>
                                                <th>Transaction No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewPrModal" tabindex="-1" role="dialog" aria-labelledby="viewPrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewPrModalLabel">Purchase Request Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <div class="text-center">Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="prcheckingModal" tabindex="-1" role="dialog" aria-labelledby="prcheckingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="prcheckingModalLabel">Checking PR</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editprcheckingForm">
                    <div class="modal-body">
                        <input type="hidden" name="purpose_id" id="editPRcheckingId">
                        <input type="hidden" name="trnsacno" id="editPRcheckingTrnsacno" placeholder="Transaction No." required>
                        <input type="hidden" name="userid" id="editPRcheckingUserid" placeholder="User ID." required>
                        <input type="hidden" name="userprno" id="editPRcheckingPRno" placeholder="PRno." required>
                        <div class="form-group mt-3">
                            <label for="editPRstatus">PR Status: <span class="text-danger">*</span></label>
                            <select class="form-control" name="prstatus" id="editPRstatus">
                                <option disabled selected>Select</option>
                                <option value="3">Return to Client</option>
                                <option value="2">Endorse PR to Procurement Office</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="editPRremarks">PPMP Remarks Verification: <span class="text-danger">*</span></label>
                            <textarea name="ppmp_remarks" id="editPRremarks" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(request()->routeIs(['pendingTechCheckListRead']))
        <script>
            var allPendingTechRoute = "{{ route('getpendingTechAllListRead') }}";
            var pendingAllListViewRoute = "{{ route('pendingAllListView', '') }}";
            var pendingAllCheckingStatusUpdateRoute = "{{ route('checkingTechPR', ['id' => ':id']) }}";
            var appidEncryptRoute = "{{ route('idcrypt') }}";
        </script>
    @endif
@endsection
