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

                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{ route('consolidatePDFGen_reports') }}" id="" target="_blank">
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <div class="row g-3">
                                                    <div class="col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="form-control form-control-sm btn btn-info btn-sm">Generate PDF</button>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <input type="hidden" name="start_date" value="{{ request('start_date') }}" class="form-control form-control-sm">
                                                    </div>

                                                    <div class="col-md-2">
                                                        <input type="hidden" name="end_date" value="{{ request('end_date') }}" class="form-control form-control-sm">
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="hidden" name="cat_id" value="{{ request('cat_id') }}" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="table-responsive mt-2 p-2">
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Unit</th>
                                                        <th>Item Description</th>
                                                        <th>Qty</th>
                                                        <th>Unit Cost</th>
                                                        <th>Total Cost</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                    @php $no = 1; @endphp
                                                    @foreach($itemConsolidate as $data)
                                                    <tr id="tr-{{ $data->uid }}">
                                                        <td width="10">{{ $no++ }}</td>
                                                        <td>{{ $data->unit_name }}</td>
                                                        <td>{{ $data->item_descrip }}</td>
                                                        <td>{{ $data->qty }}</td>
                                                        <td>{{ $data->item_cost }}</td>
                                                        <td>{{ number_format($data->total_cost, 2) }}</td>
                                                    </tr>
                                                    @endforeach
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
@endsection
