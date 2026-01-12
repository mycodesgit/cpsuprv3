@extends('layouts.master')

@section('body')
    <style>
        .form-control-sm {
            height: calc(1.5em + .5rem + 2px) !important;
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
            border-radius: .2rem !important;
        }
    </style>
    
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Search PR in Archived</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('archiveShow') }}" class="form-horizontal add-form" id="archiveFormpr" method="GET">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label>Year:</label>
                                            <select name="year" class="form-control form-control-sm">
                                                <?php
                                                $fixedYears = [2024, 2025];
                                                $currentYear = date("Y");
                                                $years = array_unique(array_merge($fixedYears, [$currentYear]));
                                                sort($years);

                                                $selectedYear = request('year'); // get selected year from URL

                                                foreach ($years as $year) {
                                                    $selected = ($selectedYear == $year) ? 'selected' : '';
                                                    echo "<option value='$year' $selected>$year</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label><br>
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </div>  
                            </form>

                            <hr>

                            <div class="row">
                                <div class="col-md-12">
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

    <div class="modal fade" id="menuAllModal" role="dialog" aria-labelledby="menuAllModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="menuAllModalLabel">Select Option Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="form-group">
                        <a href="#" class="btn btn-primary received-pr"><i class="fas fa-check"></i> Received PR</a>
                        <a href="#" class="btn btn-primary canvassing-pr"><i class="fas fa-file-excel"></i> Canvassing PR</a>
                        <a href="#" class="btn btn-primary canvassed-pr"><i class="fas fa-file-pdf"></i> Canvassed PR</a>
                        <a href="#" class="btn btn-primary posting-pr"><i class="fas fa-file"></i> Philgeps Posting</a>
                        <a href="#" class="btn btn-primary posted-pr"><i class="fas fa-newspaper"></i> Posted PR</a>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-primary consolidation-pr"><i class="fas fa-ruler-combined"></i> Consolidation PR</a>
                        <a href="#" class="btn btn-primary bidding-pr"><i class="fas fa-file-contract"></i> Bidding PR</a>
                        <a href="#" class="btn btn-primary awarded-pr"><i class="fas fa-award"></i> Awarded PR</a>
                        <a href="#" class="btn btn-primary purchased-pr"><i class="fas fa-cart-shopping"></i> Purchased PR</a>
                        <a href="#" class="btn btn-primary returned-pr"><i class="fas fa-right-left"></i> Returned PR</a>
                    </div>
                    <div class="form-group">
                        <a href="#" class="btn btn-primary forwarded-pr"><i class="fas fa-forward-step"></i> Forwarded to PEDO</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
