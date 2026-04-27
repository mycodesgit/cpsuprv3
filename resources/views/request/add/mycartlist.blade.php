@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">My Cart</h1>
                <div class="row g-4 mb-5">
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

                                <div class="col-md-12">
                                    <div class="card card-animate overflow-hidden bg-light">
                                        <div class="row align-items-center g-0">
                                            <div class="col-md-4 text-center p-4">
                                                <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" class="img-fluid" style="max-height: 220px;">
                                            </div>
                                            <div class="col-md-8 p-4 text-center text-md-start">
                                                <span class="badge bg-secondary px-3 py-2 mb-3">ANNOUNCEMENT</span>
                                                <h1 class="fw-bold text-success mb-2" style="font-size: 2.5rem;">
                                                    PR IS CLOSED
                                                </h1>
                                                <p class="text-muted mb-3">
                                                    Please be informed that the PR period is now closed.
                                                </p>
                                                <button class="btn btn-outline-success mb-4" data-bs-toggle="modal" data-bs-target="#announcementModal">
                                                    <i class="ti ti-eye"></i> View Details
                                                </button>
                                                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3">
                                                    <div class="bg-white shadow-sm rounded-3 px-4 py-2 text-center">
                                                        <div class="text-muted small">START DATE</div>
                                                        <div class="fw-bold text-success">
                                                            {{ date('F d, Y', strtotime($annoucement->datestart)) }}
                                                        </div>
                                                    </div>
                                                    <div class="fw-bold text-muted">—</div>
                                                    <div class="bg-white shadow-sm rounded-3 px-4 py-2 text-center">
                                                        <div class="text-muted small">END DATE</div>
                                                        <div class="fw-bold text-danger">
                                                            {{ date('F d, Y', strtotime($annoucement->dateend)) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mt-4 text-muted">
                                                    Thank you to everyone who participated and supported!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="announcementModal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content rounded-4 shadow">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold text-dark">
                                                    Announcement Details
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body" style="line-height: 1.7;">
                                                {!! $annoucement->announcement !!}
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
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
                                    <div class="col-md-12">
                                        <div class="card card-animate">
                                            <div class="card-header pt-3">
                                                <h6 class="card-title">
                                                    <i class="fas fa-list"></i> My Cart List
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive mt-2 p-2">
                                                    <table id="mycartlist" class="table table-hover styled-table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Type of Request</th>
                                                                <th>Category</th>
                                                                <th>Purpose</th>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                                <th width="15%">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="col-md-12">
                                <div class="card card-animate">
                                    <div class="card-header pt-3">
                                        <h6 class="card-title">
                                            <i class="fas fa-list"></i> My Cart List
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive mt-2 p-2">
                                            <table id="mycartlist" class="table table-hover styled-table">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Type of Request</th>
                                                        <th>Category</th>
                                                        <th>Purpose</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th width="15%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        var mycartPrRoute = "{{ route('mycartlistajax') }}";

        var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
        var isProcurementOfficer = '{{ Auth::guard("web")->user()->role == "Procurement Officer" ? true : false }}';
        var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';
    </script>
@endsection
