@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">PPMP</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <h6 class="card-title">
                                    <i class="fas fa-users"></i> List of User's PPMP
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mt-2 p-2">
                                    <table id="ppmpuserviewTable" class="table table-hover styled-table" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Campus</th>
                                                <th>Office</th>
                                                <th>Office Head</th>
                                                <th>PPMP</th>
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
        </div>
    </div>

    <div class="modal fade" id="modal-userppmp">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                </div>

                <div class="modal-body">
                    <form id="userppmpForm" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="puid">

                        <div class="form-group">
                            <label>Select Category Based on PPMP Approved:</label>
                            <select id="categories" name="ppmp_categories[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ppmpUserReadRoute = "{{ route('ppmpShow') }}";
        var ppmpUserUpdateRoute = "{{ route('userppmpUpdate', ['id' => ':id']) }}";
    </script>
@endsection
