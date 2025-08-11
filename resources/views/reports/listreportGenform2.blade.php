@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Report Consolidation 2</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('consolidatePDFGenform2_reports') }}" id="" target="_blank">
                                {{ csrf_field() }}

                                <div class="container">
                                    <div class="form-group">
                                        <div class="form-row">
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
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Unit</th>
                                            <th>Item Description</th>
                                            <th>End User</th>
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
                                            <td>{{ $data->office_abbr }}</td>
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
    </section>
@endsection
