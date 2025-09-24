@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Users</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-user">
                                <i class="fas fa-user-plus"></i> Add New
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="userviewTable" class="table table-hover styled-table">
                                    <thead>
                                        <tr>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Campus</th>
                                            <th>Office</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Allowed</th>
                                            <th>Action</th>
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
    </section>

    <div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog" aria-labelledby="editInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60vw;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editInfoModalLabel">Edit User Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editInfoForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edituserId">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="editfirstname">First Name</label>
                                    <input type="text" class="form-control" id="editfirstname" name="fname" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-4">
                                    <label for="editmiddlename">Middle Name</label>
                                    <input type="text" class="form-control" id="editmiddlename" name="mname" oninput="this.value = this.value.toUpperCase()">
                                </div>
                                <div class="col-md-4">
                                    <label for="editlastname">Last Name</label>
                                    <input type="text" class="form-control" id="editlastname" name="lname" oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="editusername">Username</label>
                                    <input type="text" class="form-control" id="editusername" name="username">
                                </div>
                                <div class="col-md-4">
                                    <label for="editoffice">Office</label>
                                    <select name="office_id" id="editoffice" class="form-control">
                                        @foreach ($off as $dataoff)
                                            <option value="{{ $dataoff->id }}">{{ $dataoff->office_abbr }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="editgender">Gender</label>
                                    <select name="gender" class="form-control" id="editgender">
                                        <option value=""> --- Select ---</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="editrole">Role</label>
                                    <select name="role" class="form-control" id="editrole">
                                        <option value=""> --- Select ---</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Budget Officer">Budget Officer</option>
                                        <option value="Procurement Officer">Procurement Officer</option>
                                        <option value="Campus Admin">Campus Admin</option>
                                        <option value="Dean">Dean</option>
                                        <option value="Office Head">Office Head</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="editcampus">Campus</label>
                                    <select name="campus_id" class="form-control" id="editcampus">
                                        <option value=""> --- Select ---</option>
                                        @foreach ($camp as $datacamp)
                                            <option value="{{ $datacamp->id }}">{{ $datacamp->campus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="editpermission">Permission:</label>
                                    <select name="isAllowed" class="form-control" aria-invalid="false" id="editpermission">
                                        <option value=""> --- Select ---</option>
                                        <option value="Yes">Yes Allowed</option>
                                        <option value="No" selected="">Not Allowed</option>
                                    </select>
                                </div>
                            </div>
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

    <div class="modal fade" id="editPasswordModal" tabindex="-1" role="dialog" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editPasswordForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editPasswordId">
                        <div class="form-group">
                            <label for="editPasswordName">Enter New Password</label>
                            <input type="text" class="form-control" id="editPasswordName" name="password">
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

    <div class="modal fade" id="editUstatusModal" tabindex="-1" role="dialog" aria-labelledby="editUstatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUstatusModalLabel">Edit User Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUstatusForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUstatusId">
                        <div class="form-group">
                            <label for="editUstatusName">Select User Status</label>
                            <select name="ustatus" id="editUstatusName" class="form-control">
                                <option disabled selected> --Select-- </option>
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

    @include('modal.userAddmodal')

    @if(request()->routeIs(['userRead']))
        <script>
            var allUsersRoute = "{{ route('getuserRead') }}";
            var userCreateRoute = "{{ route('userCreate') }}";
            var userUpdateRoute = "{{ route('userUpdate', ['id' => ':id']) }}";
            var userPassUpdateRoute = "{{ route('userUpdatePassword', ['id' => ':id']) }}";
            var userStatusUpdateRoute = "{{ route('userUpdateStatus', ['id' => ':id']) }}";
            var userDeleteRoute = "{{ route('userDelete', ['id' => ':id']) }}";

            var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
            var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';
        </script>
    @endif
@endsection
