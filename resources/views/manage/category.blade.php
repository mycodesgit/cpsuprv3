@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Manage</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-10">
                    <div class="tab-content" id="vert-tabs-right-tabContent">
                        <div class="tab-pane fade show active" id="vert-tabs-right-one" role="tabpanel" aria-labelledby="vert-tabs-right-one-tab">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategoryModal">
                                        <i class="fas fa-plus"></i> Add New
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="categoryTable" class="table table-hover styled-table">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
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

                        <div class="tab-pane fade" id="vert-tabs-right-two" role="tabpanel" aria-labelledby="vert-tabs-right-two-tab">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addUnitModal">
                                        <i class="fas fa-plus"></i> Add New
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="unitTable" class="table table-hover styled-table"  style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Unit</th>
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

                        <div class="tab-pane fade" id="vert-tabs-right-three" role="tabpanel" aria-labelledby="vert-tabs-right-three-tab">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addItemModal">
                                        <i class="fas fa-plus"></i> Add New
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="itemTable" class="table table-hover styled-table"  style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Description</th>
                                                    <th>Unit</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
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

                        <div class="tab-pane fade" id="vert-tabs-right-four" role="tabpanel" aria-labelledby="vert-tabs-right-four-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="officeTable" class="table table-hover styled-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Office Name</th>
                                                    <th>Abbreviation</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="vert-tabs-right-five" role="tabpanel" aria-labelledby="vert-tabs-right-five-tab">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addYearModal">
                                        <i class="fas fa-plus"></i> Add New
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="yearTable" class="table table-hover styled-table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Year</th>
                                                    <th>Status</th>
                                                    <th style="width: 10%">Action</th>
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
                <div class="col-md-2">
                    <div class="card mt-2">
                        <div class="ml-2 mr-2 mt-3 mb-1">
                            <div class="page-header" style="border-bottom: 1px solid #04401f;">
                                <h4>Menu</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="nav flex-column nav-pills nav-stacked nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-right-one-tab" data-toggle="pill" href="#vert-tabs-right-one" role="tab" aria-controls="vert-tabs-right-one" aria-selected="true">Categories</a>
                                <a class="nav-link" id="vert-tabs-right-two-tab" data-toggle="pill" href="#vert-tabs-right-two" role="tab" aria-controls="vert-tabs-right-two" aria-selected="false">Units</a>
                                <a class="nav-link" id="vert-tabs-right-three-tab" data-toggle="pill" href="#vert-tabs-right-three" role="tab" aria-controls="vert-tabs-right-three" aria-selected="false">Items</a>
                                <a class="nav-link" id="vert-tabs-right-four-tab" data-toggle="pill" href="#vert-tabs-right-four" role="tab" aria-controls="vert-tabs-right-four" aria-selected="false">Offices</a>
                                <a class="nav-link" id="vert-tabs-right-five-tab" data-toggle="pill" href="#vert-tabs-right-five" role="tab" aria-controls="vert-tabs-right-five" aria-selected="false">Years</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('modal.categoryAddmodal')
    @include('modal.unitAddmodal')
    @include('modal.itemAddmodal')
    @include('modal.yearAddmodal')

    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCategoryForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editCategoryId">
                        <div class="form-group">
                            <label for="editCategoryName">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" name="category_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUnitModal" tabindex="-1" role="dialog" aria-labelledby="editUnitModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUnitModalLabel">Edit Unit Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editUnitForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editUnitId">
                        <div class="form-group">
                            <label for="editUnitName">Unit Name</label>
                            <input type="text" class="form-control" id="editUnitName" name="unit_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editItemModalLabel">Edit Item Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editItemForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editItemId">
                        <div class="form-group">
                            <label for="editItemCategory">Category:</label>
                            <select id="editItemCategory" name="category_id" class="form-control select2bs4" data-placeholder="Select Category" style="width: 100%;">
                                <option value="">-- Select --</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editItemUnit">Unit Name</label>
                            <select id="editItemUnit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                                <option value="">-- Select --</option>
                                @foreach ($unit as $u)
                                    <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editItemDescripName">Item Description</label>
                            <textarea rows="4" name="item_descrip" id="editItemDescripName" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editItemCost">Item Cost</label>
                            <input type="text" name="item_cost" id="editItemCost" onkeyup="formatNumber(this);" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editOfficeModal" tabindex="-1" role="dialog" aria-labelledby="editOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOfficeModalLabel">Edit Office Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editOfficeForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editOfficeId">
                        <div class="form-group">
                            <label for="editOfficeName">Office Name</label>
                            <input type="text" class="form-control" id="editOfficeName" name="office_name">
                        </div>
                        <div class="form-group">
                            <label for="editOfficeAbbr">Office Abbreviation</label>
                            <input type="text" class="form-control" id="editOfficeAbbr" name="office_abbr">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editYearModal" tabindex="-1" role="dialog" aria-labelledby="editYearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editYearModalLabel">Edit Year Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editYearForm">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editYearId">
                        <div class="form-group">
                            <label for="editYearName">Year Name</label>
                            <input type="text" class="form-control" id="editYearName" name="pryear">
                        </div>
                        <div class="form-group">
                            <label for="editYearStatus">Year Status</label>
                            <select name="status" id="editYearStatus" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="2">Disabled</option>
                                <option value="3">Upcoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var categoryReadRoute = "{{ route('getcategoryRead') }}";
        var categoryCreateRoute = "{{ route('categoryCreate') }}";
        var categoryUpdateRoute = "{{ route('categoryUpdate', ['id' => ':id']) }}";
        var categoryDeleteRoute = "{{ route('categoryDelete', ['id' => ':id']) }}";

        var unitReadRoute = "{{ route('getunitRead') }}";
        var unitCreateRoute = "{{ route('unitCreate') }}";
        var unitUpdateRoute = "{{ route('unitUpdate', ['id' => ':id']) }}";
        var unitDeleteRoute = "{{ route('unitDelete', ['id' => ':id']) }}";

        var itemReadRoute = "{{ route('getitemRead') }}";
        var itemCreateRoute = "{{ route('itemCreate') }}";
        var itemUpdateRoute = "{{ route('itemUpdate', ['id' => ':id']) }}";
        var itemDeleteRoute = "{{ route('itemDelete', ['id' => ':id']) }}";

        var officeReadRoute = "{{ route('getofficeRead') }}";
        var officeCreateRoute = "{{ route('officeCreate') }}";
        var officeUpdateRoute = "{{ route('officeUpdate', ['id' => ':id']) }}";
        var officeDeleteRoute = "{{ route('officeDelete', ['id' => ':id']) }}";

        var yearReadRoute = "{{ route('getyearRead') }}";
        var yearCreateRoute = "{{ route('yearCreate') }}";
        var yearUpdateRoute = "{{ route('yearUpdate', ['id' => ':id']) }}";
        var yearDeleteRoute = "{{ route('yearDelete', ['id' => ':id']) }}";

        var isAdmin = '{{ Auth::guard("web")->user()->role == "Administrator" ? true : false }}';
        var isProcurementOfficer = '{{ Auth::guard("web")->user()->role == "Procurement Officer" ? true : false }}';
        var isChecker = '{{ Auth::guard("web")->user()->role == "Checker" ? true : false }}';

        function formatNumber(input) {
            const value = input.value.replace(/[^\d.]/g, '');
            const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            input.value = formattedValue;
        }

        document.getElementById('addYearName').addEventListener('keypress', function (e) {
            if (e.key < '0' || e.key > '9') {
                e.preventDefault();
            }
        });
    </script>
@endsection
