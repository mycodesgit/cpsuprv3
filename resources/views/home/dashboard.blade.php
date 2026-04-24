@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Dashboard</h1>
                <div class="row g-4 mb-5">
                    @if(Auth::guard('web')->user()->role != 'Checker' && Auth::guard('web')->user()->role != 'MIS Checker')
                    @else
                        <div class="col-lg-3 col-12">
                            <div class="card card-animate">
                                <div class="card-body p-6">
                                    <div class="d-flex justify-content-between pb-2">
                                        <div>
                                            <h3 class="fw-bold h1">{{ $userActiveCount }}</h3>
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
                                            <h3 class="fw-bold h1">{{ $piconcheckerpending }}</h3>
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
                                            <h3 class="fw-bold h1">{{ $piconcheckercancel }}</h3>
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
                                            <h3 class="fw-bold h1">{{ $userDeactCount }}</h3>
                                            <span>Deactivated Users</span>
                                        </div>
                                        <div>
                                            <i class="ti ti-user-x fs-1 text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-6">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <img class="mr-3 rounded-circle" width="20" src="{{ asset('template/assets/img/icons/system-solid-46-notification-bell-hover-bell.gif') }}" alt="avatar"> Announcements and Posting Updates
                                </h6>
                            </div>
                            <div class="card-body bg-light">
                                <ul class="list-unstyled list-unstyled-border" style="height:400px; overflow:auto;">
                                    @forelse($otherupdates as $dataotherupdates)
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">{!! $dataotherupdates->otherannouncement !!}</div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="media-title">No Announcement Posted</div>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
