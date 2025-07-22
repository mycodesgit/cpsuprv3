@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Pending Approval Pr's</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="bud" class="table table-hover styled-table">
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
    </section>

    <div class="modal fade" id="prcheckingModal" tabindex="-1" role="dialog" aria-labelledby="prcheckingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="max-width: 80vw;">
            <div class="modal-content">
                <div class="modal-header p-3" style="background-color: #f6f6f6; color: #000;">
                    <h5 class="modal-title" id="prcheckingModalLabel">Remarks</h5>&nbsp;
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
                            <div class="form-row">
                                <div class="col-md-12" style="border-bottom: 2px solid #04401f;">
                                    <label><span class="badge badge-danger">Purpose:</span></label>
                                    <input type="text" id="editpurname" class="form-control border-0" style="background-color: transparent; margin-top: -7px; font-weight: bold" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label><span class="badge badge-secondary">Action Taken:</span></label>
                                    <select class="form-control form-control-sm" name="status">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="7">Approved</option>
                                        <option value="2">Not Recommended</option>
                                        <option value="3">Return To Client</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label><span class="badge badge-secondary">Financing Source:</span></label>
                                    <select class="form-control form-control-sm" name="financing_source">
                                        <option disabled selected> --- Select ---</option>
                                        <option value="1">General Fund (MDS Fund)</option>
                                        <option value="2">Off-Budget Fund</option>
                                        <option value="3">Custodial Fund</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label><span class="badge badge-secondary">Fund Cluster:</span></label>
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

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label><span class="badge badge-secondary">Fund Category:</span></label>
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
                                    <label><span class="badge badge-secondary">Authorization:</span></label>
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
                                    <label><span class="badge badge-secondary">Specific Fund/Income Source:</span></label>
                                    <input type="text" name="specific_fund" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label><span class="badge badge-secondary">Reason to Action Taken:</span></label>
                                    <input type="text" name="reason" class="form-control form-control-sm">
                                    <span class="text-danger" style="font-size: 8pt">(Optional)</span>
                                </div>
                            </div>
                        </div>

                        <div class="page-header" style="border-bottom: 1px solid #04401f;"></div>

                        <div class="form-group mt-2">
                            <div class="form-row">
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
                                                        <label><span class="badge badge-success">Account Code:</span></label>
                                                        <input type="text" name="account_code" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <label><span class="badge badge-danger">Amount:</span></label>
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
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label><span class="badge badge-secondary">Purpose/Project:</span></label>
                                    <input type="text" name="purproject" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label><span class="badge badge-secondary">Program/Activity/Project</span></label>
                                    <input type="text" name="progactproject" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label><span class="badge badge-secondary">Allotment / Budget Available:</span></label>
                                    <input type="text" id="allotBudget" name="allotbuget" class="form-control form-control-sm" oninput="formatCurrency(this)">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
