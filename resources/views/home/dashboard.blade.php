@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Dashboard</h1>
                <div class="row g-4 mb-5">
                    @if(Auth::guard('web')->user()->role != 'Checker' && Auth::guard('web')->user()->role != 'MIS Checker')
                        <div class="col-lg-3 col-12">
                            <div class="card card-animate">
                                <div class="card-body p-6">
                                    <div class="d-flex justify-content-between pb-2">
                                        <div>
                                            <h3 class="fw-bold h1">{{ $countppending }}</h3>
                                            <span>Total Pr's</span>
                                        </div>
                                        <div>
                                            <i class="ti ti-file-stack fs-1 text-success"></i>
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
                                            <h3 class="fw-bold h1">{{ $countppending }}</h3>
                                            <span>Pending Pr's</span>
                                        </div>
                                        <div>
                                            <i class="ti ti-file-time fs-1 text-warning"></i>
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
                                            <h3 class="fw-bold h1">{{ $countpreturned }}</h3>
                                            <span>Canceled Pr's</span>
                                        </div>
                                        <div>
                                            <i class="ti ti-file-off fs-1 text-danger"></i>
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
                                            <h3 class="fw-bold h1">0</h3>
                                            <span>Approved Pr's</span>
                                        </div>
                                        <div>
                                            <i class="ti ti-file-check fs-1 text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                    @php
                        $currentDate = now()->format('Y-m-d');
                    @endphp
                    @if($annoucement->datestart && $annoucement->dateend)
                        @if($currentDate >= $annoucement->datestart && $currentDate <= $annoucement->dateend && $annoucement->status == '2')
                            @if(Auth::user()->isAllowed != 'Yes' && 
                                (Auth::user()->role == 'Administrator' || 
                                    Auth::user()->role == 'Budget Officer' || 
                                    Auth::user()->role == 'Procurement Officer' || 
                                    Auth::user()->role == 'Campus Admin' || 
                                    Auth::user()->role == 'Dean' || 
                                    Auth::user()->role == 'Office Head'))
                                    @include('modal.announcePopModal')
                            @else
                                @if(Auth::user()->role=='Administrator' || 
                                Auth::user()->role=='Budget Officer' || 
                                Auth::user()->role=='Procurement Officer' || 
                                Auth::user()->role=='Campus Admin' || 
                                Auth::user()->role=='Dean' || 
                                Auth::user()->role=='Office Head' ||
                                Auth::user()->isAllowed == 'Yes')
                                    {{-- <div class="mt-5 col-lg-12">
                                        <div class="row">
                                            @foreach($category as $data)
                                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                    <div class="category-card rounded" style="background: url('{{ asset($data->bgimg) }}') no-repeat; background-size: cover;">
                                                        <div>
                                                            <h3 class="mb-0 fw-bold">
                                                                {{ $data->category_name }}
                                                            </h3>
                                                            <div class="mt-4 mb-5 fs-5">
                                                                <p class="mb-0"><br></p>
                                                                <span>
                                                                    <br>
                                                                    <span class="fw-bold text-dark"></span>
                                                                </span>
                                                            </div>
                                                            <a href="#" class="btn btn-success shop-btn" data-toggle="modal" data-target="#modal-purpose" data-category-id="{{ $data->id }}">Shop Now</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($loop->iteration % 3 == 0 && !$loop->last)
                                                    <div class="row"></div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div> --}}
                                @endif
                            @endif
                        @endif
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
