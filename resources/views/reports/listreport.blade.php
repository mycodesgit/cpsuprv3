@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Report Consolidation 1</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-search"></i> Search Report Consolidation 1
                                </h6>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('consolidateGen_reports') }}" class="form-horizontal add-form" id="form1Search" method="GET" target="">
                                    @csrf
                                    
                                    <div class="form-group">
                                        <div class="row g-3">
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
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
