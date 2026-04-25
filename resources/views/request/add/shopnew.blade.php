@extends('layouts.master')

@section('body')
    <style>
        .qty-wrapper {
            display: flex;
            align-items: center;
        }

        .qty-btn {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 18px;
            transition: 0.2s ease;
        }

        .qty-btn:hover {
            background: #65ac86;
            color: #fff;
        }

        .qty-input {
            width: 100%;
            text-align: center;
            font-weight: 600;
            border-radius: 10px;
            height: 42px;
            margin: 0 8px;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Shop Item</h1>
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

                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <div class="position-relative mb-3" style="width: 100%;">
                                                        <i class="fas fa-search position-absolute text-success" style="top: 50%; left: 15px; transform: translateY(-50%); pointer-events: none;"></i>
                                                        <input type="text" id="customSearch" class="form-control form-control-lg" placeholder="Search Item..." style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                                        <button type="button" id="clearSearch" class="btn btn-sm btn-light text-danger position-absolute" style="top: 48%; right: 10px; transform: translateY(-50%); display: none;">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <table id="shoplist" class="table table-hover" style="width: 100%">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th></th>
                                                            <th width="40%">Description</th>
                                                            <th>Unit</th>
                                                            <th>Cost</th>
                                                            <th>Category</th>
                                                            <th></th>
                                                            <th></th>
                                                            <th width="10%">#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Item Cart Summary</h5>
                                            </div>
                                            <div class="card-body">
                                                <div id="purposeAccordionWrapper">
                                                    @include('partials._purpose_accordion')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="col-md-8">
                                <div class="card card-animate">
                                    <div class="card-header pt-3">
                                        <h6 class="card-title">List of Items</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="position-relative mb-3" style="width: 100%;">
                                                <i class="fas fa-search position-absolute text-success" style="top: 50%; left: 15px; transform: translateY(-50%); pointer-events: none;"></i>
                                                <input type="text" id="customSearch" class="form-control form-control-lg" placeholder="Search Item..." style="padding-left: 2.5rem; padding-right: 2.5rem;">
                                                <button type="button" id="clearSearch" class="btn btn-sm btn-light text-danger position-absolute" style="top: 48%; right: 10px; transform: translateY(-50%); display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <table id="shoplist" class="table table-hover" style="width: 100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th></th>
                                                    <th width="40%">Description</th>
                                                    <th>Unit</th>
                                                    <th>Cost</th>
                                                    <th>Category</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th width="10%">#</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-animate">
                                    <div class="card-header pt-3">
                                        <h6 class="card-title">Item Cart Summary</h6>
                                    </div>
                                    <div class="card-body">
                                        <div id="purposeAccordionWrapper">
                                            @include('partials._purpose_accordion')
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

    <div class="modal fade" id="itemModal" role="dialog" aria-labelledby="itemModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('addToCartItemShop') }}" id="requestpr">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="item_id">
                        <input type="hidden" name="unit_id">
                        <input type="hidden" name="category_id">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                        <input type="hidden" name="camp_id" value="{{ Auth::guard('web')->user()->campus_id }}">
                        <input type="hidden" name="office_id" value="{{ Auth::guard('web')->user()->office_id }}">

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Item: <span class="text-danger">*</span></label>
                                    <input type="text" name="item_name" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Unit: <span class="text-danger">*</span></label>
                                    <input type="text" name="unit_name" class="form-control" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Item Cost: <span class="text-danger">*</span></label>
                                    {{-- @if(in_array($purpose->cat_id, [18, 20, 21, 22, 29, 30, 31]))
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()">
                                    @else
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly>
                                    @endif --}}
                                    {{-- <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly> --}}
                                    {{-- <input type="text" name="item_cost" class="form-control form-control-sm" value="{{ $item_cost ?? 0 }}" onkeyup="formatNumber(this); calculateTotalCost()" {{ ($item_cost ?? 0) == 0 ? '' : 'readonly' }}> --}}
                                    
                                    <input type="text" name="item_cost" class="form-control" onkeyup="formatNumber(this); calculateTotalCost()">
                                </div>

                                <div class="col-md-4">
                                    <label>Quantity: <span class="text-danger">*</span></label>
                                    <div class="qty-wrapper">
                                        <button type="button" class="btn btn-outline-success qty-btn" onclick="decrementQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text"
                                            name="qty"
                                            id="quantityInput"
                                            class="form-control qty-input"
                                            value="1"
                                            oninput="validateQuantity()"
                                            onkeyup="calculateTotalCost()">

                                        <button type="button" class="btn btn-success qty-btn" onclick="incrementQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label>Total Cost: <span class="text-danger">*</span></label>
                                    <input type="text" name="total_cost" onkeyup="formatNumber(this);" class="form-control form-control-md" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var shopListRoute = "{{ route('getshoplistSerialize') }}";
        
    </script>

    <script>
        function formatNumber(input) {
            const value = input.value.replace(/[^\d.]/g, '');
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            input.value = formattedValuetoggleReadonly(input);
        }
    </script>

    <script>
        function incrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var currentQuantity = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentQuantity + 1;
            calculateTotalCost();
        }

        function decrementQuantity() {
            var quantityInput = document.getElementById('quantityInput');
            var currentQuantity = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentQuantity > 1 ? currentQuantity - 1 : 1;
            calculateTotalCost();
        }

        function calculateTotalCost() {
            const qtyInput = document.getElementsByName('qty')[0];
            const itemCostInput = document.getElementsByName('item_cost')[0];
            const qty = parseFloat(qtyInput.value) || 0;
            const itemCost = parseFloat(itemCostInput.value.replace(/[^\d.]/g, '')) || 0;
            const totalCost = qty * itemCost;
            const formattedTotalCost = totalCost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Modified line
            document.getElementsByName('total_cost')[0].value = formattedTotalCost;
        }

        function validateQuantity(input, allowDecimal) {
            if (allowDecimal) {
                // Allow only numbers and one decimal point
                input.value = input.value.replace(/[^0-9.]/g, '');
                if ((input.value.match(/\./g) || []).length > 1) {
                    input.value = input.value.replace(/\.+$/, "");
                }
            } else {
                // Only allow whole numbers
                input.value = input.value.replace(/[^0-9]/g, '');
            }
        }
    </script>
@endsection
