@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>List of Pending PR</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="pendingCheckerTable" class="table table-hover styled-table">
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
    </section>

    <div class="modal fade" id="prcheckingModal" tabindex="-1" role="dialog" aria-labelledby="prcheckingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="prcheckingModalLabel">Checking PR Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editprcheckingForm">
                    <div class="modal-body">
                        <input type="hidden" name="purpose_id" id="editPRcheckingId">
                        <input type="hidden" name="trnsacno" id="editPRcheckingTrnsacno" placeholder="Transaction No." required>
                        <input type="hidden" name="userid" id="editPRcheckingUserid" placeholder="User ID." required>
                        <input type="hidden" name="userprno" id="editPRcheckingPRno" placeholder="PRno." required>
                        <div class="form-group">
                            <label for="editPRstatus"><span class="badge badge-secondary">PR Status</span></label>
                            <select class="form-control" name="prstatus" id="editPRstatus">
                                <option disabled selected>Select</option>
                                <option value="3">Return to Client</option>
                                <option value="4">Checking PR</option>
                                <option value="5">Checking PPMP</option>
                                <option value="6">Endorse PR to Budget Office</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editPRremarks"><span class="badge badge-secondary">PPMP Remarks Verification:</span></label>
                            <input type="text" name="ppmp_remarks" class="form-control" id="editPRremarks">
                        </div>
                        <div class="form-group">
                            <label for="editPRverifystatus"><span class="badge badge-secondary">PR Status</span></label>
                            <select class="form-control" name="prverifystatus" id="editPRverifystatus">
                                <option disabled selected>Select</option>
                                <option value="1">With PPMP</option>
                                <option value="2">Without PPMP</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewPrModal" tabindex="-1" role="dialog" aria-labelledby="viewPrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="max-width: 80vw;">
            <div class="modal-content">
                <div class="modal-header p-3" style="background-color: #f6f6f6; color: #000;">
                    <h5 class="modal-title" id="viewPrModalLabel">Purchase Request Details</h5>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editCategoryForm">
                    <div class="modal-body p-0" id="modalContent">
                        <div class="text-center">Loading...</div>
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
