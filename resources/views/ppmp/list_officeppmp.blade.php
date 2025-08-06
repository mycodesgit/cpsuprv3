@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>List of Offices with PPMP</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="example1" class="table table-hover styled-table">
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
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($userppmp as $data)
                                        <tr id="tr-{{ $data->puid }}">
                                            <td width="15">{{ $no++ }}</td>
                                            <td>{{ $data->campus_name }}</td>
                                            <td>{{ $data->office_abbr }}</td>
                                            <td>{{ $data->fname }} {{ $data->lname }}</td>
                                            <td>
                                                @if($data->ppmp_categories)
                                                    @foreach(json_decode($data->ppmp_categories) as $categoryId)
                                                        @php
                                                            $category = \App\Models\Category::find($categoryId);
                                                        @endphp
                                                        @if($category)
                                                            <span class="badge badge-secondary">{{ $category->category_name }}</span>,
                                                        @else
                                                            <span class="badge badge-secondary">Unknown Category</span>,
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td width="15">
                                                <button class="btn btn-success btn-xs btn-edit"
                                                    data-toggle="modal"
                                                    data-target="#modal-userppmp{{ $data->puid }}"
                                                    data-event-id="{{ $data->puid }}"
                                                    data-categories="{{ json_encode($data->ppmp_categories) }}">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </button>

                                            </td>
                                        </tr>
                                        @include('ppmp.modal_ppmp')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
