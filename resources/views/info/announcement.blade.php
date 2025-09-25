@extends('layouts.master')

@section('body')
    <style>
        .form-control-sm {
            height: calc(1.5em + .5rem + 2px) !important;
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
            border-radius: .2rem !important;
        }
        .announcetextarea {
            box-sizing: border-box !important;
            border: 2px solid #ccc !important;
        } 
    </style>

    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Announcement and Posting Updates</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('annouceUpdate') }}" class="form-horizontal" method="post" id="purposepr">
                                @csrf
                                
                                <input type="hidden" name="id" value="{{ $annoucement->id }}">

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Annoucement:</label>
                                            <textarea class="summernote-simple announcetextarea" name="announcement">{{ $annoucement->announcement }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>Date Start:</label>
                                            <input type="date" name="datestart" class="form-control form-control-sm" value="{{ $annoucement->datestart }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Date End:</label>
                                            <input type="date" name="dateend" class="form-control form-control-sm" value="{{ $annoucement->dateend }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Status</label>
                                            <select class="form-control form-control-sm" name="status">
                                                <option disabled selected> --Select-- </option>
                                                <option value="1" {{ $annoucement->status == '1' ? 'selected="selected"' : '' }}>Off</option>
                                                <option value="2" {{ $annoucement->status == '2' ? 'selected="selected"' : '' }}>On</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="reset" class="btn btn-danger">
                                                Clear
                                            </button>
                                            <button type="submit" name="btn-submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-user">
                                <i class="fas fa-plus"></i> Add New Updates
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="" class="table table-hover styled-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Announcement</th>
                                        <th>PostedBy</th>
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
    </section>
@endsection
