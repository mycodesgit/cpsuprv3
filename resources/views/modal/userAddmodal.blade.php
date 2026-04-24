<div class="modal fade" id="modal-user">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i> Add User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
               <form class="form-horizontal" action="{{ route('userCreate') }}" method="post" id="addUser">  
                    @csrf

                    <div class="form-group mt-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>First Name: <span class="text-danger">*</span></label>
                                <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Middle Name: <span class="text-danger">*</span></label>
                                <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Last Name: <span class="text-danger">*</span></label>
                                <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Username: <span class="text-danger">*</span></label>
                                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Password: <span class="text-danger">*</span></label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Gender: <span class="text-danger">*</span></label>
                                <select name="gender" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3"> 
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label>Campus: <span class="text-danger">*</span></label>
                                <select name="campus_id" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    @foreach ($camp as $data)
                                        <option value="{{ $data->id }}">{{ $data->campus_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Office: <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="office_id">
                                    <option disabled selected> --- Select --- </option>
                                    @foreach ($off as $data)
                                        <option value="{{ $data->id }}">{{ $data->office_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Role: <span class="text-danger">*</span></label>
                                <select class="form-control" name="role">
                                    <option value=""> --- Select Role --- </option>
                                    @if(Auth::user()->role=='Administrator')
                                    <option value="Administrator">Administrator</option>
                                    @endif
                                    <option value="Budget Officer">Budget Officer</option>
                                    <option value="Procurement Officer">Procurement Officer</option>
                                    <option value="Campus Admin">Campus Admin</option>
                                    <option value="Dean">Dean</option>
                                    <option value="Office Head">Office Head</option>
                                    <option value="Checker">Checker</option>
                                    <option value="MIS Checker">MIS Checker</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success text-light">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>   
                </form>
            </div>
            
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>