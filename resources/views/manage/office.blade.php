@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-4 mb-4">Office</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List
                                </h6>
                            </div>
                            <div class="card-body">
                                <table id="officeTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Office</th>
                                            <th>Abbreviation</th>
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

    <div class="modal fade" id="editOfficeModal" tabindex="-1" role="dialog" aria-labelledby="editOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editOfficeModalLabel">Edit Office Name</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editOfficeForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editOfficeId">
                        <div class="col-md-12 mb-3">
                            <label for="editOfficeName">Office Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editOfficeName" name="office_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editOfficeAbbr">Abbreviation: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editOfficeAbbr" name="office_abbr" required>
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
        var officeReadRoute = "{{ route('getofficeRead') }}";
        var officeCreateRoute = "{{ route('officeCreate') }}";
        var officeUpdateRoute = "{{ route('officeUpdate', ['id' => ':id']) }}";
        var officeDeleteRoute = "{{ route('officeDelete', ['id' => ':id']) }}";

        var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
        var isProcurementOfficer = '{{ Auth::guard("web")->user()->role == "Procurement Officer" ? true : false }}';
        var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';
    </script>

@endsection
