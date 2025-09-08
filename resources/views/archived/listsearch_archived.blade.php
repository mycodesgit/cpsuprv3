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
                                                $fixedYears = [2024, 2025]; // always included
                                                $currentYear = date("Y");   // detect current year (e.g. 2025)

                                                // Merge fixed years with current year (avoid duplicates)
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
                                    <table id="prarchiveTable" class="table table-hover styled-table">
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

    <script>
        var allApprovedRoute = "{{ route('getarchivedprListRead') }}";
        var approvedAllListViewRoute = "{{ route('approvedAllListView', '') }}";
    </script>
@endsection
