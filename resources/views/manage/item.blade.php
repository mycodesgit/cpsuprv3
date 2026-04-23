@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-4 mb-4">Item</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="ti ti-plus"></i> Add New
                                </h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" id="adItem">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label>Category: <span class="text-danger">*</span></label>
                                                <select id="addItemCategory" name="category_id" class="form-control select2bs4" data-placeholder="Select Category" style="width: 100%;">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="addItemUnit">Unit Name: <span class="text-danger">*</span></label>
                                                <select id="addItemUnit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($unit as $u)
                                                        <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="addItemUnit">Unit Name: <span class="text-danger">*</span></label>
                                                <select id="addItemUnit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($unit as $u)
                                                        <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="addItemDescripName">Item Description: <span class="text-danger">*</span></label>
                                                <textarea rows="4" name="item_descrip" id="addItemDescripName" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label for="addItemCost">Item Cost: <span class="text-danger">*</span></label>
                                                <input type="text" name="item_cost" id="addItemCost" onkeyup="formatNumber(this);" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-outline-success">
                                                    <i class="fas fa-save"></i> Save
                                                </button>
                                            </div>
                                        </div>
                                    </div>   
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-list"></i> List
                                </h6>
                            </div>
                            <div class="card-body">
                                <table id="itemTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Category</th>
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

    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="editItemModalLabel">Edit Item Name</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editItemForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editItemId">
                        <div class="col-md-12 mb-3">
                            <label for="editItemCategory">Category: <span class="text-danger">*</span></label>
                            <select id="editItemCategory" name="category_id" class="form-control select2" data-placeholder="Select Category" style="width: 100%;">
                                <option value="">-- Select --</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editItemUnit">Unit: <span class="text-danger">*</span></label>
                            <select id="editItemUnit" name="unit_id" class="form-control select2" data-placeholder="Select Unit" style="width: 100%;">
                                <option value="">-- Select --</option>
                                @foreach ($unit as $u)
                                    <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editItemDescripName">Item Description: <span class="text-danger">*</span></label>
                            <textarea rows="4" name="item_descrip" id="editItemDescripName" class="form-control" style="height: 350px; min-height: 350px; resize: vertical;"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="editItemCost">Item Cost: <span class="text-danger">*</span></label>
                            <input type="text" name="item_cost" id="editItemCost" onkeyup="formatNumber(this);" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-success">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var itemReadRoute = "{{ route('getitemRead') }}";
        var itemCreateRoute = "{{ route('itemCreate') }}";
        var itemUpdateRoute = "{{ route('itemUpdate', ['id' => ':id']) }}";
        var itemDeleteRoute = "{{ route('itemDelete', ['id' => ':id']) }}";

        var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
        var isProcurementOfficer = '{{ Auth::guard("web")->user()->role == "Procurement Officer" ? true : false }}';
        var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';

        function formatNumber(input) {
            const value = input.value.replace(/[^\d.]/g, '');
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            input.value = formattedValue;
        }
    </script>

@endsection
