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
    </style>

    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Archived</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-search"></i> Search Archived PRs
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('archiveShow') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <div class="row g-3">
                                            <div class="col-md-2">
                                                <label>Year:</label>
                                                <select name="year" class="form-control form-control-sm">
                                                    <?php
                                                        $fixedYears = [2024, 2025];
                                                        $currentYear = date("Y");

                                                        $years = array_unique(array_merge($fixedYears, [$currentYear]));
                                                        sort($years);

                                                        foreach ($years as $year) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label>&nbsp;</label><br>
                                                <button type="submit" class="btn btn-success btn-sm text-light">
                                                    <i class="fas fa-search"></i> Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-2 p-2">
                                            <table id="prarchiveTable" class="table table-hover styled-table" style="width: 100%"> 
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
                                                    {{-- @foreach ($prarchivedata as $item)
                                                        <tr>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                            <td>{{ $item->cpdate }}</td>
                                                        </tr>
                                                    @endforeach --}}
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
                                <a href="#" class="btn btn-success btn-block received-pr"><i class="fas fa-check"></i> Received PR</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block canvassing-pr"><i class="fas fa-file-excel"></i> Canvassing PR</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block canvassed-pr"><i class="fas fa-file-pdf"></i> Canvassed PR</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block posting-pr"><i class="fas fa-file"></i> Philgeps Posting</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block posted-pr"><i class="fas fa-newspaper"></i> Posted PR</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block consolidation-pr"><i class="fas fa-ruler-combined"></i> Consolidation PR</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block bidding-pr"><i class="fas fa-file-contract"></i> Bidding PR</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block awarded-pr"><i class="fas fa-award"></i> Awarded PR</a>
                            </div>
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block purchased-pr"><i class="fas fa-cart-shopping"></i> Purchased PR</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="row g-2 justify-content-center">
                            <div class="col-md-4 text-center">
                                <a href="#" class="btn btn-success btn-block returned-pr"><i class="fas fa-right-left"></i> Returned PR</a>
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

    <script>
        var allApprovedRoute = "{{ route('getarchivedprListRead') }}";
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
@endsection
