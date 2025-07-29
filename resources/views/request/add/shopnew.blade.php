@extends('layouts.master')

@section('body')
    <style>
        /* Sidebar style */
        #cartSidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 0;
            background-color: white;
            overflow-x: hidden;
            transition: width 0.3s ease;
            z-index: 1050;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
        }

        #cartSidebar.open {
            width: 50%;
        }

        @media (max-width: 768px) {
            #cartSidebar.open {
                width: 100%;
            }
        }

        /* Floating cart button */
        #cartToggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1100;
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }
    </style>

    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Shop</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
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
                            <table id="shoplist" class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Cost</th>
                                        <th>Category</th>
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
            </div>

            <!-- 🔘 Floating Cart Button -->
            <button id="cartToggle" class="btn btn-primary shadow d-flex align-items-center justify-content-center">
                <i class="fas fa-shopping-cart fs-4"></i>
            </button>

            <!-- 📦 Sidebar Cart Panel -->
            <div id="cartSidebar">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="mb-0">🛒 My Cart</h5>
                    <button class="btn btn-sm btn-danger" id="closeCart">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- 📋 Accordion -->
                <div class="accordion mt-3" id="purposeAccordion" style="padding: 0 15px;">
                    <!-- Example group -->
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                PR Cart 1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#purposeAccordion">
                            <div class="accordion-body p-0">
                                <table class="table table-sm table-striped m-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Item A Description</td>
                                            <td>5</td>
                                            <td>₱100.00</td>
                                            <td>₱500.00</td>
                                        </tr>
                                        <tr>
                                            <td>Item B Description</td>
                                            <td>2</td>
                                            <td>₱200.00</td>
                                            <td>₱400.00</td>
                                        </tr>
                                        <tr>
                                            <td>Item C Description</td>
                                            <td>1</td>
                                            <td>₱300.00</td>
                                            <td>₱300.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Add more PR Cart accordions here -->
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="itemModal" role="dialog" aria-labelledby="itemModalLabel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Add to Cart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('addToCartItemShop') }}" id="requestpr">
                        @csrf

                        {{-- <input type="text" name="category_id" value="{{ $purpose->cat_id }}">
                        <input type="text" name="user_id" value="{{ $purpose->user_id }}">
                        <input type="text" name="campid" value="{{ $purpose->camp_id }}">
                        <input type="text" name="off_id" value="{{ $purpose->office_id }}">
                        <input type="text" name="transaction_no" value="{{ $purpose->id }}">
                        <input type="text" name="purpose_id" value="{{ $purpose->id }}"> --}}
                        <input type="hidden" name="item_id">
                        <input type="hidden" name="unit_id">
                        <input type="hidden" name="category_id">
                        <input type="hidden" name="user_id" value="{{ Auth::guard('web')->user()->id }}">
                        <input type="hidden" name="camp_id" value="{{ Auth::guard('web')->user()->campus_id }}">
                        <input type="hidden" name="office_id" value="{{ Auth::guard('web')->user()->office_id }}">

                        <div class="form-group mt-2">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label><span class="badge badge-secondary">Item</span></label>
                                    <input type="text" name="item_name" class="form-control form-control-sm" readonly>
                                </div>

                                <div class="mt-2 col-md-12">
                                    <label><span class="badge badge-secondary">Unit</span></label>
                                    <input type="text" name="unit_name" class="form-control form-control-sm" readonly>
                                </div>

                                <div class="mt-2 col-md-12">
                                    <label><span class="badge badge-secondary">Item Cost</span></label>
                                    {{-- @if(in_array($purpose->cat_id, [18, 20, 21, 22, 29, 30, 31]))
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()">
                                    @else
                                        <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly>
                                    @endif --}}
                                    <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly>
                                </div>

                                <div class="mt-2 col-md-4">
                                    <label><span class="badge badge-secondary">Quantity</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="qty" id="quantityInput" class="form-control form-control-md" value="1" oninput="validateQuantity());" onkeyup="calculateTotalCost()">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-2 col-md-8">
                                    <label>Total Cost:</label>
                                    <input type="text" name="total_cost" onkeyup="formatNumber(this);" class="form-control form-control-md" readonly>
                                </div>

                                <div class="col-md-12">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="form-control form-control-sm btn btn-outline-success btn-sm">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
  const cartToggle = document.getElementById('cartToggle');
  const cartSidebar = document.getElementById('cartSidebar');
  const closeCart = document.getElementById('closeCart');

  cartToggle.addEventListener('click', () => {
    cartSidebar.classList.add('open');
  });

  closeCart.addEventListener('click', () => {
    cartSidebar.classList.remove('open');
  });
</script>
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
