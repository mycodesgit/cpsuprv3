@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Dashboard</h1>
                <div class="row g-4 mb-5">
                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 class="fw-bold h1">10</h3>
                                        <span>Active Users</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-user-check fs-1 text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 class="fw-bold h1">10</h3>
                                        <span>Pending Pr's</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-file fs-1 text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 class="fw-bold h1">10</h3>
                                        <span>Canceled Pr's</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-file fs-1 text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-12">
                        <div class="card card-animate">
                            <div class="card-body p-6">
                                <div class="d-flex justify-content-between pb-2">
                                    <div>
                                        <h3 class="fw-bold h1">10</h3>
                                        <span>Deactivated Users</span>
                                    </div>
                                    <div>
                                        <i class="ti ti-user-x fs-1 text-danger"></i>
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
