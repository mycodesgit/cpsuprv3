@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>List of Approved PR</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="apprved-tab1" data-toggle="tab" href="#apprved" role="tab" aria-controls="apprved" aria-selected="true" style="font-weight: bold; color: #000;">
                                        Approved
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="received-tab1" data-toggle="tab" href="#received" role="tab" aria-controls="received" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Received
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="canvassing-tab1" data-toggle="tab" href="#canvassing" role="tab" aria-controls="canvassing" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Canvassing
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="canvassed-tab1" data-toggle="tab" href="#canvassed" role="tab" aria-controls="canvassed" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Canvassed
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="philgeps-tab1" data-toggle="tab" href="#philgeps" role="tab" aria-controls="philgeps" aria-selected="false" style="font-weight: bold; color: #000;">
                                        PhilgepsPosting
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="posted-tab1" data-toggle="tab" href="#posted" role="tab" aria-controls="posted" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Posted
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="bidding-tab1" data-toggle="tab" href="#bidding" role="tab" aria-controls="bidding" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Bidding
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="consoltation-tab1" data-toggle="tab" href="#consoltation" role="tab" aria-controls="consoltation" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Consoltation
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="awarded-tab1" data-toggle="tab" href="#awarded" role="tab" aria-controls="awarded" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Awarded
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="purchased-tab1" data-toggle="tab" href="#purchased" role="tab" aria-controls="purchased" aria-selected="false" style="font-weight: bold; color: #000;">
                                        Purchased
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab3Content">
                                <div class="tab-pane fade active show" id="apprved" role="tabpanel" aria-labelledby="apprved-tab1">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="prapproved" class="table table-hover styled-table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Campus</th>
                                                    <th width="8%">PR No.</th>
                                                    <th>Type</th>
                                                    <th>Office</th>
                                                    <th>Purpose</th>
                                                    <th>Category</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="received" role="tabpanel" aria-labelledby="received-tab1">
                                    <table id="prreceived" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="canvassing" role="tabpanel" aria-labelledby="canvassing-tab1">
                                    <table id="prcanvassing" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="canvassed" role="tabpanel" aria-labelledby="canvassed-tab1">
                                    <table id="prcanvassed" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="philgeps" role="tabpanel" aria-labelledby="philgeps-tab1">
                                    <table id="prphilgep" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="posted" role="tabpanel" aria-labelledby="posted-tab1">
                                    <table id="prposting" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="bidding" role="tabpanel" aria-labelledby="bidding-tab1">
                                    <table id="fuckxxyoubid" class="table table-hover styled" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="consoltation" role="tabpanel" aria-labelledby="consoltation-tab1">
                                    <table id="consolidatePR" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="awarded" role="tabpanel" aria-labelledby="awarded-tab1">
                                    <table id="praward" class="table table-hover styled" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="purchased" role="tabpanel" aria-labelledby="purchased-tab1">
                                    <table id="prbakal" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Campus</th>
                                                <th>PR No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
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
    </section>

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

    @if(request()->routeIs(['approvedListAllRead']))
        <script>
            var allApprovedRoute = "{{ route('getAllapprovedListRead') }}";
            var allReceivedRoute = "{{ route('getAllreceivedListRead') }}";
            var allCanvassingRoute = "{{ route('getAllcanvassingListRead') }}";
            var allCanvassedRoute = "{{ route('getAllcanvassedListRead') }}";
            var allPhilgepRoute = "{{ route('getAllphilgepListRead') }}";
            var allPostingRoute = "{{ route('getAllpostingListRead') }}";
            var allBddngLantadRoute = "{{ route('getAllfuckyouListRead') }}";
            var allConsolidatdprRoute = "{{ route('getAllmadapakconsolListRead') }}";
            var allPAwardRoute = "{{ route('getAllawardListRead') }}";
            var allpurchaseRoute = "{{ route('getAllpurchaseListRead') }}";

            var allApprovedCountRoute = "{{ route('approvedListAllRead') }}";

            var approvedAllListViewRoute = "{{ route('approvedAllListView', '') }}";

            var approvedReceivedViewRoute = "{{ route('receivedPR') }}";
            var approvedCanvassingViewRoute = "{{ route('canvassingPR') }}";
            var approvedCanvassedViewRoute = "{{ route('canvassedPR') }}";
            var approvedPostingViewRoute = "{{ route('philgepspostingPR') }}";
            var approvedPostedViewRoute = "{{ route('postedPR') }}";
            var approvedBiddingViewRoute = "{{ route('biddingPR') }}";
            var approvedConsolidationViewRoute = "{{ route('consolidationPR') }}";
            var approvedAwardViewRoute = "{{ route('awardedPR') }}";
            var approvedPurchasedViewRoute = "{{ route('purchasedPR') }}";
            var forwardedPedoViewRoute = "{{ route('forwardedPedoPR') }}";
            var approvedReturnedViewRoute = "{{ route('rerturnedPR') }}";

            var userRole = "{{ Auth::user()->role }}";
        </script>
    @endif

@endsection
