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

    <div class="modal fade" id="viewPrModal" tabindex="-1" role="dialog" aria-labelledby="viewPrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="max-width: 80vw;">
            <div class="modal-content">
                <div class="modal-header p-3" style="background-color: #f6f6f6; color: #000;">
                    <h5 class="modal-title" id="viewPrModalLabel">Purchase Request Details</h5>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editCategoryForm">
                    <div class="modal-body p-0" id="modalContent">
                        <div class="text-center">Loading...</div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
