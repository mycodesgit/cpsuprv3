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
                            <form action="{{ route('archiveShow') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
