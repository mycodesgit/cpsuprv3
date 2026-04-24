@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Announcements</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-bell"></i> Notice of Closed Purchase Request
                                </h6>
                            </div>
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

                                    <div class="form-group mt-3">
                                        <div class="row g-3">
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
                                    
                                    <div class="form-group mt-3">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <button type="reset" class="btn btn-outline-secondary">
                                                    Clear
                                                </button>
                                                <button type="submit" name="btn-submit" class="btn btn-success text-light">
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
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-bell"></i> Announcements and Posting Updates
                                </h6>
                            </div>
                            <div class="card-body">
                                <button type="button" class="btn btn-success text-light" data-bs-toggle="modal" data-bs-target="#modal-addOtherAnnounceModal">
                                    <i class="fas fa-plus"></i> Add Announcements and Posting Updates
                                </button>
                                <div class="table-responsive mt-2 p-2">
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
            </div>
        </div>
    </div>

    @include('modal.otherAnnounceAddmodal')

    <div class="modal fade" id="editOtherAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="editOtherAnnounceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOtherAnnounceModalLabel">Edit Announcements and Posting Updates</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editOtherAnnounceForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editOtherAnnounceId">
                        <div class="form-group">
                            <label for="editOtherAnnounceName">Announcements and Posting Updates: <span class="text-danger">*</span></label>
                            <textarea class="form-control summernoteotheredit" id="editOtherAnnounceName" name="otherannouncement"></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="editOtherAnnounceStatus">Announcement Status: <span class="text-danger">*</span></label>
                            <select name="status" id="editOtherAnnounceStatus" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="2">Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success text-light">Save changes</button>
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
