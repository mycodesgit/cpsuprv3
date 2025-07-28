@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>My Cart</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table id="example1" class="table table-hover styled-table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Type of Request</th>
                                            <th>Category</th>
                                            <th>Purpose</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($repurpose as $data)
                                        <tr id="tr-{{ $data->purpose_Id }}">
                                            <td>{{ $no++ }}</td>
                                            <td>
                                                @php
                                                    switch($data->type_request) {
                                                        case 1:
                                                            echo 'PR';
                                                            break;
                                                        case 2:
                                                            echo 'POW';
                                                            break;
                                                        case 3:
                                                            echo 'Letter Request';
                                                            break;
                                                        case 4:
                                                            echo 'Others';
                                                            break;
                                                        default:
                                                            echo 'Unknown';
                                                    }
                                                @endphp
                                            </td>
                                            <td>{{ $data->category_name }}</td>
                                            <td>{{ $data->purpose_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F j, Y') }}</td>
                                            <td>
                                                @php
                                                    switch($data->pstatus) {
                                                        case 1:
                                                            echo '<span class="badge badge-info">Ongoing</span>';
                                                            break;
                                                        case 2:
                                                            echo '<span class="badge badge-warning">Pending</span>';
                                                            break;
                                                        case 3:
                                                            echo '<span class="badge badge-danger">Returned</span>';
                                                            break;
                                                        case 4:
                                                            echo '<span class="badge badge-success">Accepted</span>';
                                                            break;
                                                        default:
                                                            echo '<span class="badge badge-secondary">Unknown Status</span>';
                                                    }
                                                @endphp
                                            </td>
                                            <td>
                                                {{-- <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="btn btn-default green btn-sm btn-view">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <button value="{{ $data->purpose_Id }}" class="btn btn-outline-danger btn-sm cart-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button> --}}

                                                {{-- <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="true">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="dropdown-item">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#modal-editpurpose-{{ $data->purpose_Id }}" data-purpose="{{ $data->purpose_name }}">
                                                            <i class="fas fa-pen"></i> Edit
                                                        </button>
                                                        <button class="dropdown-item" data-toggle="modal" data-target="#modal-trackpurpose-{{ $data->purpose_Id }}" data-purpose="{{ $data->ppmp_remarks }}">
                                                            <i class="fas fa-bars-progress"></i> Track
                                                        </button>
                                                        <button class="dropdown-item cart-delete" value="{{ $data->purpose_Id }}">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </div>
                                                </div> --}}
                                                <div class="">
                                                    <a href="{{ route('selectItems', encrypt($data->purpose_Id)) }}" class="btn btn-icon btn-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-icon btn-info" data-toggle="modal" data-target="#modal-editpurpose-{{ $data->purpose_Id }}" data-purpose="{{ $data->purpose_name }}">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-success" data-toggle="modal" data-target="#modal-trackpurpose-{{ $data->purpose_Id }}" data-purpose="{{ $data->ppmp_remarks }}">
                                                        <i class="fas fa-bars-progress"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-icon btn-danger cart-delete" value="{{ $data->purpose_Id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-editpurpose-{{ $data->purpose_Id }}" role="dialog" aria-labelledby="editPurposeLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">
                                                            <i class="fas fa-pen"></i> Edit
                                                        </h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <form action="{{ route('prPurposeRequestUpdate') }}" class="form-horizontal" method="post" id="purposepr">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $data->purpose_Id }}">

                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <label>Purpose:</label>
                                                                        <textarea name="purpose_name" rows="4" class="form-control" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">{{ $data->purpose_name }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-default green">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal-trackpurpose-{{ $data->purpose_Id }}" role="dialog" aria-labelledby="editPurposeLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title">
                                                            <i class="fas fa-bars-progress"></i> Track
                                                        </h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <form class="form-horizontal" method="post" id="purposepr">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{ $data->purpose_Id }}">

                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <label>PPMP Remarks:</label>
                                                                        <textarea name="purpose_name" rows="4" class="form-control" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" readonly>{{ $data->ppmp_remarks }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <label>PPMP Remarks:</label>
                                                                        <input type="text" name="" class="form-control form-control-sm" value="{{ $data->prstatus == 1 ? 'With PPMP' : ($data->prstatus == 2 ? 'Without PPMP' : '') }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

    <script>
        var mycartDeleteRoute = "{{ route('mycartDelete', ':id') }}";
    </script>
@endsection
