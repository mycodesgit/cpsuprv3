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
        </div>
    </div>
@endsection
