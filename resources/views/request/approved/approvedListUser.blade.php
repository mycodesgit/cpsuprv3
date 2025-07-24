@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Approved PR</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="pruserapproved" class="table table-hover styled-table">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Campus</th>
                                            <th width="8%">PR No.</th>
                                            <th>Type</th>
                                            <th>Office</th>
                                            <th>Purpose</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
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
    </section>

    @if(request()->routeIs(['approvedListRead']))
        <script>
            var userApprovedRoute = '{{ route('getapprovedListRead') }}';
            var userReceivedRoute = '{{ route('getreceivedListRead') }}';
            var userCanvassingRoute = '{{ route('getcanvassingListRead') }}';
            var userCanvassedRoute = '{{ route('getcanvassedListRead') }}';
            var userPhilGepRoute = '{{ route('getphilgepListRead') }}';
            var userPostedRoute = '{{ route('getpostedListRead') }}';
            var userBiddingRoute = '{{ route('getbiddingListRead') }}';
            var userConsolidateRoute = '{{ route('getconsolidateListRead') }}';
            var userAwardedRoute = '{{ route('getawardedListRead') }}';
            var userPurchaseRoute = '{{ route('getpurchaseListRead') }}';

            var approvedListViewRoute = '{{ route('approvedListView', '') }}';
        </script>
    @endif

@endsection
