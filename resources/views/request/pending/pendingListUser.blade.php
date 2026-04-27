@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Pending Pr</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List of Pending PR
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-2 p-2">
                                    <table id="pendingUserTable" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date Submitted</th>
                                                <th>Campus</th>
                                                <th>Transaction No.</th>
                                                <th>Type</th>
                                                <th>Office</th>
                                                <th>Purpose</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th width="10%">Actions</th>
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

    <div class="modal fade" id="viewPrModal" tabindex="-1" role="dialog" aria-labelledby="viewPrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="viewPrModalLabel">Purchase Request Details</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalContent">
                    <div class="text-center">Loading...</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @if(request()->routeIs(['pendingListRead']))
        <script>
            var userPendingRoute = "{{ route('getpendingListRead') }}";
            var pendingUserListViewRoute = "{{ route('pendingListView', '') }}";
            var pendingAllCheckingStatusUpdateRoute = "{{ route('checkingPR', ['id' => ':id']) }}";
            var appidEncryptRoute = "{{ route('idcrypt') }}";

            var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';
        </script>
    @endif
@endsection
