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
                                <h4>Recent Updates</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border">
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-1.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary">Now</div>
                                            <div class="media-title">Farhan A Mujib</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-2.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">12m</div>
                                            <div class="media-title">Michelle Green</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-3.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">17m</div>
                                            <div class="media-title">Debra Stewart</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="mr-3 rounded-circle" width="50" src="{{ asset('template/assets/img/avatar/avatar-4.png') }}" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right">21m</div>
                                            <div class="media-title">Alfa Zulkarnain</div>
                                            <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                                        </div>
                                    </li>
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
                                <div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content custom-modal">
                                            <div class="modal-body bgm">
                                                <div class="error-page">
                                                    <h2 class="headline text-warning"> </h2>
                                                    <div class="error-content" style="margin-left: 370px">
                                                        <h2><i class="fas fa-exclamation-circle text-success"></i> Announcement!</h2>
                                                        <h6 style="text-align: justify-all;">
                                                            {{ $annoucement->announcement }}
                                                        </h6>
                                                        <div class="search-form text-center" style="padding-top: 30px;">
                                                            <div class="row justify-content-center">
                                                                <div class="col-md-5">
                                                                    <div class="date-box p-2">
                                                                        <strong>{{ date('F d, Y', strtotime($annoucement->datestart)) }}</strong>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                    <span class="date-separator">To</span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="date-box p-2">
                                                                        <strong>{{ date('F d, Y', strtotime($annoucement->dateend)) }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="countdown" class="col-md-12" style="padding-top: 20px; text-align: center;">
                                                            <div style="color: rgb(80, 80, 80); font-size: 24px; font-family: 'Arial', sans-serif;">Remaining Time:</div>
                                                            <div class="countdown-container" style="font-size: 50px; font-weight: bold; color: black;">
                                                                <span id="hoursBox">00</span> :
                                                                <span id="minutesBox">00</span> :
                                                                <span id="secondsBox">00</span>
                                                            </div>
                                                            <div style="font-size: 14px; color: gray; text-align: center;">
                                                                <span style="margin: 20px;">Hours</span>
                                                                <span style="margin: 20px;">Minutes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <span style="margin-right: -10px;">Seconds</span>
                                                            </div>
                                                        </div>
                                                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
