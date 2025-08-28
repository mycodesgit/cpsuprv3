@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Create PAP's / PRE</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addYearPAPsModal">
                                <i class="fas fa-plus"></i> Create New
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="papspreplanTable" class="table table-hover styled-table">
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
    </section>
    @include('modal.papsAddmodal')

    <script>
        var papsplanCreateRoute = "{{ route('papsstore') }}";
        var papsplanReadRoute = "{{ route('getpapsYearRead') }}";
        var papslanListViewRoute = "{{ route('viewlistpapspre', '') }}";
    </script>
@endsection
