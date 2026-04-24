@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Archived</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-search"></i> Search Deleted PRs
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('archiveDeletedShow') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
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
                                            <table id="prdeletedarchiveTable" class="table table-hover styled-table" style="width: 100%">
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
    
    <script>
        var allDeletedApprovedRoute = "{{ route('getarchiveddeletedprListRead') }}";
        var approvedAllListViewRoute = "{{ route('approvedAllListView', '') }}";
    </script>
@endsection
