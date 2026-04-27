@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">My Cart</h1>
                <div class="row g-4 mb-5">
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
