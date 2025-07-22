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
                                <table id="prapproved" class="table table-hover styled-table">
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

    @if(request()->routeIs(['approvedListAllRead']))
        <script>
            var allApprovedRoute = "{{ route('getAllapprovedListRead') }}";
            var allReceivedRoute = "{{ route('getAllreceivedListRead') }}";
            var allCanvassingRoute = "{{ route('getAllcanvassingListRead') }}";
            var allCanvassedRoute = "{{ route('getAllcanvassedListRead') }}";
            var allPhilgepRoute = "{{ route('getAllphilgepListRead') }}";
            var allPostingRoute = "{{ route('getAllpostingListRead') }}";
            var allBddngLantadRoute = "{{ route('getAllfuckyouListRead') }}";
            var allConsolidatdprRoute = "{{ route('getAllmadapakconsolListRead') }}";
            var allPAwardRoute = "{{ route('getAllawardListRead') }}";
            var allpurchaseRoute = "{{ route('getAllpurchaseListRead') }}";

            var allApprovedCountRoute = "{{ route('approvedListAllRead') }}";

            var approvedAllListViewRoute = "{{ route('approvedAllListView', '') }}";

            var approvedReceivedViewRoute = "{{ route('receivedPR') }}";
            var approvedCanvassingViewRoute = "{{ route('canvassingPR') }}";
            var approvedCanvassedViewRoute = "{{ route('canvassedPR') }}";
            var approvedPostingViewRoute = "{{ route('philgepspostingPR') }}";
            var approvedPostedViewRoute = "{{ route('postedPR') }}";
            var approvedBiddingViewRoute = "{{ route('biddingPR') }}";
            var approvedConsolidationViewRoute = "{{ route('consolidationPR') }}";
            var approvedAwardViewRoute = "{{ route('awardedPR') }}";
            var approvedPurchasedViewRoute = "{{ route('purchasedPR') }}";
            var forwardedPedoViewRoute = "{{ route('forwardedPedoPR') }}";
            var approvedReturnedViewRoute = "{{ route('rerturnedPR') }}";

            var userRole = "{{ Auth::user()->role }}";
        </script>
    @endif

@endsection
