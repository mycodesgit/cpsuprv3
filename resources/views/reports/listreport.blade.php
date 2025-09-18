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
            <h5>Report Consolidation 1</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('consolidateGen_reports') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
                                @csrf
                                
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label>Date Start:</label>
                                            <input type="date" name="start_date" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Date End:</label>
                                            <input type="date" name="end_date" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Category:</label>
                                            <select  id="category-dropdown" name="cat_id" class="form-control form-control-sm">
                                                <option disabled selected>-- Select --</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">Search</button>
                                        </div>
                                    </div>
                                </div>


                            {{--  <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>PR Number:</label>
                                            <input type="text" name="pr_no" class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Category:</label>
                                            <select  id="category-dropdown" name="cat_id" class="form-control form-control-sm">
                                                <option disabled selected>-- Select --</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div> 

                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">Search</button>
                                        </div>--}}
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
