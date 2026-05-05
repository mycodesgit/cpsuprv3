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
                <h1 class="fs-4 mb-4">Waiting PR</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List of Pending Approval Pr's
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-2 p-2">
                                    <table id="bud" class="table table-hover styled-table" style="width: 100% !important">
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
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header p-3" style="background-color: #f6f6f6; color: #000;">
                    <h6 class="modal-title" id="prcheckingModalLabel">Remarks</h6>&nbsp;
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editprcheckingForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editprimpurid">
                        <input type="hidden" name="purpose_id" id="editpurposeid">
                        <input type="hidden" name="office_id" id="editofficeid">
                        <input type="hidden" name="camp_id" id="editcampid">

                        <input type="hidden" name="trnsacno" id="edittrnsacno">
                        <input type="hidden" name="userid" id="edituserid">
                        
                        <div class="form-group">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Purpose: <span class="text-danger">*</span></label>
                                    <input type="text" id="editpurname" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3" style="border-bottom: 2px solid #04401f;"></div>
                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Action Taken: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="status">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="7">Approved</option>
                                        <option value="2">Not Recommended</option>
                                        <option value="3">Return To Client</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Financing Source: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="financing_source">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="1">General Fund (MDS Fund)</option>
                                        <option value="2">Off-Budget Fund</option>
                                        <option value="3">Custodial Fund</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Fund Cluster: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="fund_cluster">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="RAF">Regular Agency Fund</option>
                                        <option value="IGI">Internally-Generated Income</option>
                                        <option value="BTI">Business Type Income</option>
                                        <option value="TF">Trust Fund</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Fund Category: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="fund_category">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="1">Specific Budget of NGAs</option>
                                        <option value="2">Special Purpose Funds</option>
                                        <option value="3">Retained Income / Funds</option>
                                        <option value="5">Revolving Funds</option>
                                        <option value="6">Trust Fund</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Authorization: <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="fund_auth">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="1">New gen. Appropriations (Current Year Budget)</option>
                                        <option value="2">Continuing Appropriations (Prior Year's Budget)</option>
                                        <option value="3">Automatic Approprations</option>
                                        <option value="4">Retained Income/Funds</option>
                                        <option value="5">Revolving Funds</option>
                                        <option value="6">Trust Receipts</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Specific Fund/Income Source: <span class="text-danger">*</span></label>
                                    <input type="text" name="specific_fund" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Reason to Action Taken: <span class="text-danger">*</span></label>
                                    <input type="text" name="reason" class="form-control form-control-sm">
                                    <span class="text-danger" style="font-size: 8pt">(Optional)</span>
                                </div>
                            </div>
                        </div>

                        <div class="page-header" style="border-bottom: 1px solid #04401f;"></div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <div class="card" style="background-color: #f7f7f7;">
                                        <div style="padding-left: 8px; padding-top: 8px; margin-bottom: -20px;">
                                            <label for="Allotment"><span class="badge badge-info">Allotment</span></label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="checkbox-wrapper-13">
                                                        <input id="mooe" type="checkbox" name="allotment[]" value="1">
                                                        <label for="mooe">MOOE</label>
                                                    </div>
                                                    <input type="text" name="mooe_amount" class="form-control form-control-sm col-sm-8" oninput="formatCurrency(this)">
                                                    <span style="font-size: 9pt; font-style: italic;" class="text-danger">(MOOE Amount)</span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="checkbox-wrapper-13">
                                                        <input id="co" type="checkbox" name="allotment[]" value="2">
                                                        <label for="co">CO</label>
                                                    </div>
                                                    <input type="text" name="co_amount" class="form-control form-control-sm col-sm-8" oninput="formatCurrency(this)">
                                                    <span style="font-size: 9pt; font-style: italic;" class="text-danger">(CO Amount)</span>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Account Code: <span class="text-danger">*</span></label>
                                                        <input type="text" name="account_code" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label>Amount: <span class="text-danger">*</span></label>
                                                        <input type="text" name="amount" class="form-control form-control-sm" oninput="formatCurrency(this)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="page-header" style="border-bottom: 1px solid #04401f;"></div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Purpose/Project: <span class="text-danger">*</span></label>
                                    <input type="text" name="purproject" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Program/Activity/Project <span class="text-danger">*</span></label>
                                    <input type="text" name="progactproject" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label>Allotment / Budget Available: <span class="text-danger">*</span></label>
                                    <input type="text" id="allotBudget" name="allotbuget" class="form-control form-control-sm" oninput="formatCurrency(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success text-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(request()->routeIs(['pendingAllBudgetListRead']))
        <script>
            var allPendingBudgetRoute = "{{ route('getpendingBudgetAllListRead') }}";
            var allReqCancelprBudgetRoute = "{{ route('getreqcancelprBudgetAllListRead') }}";
            var pendingAllListViewRoute = "{{ route('pendingAllListView', '') }}";
            var cancelreqprRoute = "{{ route('cancelreqheadPR') }}";
            var pendingApprovedPRRoute = "{{ route('approvedPR') }}";
        </script>
    @endif
@endsection
