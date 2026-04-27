@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-4 mb-4">Pending PR</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List of Pending PR
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-2 p-2">
                                    <table id="pendingCheckerTable" class="table table-hover" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                                <th>Date Submitted</th>
                                                <th>Campus</th>
                                                <th>Transaction No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th width="10%">Actions</th>
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
                    <h6 class="modal-title" id="prcheckingModalLabel">Checking PR Status</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editprcheckingForm">
                    <div class="modal-body">
                        <input type="hidden" name="purpose_id" id="editPRcheckingId">
                        <input type="hidden" name="trnsacno" id="editPRcheckingTrnsacno" placeholder="Transaction No." required>
                        <input type="hidden" name="userid" id="editPRcheckingUserid" placeholder="User ID." required>
                        <input type="hidden" name="userprno" id="editPRcheckingPRno" placeholder="PRno." required>
                        <div class="col-md-12 mb-3">
                            <label for="editPRstatus">PR Status: <span class="text-danger">*</span></label>
                            <select class="form-control" name="prstatus" id="editPRstatus">
                                <option disabled selected>Select</option>
                                <option value="3">Return to Client</option>
                                <option value="4">Checking PR</option>
                                <option value="5">Checking PPMP</option>
                                <option value="6">Endorse PR to Budget Office</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editPRremarks">PPMP Remarks Verification: <span class="text-danger">*</span></label>
                            <input type="text" name="ppmp_remarks" class="form-control" id="editPRremarks">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editPRverifystatus">PR Status: <span class="text-danger">*</span></label>
                            <select class="form-control" name="prverifystatus" id="editPRverifystatus">
                                <option disabled selected>Select</option>
                                <option value="1">With PPMP</option>
                                <option value="2">Without PPMP</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success text-light">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(request()->routeIs(['pendingAllListRead']))
        <script>
            var allPendingRoute = "{{ route('getpendingAllListRead') }}";
            var pendingAllListViewRoute = "{{ route('pendingAllListView', '') }}";
            var pendingAllCheckingStatusUpdateRoute = "{{ route('checkingPR', ['id' => ':id']) }}";
            var appidEncryptRoute = "{{ route('idcrypt') }}";
        </script>
    @endif
@endsection
