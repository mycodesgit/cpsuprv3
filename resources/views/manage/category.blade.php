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
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="categoryTable" class="table table-hover styled-table">
                                            <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th width="10">Action</th>
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
                                <div class="card-body">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <table id="unitTable" class="table table-hover styled-table"  style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>Unit</th>
                                                    <th style="width: 10% !important">Action</th>
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
                                                {{-- @php $no = 1; @endphp
                                                @foreach($office as $data)
                                                <tr id="tr-{{ $data->id }}" class="{{ $cr === 'officeEdit' ? $data->id == $selectedOffice->id ? 'bg-selectEdit' : '' : ''}}">
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $data->office_name }}</td>
                                                    <td>{{ $data->office_abbr }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                    <a href="{{ route('officeEdit', $data->id) }}" class="dropdown-item btn-edit" data-id="{{ $data->id }}">
                                                                        <i class="fas fa-exclamation-circle"></i> Edit
                                                                    </a>
                                                                    @if(Auth::guard('web')->user()->role == 'Administrator')
                                                                    <button value="{{ $data->id }}" class="dropdown-item office-delete">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach --}}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
