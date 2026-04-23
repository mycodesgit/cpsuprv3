@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-4 mb-4">Year</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-plus"></i> Add New
                                </h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="adYear">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label>Year: <span class="text-danger">*</span></label>
                                                <input type="text" name="pryear" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-outline-success">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List
                                </h6>
                            </div>
                            <div class="card-body">
                                <table id="yearTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th width="10%">Actions</th>
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

    <div class="modal fade" id="editYearModal" tabindex="-1" role="dialog" aria-labelledby="editYearModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editYearModalLabel">Edit Year</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editYearForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editYearId">
                        <div class="col-md-12 mb-3">
                            <label for="editYearName">Year: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editYearName" name="pryear" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editYearStatus">Year Status: <span class="text-danger">*</span></label>
                            <select name="status" id="editYearStatus" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="2">Disabled</option>
                                <option value="3">Upcoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var yearReadRoute = "{{ route('getyearRead') }}";
        var yearCreateRoute = "{{ route('yearCreate') }}";
        var yearUpdateRoute = "{{ route('yearUpdate', ['id' => ':id']) }}";
        var yearDeleteRoute = "{{ route('yearDelete', ['id' => ':id']) }}";

        var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
        var isProcurementOfficer = '{{ Auth::guard("web")->user()->role == "Procurement Officer" ? true : false }}';
        var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';
    </script>

@endsection
