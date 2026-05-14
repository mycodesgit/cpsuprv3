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
                                <ul class="nav nav-pills mb-3 bg-light p-2 rounded-2 overflow-auto flex-nowrap" id="pills-tab" role="tablist" style="white-space: nowrap;">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-one-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-one" type="button" role="tab"
                                            aria-controls="pills-one" aria-selected="true">
                                            All PR
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-two-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-two" type="button" role="tab"
                                            aria-controls="pills-two" aria-selected="false" tabindex="-1">
                                            Approved
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-three-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-three" type="button" role="tab"
                                            aria-controls="pills-three" aria-selected="false" tabindex="-1">
                                            Received
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-four-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-four" type="button" role="tab"
                                            aria-controls="pills-four" aria-selected="false" tabindex="-1">
                                            Canvassing
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-five-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-five" type="button" role="tab"
                                            aria-controls="pills-five" aria-selected="false" tabindex="-1">
                                            Canvassed
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-six-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-six" type="button" role="tab"
                                            aria-controls="pills-six" aria-selected="false" tabindex="-1">
                                            PhilgepsPosting
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-seven-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-seven" type="button" role="tab"
                                            aria-controls="pills-seven" aria-selected="false" tabindex="-1">
                                            Posted
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-eight-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-eight" type="button" role="tab"
                                            aria-controls="pills-eight" aria-selected="false" tabindex="-1">
                                            Bidding
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-nine-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-nine" type="button" role="tab"
                                            aria-controls="pills-nine" aria-selected="false" tabindex="-1">
                                            Consolidation
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-ten-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-ten" type="button" role="tab"
                                            aria-controls="pills-ten" aria-selected="false" tabindex="-1">
                                            Awarded
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-eleven-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-eleven" type="button" role="tab"
                                            aria-controls="pills-eleven" aria-selected="false" tabindex="-1">
                                            Purchased
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-fortheen-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-fortheen" type="button" role="tab"
                                            aria-controls="pills-fortheen" aria-selected="false" tabindex="-1">
                                            Direct Acquisition
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-twelve-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-twelve" type="button" role="tab"
                                            aria-controls="pills-twelve" aria-selected="false" tabindex="-1">
                                            Returned
                                        </button>
                                    </li>
                                    &nbsp;
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-thirteen-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-thirteen" type="button" role="tab"
                                            aria-controls="pills-thirteen" aria-selected="false" tabindex="-1">
                                            Forwarded to PEDO
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2">
                                            <table id="prall" class="table table-hover styled-table" style="width: 100%">
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
                                                        <th>Printed</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prapproved" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Received</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
                                                        <th>Office</th>
                                                        <th>Purpose</th>
                                                        <th>Category</th>
                                                        <th>Status</th>
                                                        <th>Printed</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-three" role="tabpanel" aria-labelledby="pills-three-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prreceived" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Received</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-four" role="tabpanel" aria-labelledby="pills-four-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prcanvassing" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Canvassing</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-five" role="tabpanel" aria-labelledby="pills-five-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prcanvassed" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Canvassed</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-six" role="tabpanel" aria-labelledby="pills-six-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prphilgep" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date PhilgepsPosting</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-seven" role="tabpanel" aria-labelledby="pills-seven-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prposting" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Posted</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-eight" role="tabpanel" aria-labelledby="pills-eight-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="fuckxxyoubid" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Bidding</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-nine" role="tabpanel" aria-labelledby="pills-nine-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="consolidatePR" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Consolidation</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-ten" role="tabpanel" aria-labelledby="pills-ten-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="praward" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Awarded</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-eleven" role="tabpanel" aria-labelledby="pills-eleven-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prbakal" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Purchased</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-twelve" role="tabpanel" aria-labelledby="pills-twelve-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prreturntoidontknow" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Returned</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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
                                    <div class="tab-pane fade" id="pills-thirteen" role="tabpanel" aria-labelledby="pills-thirteen-tab" tabindex="0">
                                        <div class="table-responsive mt-2 p-2" style="overflow-x: hidden;">
                                            <table id="prpedo" class="table table-hover styled-table" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th>Date Submitted</th>
                                                        <th>Date Forwarded PEDO</th>
                                                        <th>Campus</th>
                                                        <th>PR No.</th>
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

    <div class="modal fade" id="menuAllModal" tabindex="-1" role="dialog" aria-labelledby="menuAllModalLabel" aria-hidden="true" style="z-index: 9998">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="menuAllModalLabel">Select Option Menu</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block received-pr"><i class="fas fa-check"></i> Received</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block canvassing-pr"><i class="fas fa-file-excel"></i> Canvassing</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block canvassed-pr"><i class="fas fa-file-pdf"></i> Canvassed</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block posting-pr"><i class="fas fa-file"></i> Philgeps Posting</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block posted-pr"><i class="fas fa-newspaper"></i> Posted</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block consolidation-pr"><i class="fas fa-ruler-combined"></i> Consolidation</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block bidding-pr"><i class="fas fa-file-contract"></i> Bidding</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block awarded-pr"><i class="fas fa-award"></i> Awarded</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block purchased-pr"><i class="fas fa-cart-shopping"></i> Purchased</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block returned-pr"><i class="fas fa-right-left"></i> Returned</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block forwarded-pr"><i class="fas fa-forward-step"></i> Forwarded to PEDO</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(request()->routeIs(['approvedListAllRead']))
        <script>
            var allPrRoute = "{{ route('getAllprappListRead') }}";
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
            var allreturnedRoute = "{{ route('getAllreturnedListRead') }}";
            var allpedoRoute = "{{ route('getAllpedoListRead') }}";

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

            var pracrhiveDeleteRoute = "{{ route('prarchDelete', ['id' => ':id']) }}";
        </script>
    @endif
@endsection
