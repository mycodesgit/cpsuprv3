@extends('layouts.master')

@section('body')
    <style>
        .category-card {
            height: 250px;
            /* Adjust the height as needed */
            overflow: hidden;
            position: relative;
            padding: 20px;
        }

        .category-card h3 {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .category-card .btn {
            position: absolute;
            bottom: 20px;
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
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Shop</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                @php
                    $currentDate = now()->format('Y-m-d');
                @endphp
                @if ($annoucement->datestart && $annoucement->dateend)
                    @if ($currentDate >= $annoucement->datestart && $currentDate <= $annoucement->dateend && $annoucement->status == '2')
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
                                        <div class="modal-body bgmshop">
                                            <div class="float-right" style="padding-right: 15px; padding-top: 10px">
                                                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="error-page">
                                                <h2 class="headline text-warning"> </h2>
                                                <div class="error-content" style="margin-left: 300px">
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
                                <div class="mt-5 col-lg-12">
                                    <div class="row">
                                        @foreach ($category as $data)
                                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                                <div class="category-card rounded"
                                                    style="background: url('{{ asset($data->bgimg) }}') no-repeat; background-size: cover;">
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
                                                        <a href="#" class="btn btn-success shop-btn"
                                                            data-toggle="modal" data-target="#modal-purpose"
                                                            data-category-id="{{ $data->id }}">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($loop->iteration % 3 == 0 && !$loop->last)
                                                <div class="row"></div>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{-- <div class="row" style="">
                                    @foreach ($category as $data)
                                        <div id="filterable1-cards">
                                            <div class="col-md-12">
                                                <div class="card p-0">
                                                    <img src="{{ asset('template/img/banner/prbgcat.png') }}" alt="img" />
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            <h6>{{ $data->category_name }}</h6>
                                                        </div>
                                                        <a href="#" class="btn btn-success shop-btn" data-toggle="modal" data-target="#modal-purpose" data-category-id="{{ $data->id }}">Shop Now</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if ($loop->iteration % 4 == 0 && !$loop->last)
                                            <div class="row"></div>
                                        @endif
                                    @endforeach
                                </div> --}}
                                </div>
                            @endif
                        @endif
                    @else
                        <div class="mt-5 col-lg-12">
                            <div class="row">
                                @foreach ($category as $data)
                                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                                        <div class="category-card rounded"
                                            style="background: url('{{ asset($data->bgimg) }}') no-repeat; background-size: cover;">
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
                                                <a href="#" class="btn btn-success shop-btn"
                                                    data-toggle="modal" data-target="#modal-purpose"
                                                    data-category-id="{{ $data->id }}">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($loop->iteration % 3 == 0 && !$loop->last)
                                        <div class="row"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                @endif
            </div>
        </div>
    </section>
    @include('request.add.modal')
@endsection
