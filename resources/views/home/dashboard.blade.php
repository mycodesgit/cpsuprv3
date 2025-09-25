@extends('layouts.master')

@section('body')
    <style>
        .bgm {
            background-image: url(template/assets/img/announceBg.png);
            background-size: cover;
            background-position: center;
        }
        .date-box {
            background: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 15px;
            color: #333;
            text-align: center;
        }
        .date-separator {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }
        textarea {
            width: 100%;
            height: 450px;
            padding: 12px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        } 
        .modal-xl {
            max-width: 1340px; /* same as Bootstrap 4.2+ modal-xl */
        }
    </style>
    <section class="section">
        <div class=""
            style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Dashboard</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="bg-welcome d-lg-flex justify-content-between align-items-center py-6 py-lg-3 px-8 text-center text-lg-start rounded">
                                <div class="d-lg-flex align-items-center">
                                    <img src="{{ asset('template/assets/img/products/icons8-basket-96.png') }}" alt="" class="img-fluid" style="" width="100" />
                                    <div class="">
                                        <h1 class="" style="text-align: left;">Welcome to CPSU Purchase Request</h1>
                                        <span style="text-align: left; font-family: Bookman Old Style;">
                                            Streamline your purchasing process with this <span class="text-primary">Platform</span>. Submit your requests effortlessly and <b>ensure a smooth experience.</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Auth::guard('web')->user()->role != 'Checker' && Auth::guard('web')->user()->role != 'MIS Checker')
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-info">
                                        <i class="fas fa-cart-shopping"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Total PR's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $countppending }} <span style="font-size: 9pt">this month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Pending Pr's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $countppending }} <span style="font-size: 9pt">this month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                        <i class="fas fa-arrow-right-arrow-left"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Canceled PR's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $countpreturned }} <span style="font-size: 9pt">this month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-dark">Other Announcement</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    @forelse($otherupdates as $dataotherupdates)
                                        <li class="media">
                                            <img class="mr-3 rounded-circle" width="30" src="{{ asset('template/assets/img/icons/system-solid-46-notification-bell-hover-bell.gif') }}" alt="avatar">
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
                    @else
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-info">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Active User's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $userActiveCount }} <span style="font-size: 9pt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-warning">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Pending Pr's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $piconcheckerpending }} <span style="font-size: 9pt">this month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                        <i class="fas fa-arrow-right-arrow-left"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Canceled PR's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $piconcheckercancel }} <span style="font-size: 9pt">this month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-danger">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Deactivated User's</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $userDeactCount }} <span style="font-size: 9pt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-success">
                                        <i class="fas fa-bars-progress"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Categories</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $categoryCount }} <span style="font-size: 9pt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-warning">
                                        <i class="fas fa-cubes-stacked"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Items</h4>
                                        </div>
                                        <div class="card-body">
                                            {{ $itemsCount }} <span style="font-size: 9pt"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                @if(Auth::guard('web')->user()->role != 'Checker' && Auth::guard('web')->user()->role != 'MIS Checker')
                    <div class="col-2 col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>PR Status</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="donutUser" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-2 col-md-4 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>PR Status</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChecker" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                @endif

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
    </section>
@endsection
