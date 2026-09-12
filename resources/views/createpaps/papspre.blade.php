@extends('layouts.master')

@section('body')
    <div class="row ">
        <div class="col-12">
            <div class="mb-6">
                <h1 class="fs-3 mb-4">Create PAP's / PRE</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12">
                        <div class="card card-animate">
                            <div class="card-header pt-3">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addYearPAPsModal">
                                    <i class="fas fa-plus"></i> Create New
                                </button>
                            </div>
                            <div class="card-body">
                                <table id="papspreplanTable" class="table table-hover styled-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>PAPs</th>
                                            <th>Fund Source</th>
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

     @include('modal.papsAddmodal')

    <script>
        var papsplanCreateRoute = "{{ route('papsstore') }}";
        var papsplanReadRoute = "{{ route('getpapsYearRead') }}";
        var papslanListViewRoute = "{{ route('viewlistpapspre', '') }}";
    </script>
@endsection
