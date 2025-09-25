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
                                            <textarea id="summernote" name="announcement">{{ $annoucement->announcement }}</textarea>
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
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-addOtherAnnounceModal">
                                <i class="fas fa-plus"></i> Add Other Announcement
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="otherAnnounce" class="table table-hover styled-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Announcement</th>
                                        <th>PostedBy</th>
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
    </section>
    @include('modal.otherAnnounceAddmodal')

    <div class="modal fade" id="editOtherAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="editOtherAnnounceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOtherAnnounceModalLabel">Edit Other Announcement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editOtherAnnounceForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editOtherAnnounceId">
                        <div class="form-group">
                            <label for="editOtherAnnounceName">Year Name</label>
                            <textarea class="form-control summernoteotheredit" id="editOtherAnnounceName" name="otherannouncement"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editOtherAnnounceStatus">Year Status</label>
                            <select name="status" id="editOtherAnnounceStatus" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="2">Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var otherAnounceReadRoute = "{{ route('getotherAnnounceRead') }}";
        var otherAnounceCreateRoute = "{{ route('otherAnnounceCreate') }}";
        var otherAnounceUpdateRoute = "{{ route('otherAnnounceUpdate', ['id' => ':id']) }}";
        var otherAnounceDeleteRoute = "{{ route('otherAnnounceDelete', ['id' => ':id']) }}";
    </script>
@endsection
