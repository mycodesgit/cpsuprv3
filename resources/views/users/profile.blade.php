@extends('layouts.master')

@section('body')
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card card-animate text-center">
                <div class="card-body">
                    <center>
                        <div class="avatar-circle-account text-white d-flex align-items-center justify-content-center me-2 mb-2">
                            {{ strtoupper(substr(Auth::user()->fname, 0, 1)) }}{{ strtoupper(substr(Auth::user()->lname, 0, 1)) }}
                        </div>
                    </center>
                    <h5 class="mb-1">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</h5>
                    {{-- <p class="text-muted mb-2">{{ Auth::user()->username }}</p> --}}

                    <span class="badge bg-light mb-3 text-dark">{{ Auth::user()->role }}</span>

                    {{-- <div class="d-grid">
                        <button class="btn btn-outline-primary btn-sm">
                            Edit Profile
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-animate">
                <div class="card-header pt-3">
                    <h6 class="card-title">
                        <i class="ti ti-user"></i> Account Settings
                    </h6>
                </div>

                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->fname }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->lname }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" value="johndoe@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->username }}">
                        </div>

                        <hr>

                        <h6 class="mb-3">Change Password</h6>

                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Current Password">
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="New Password">
                        </div>

                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Confirm Password">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
