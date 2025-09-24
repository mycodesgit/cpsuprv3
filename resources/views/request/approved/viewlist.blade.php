<style>
    #tracking {
        background: #fff
    }

    .tracking-detail {
        padding: 3rem 0;
    }

    #tracking {
        margin-bottom: 1rem;
    }

    [class*="tracking-status-"] p {
        margin: 0;
        font-size: 1.1rem;
        color: #fff;
        text-transform: uppercase;
        text-align: center;
    }

    [class*="tracking-status-"] {
        padding: 1.6rem 0;
    }

    .tracking-list {
        border: 1px solid #e5e5e5;
    }

    .tracking-item {
        border-left: 4px solid #00ba0d;
        position: relative;
        padding: 2rem 1.5rem 0.5rem 2.5rem;
        font-size: 0.9rem;
        margin-left: 3rem;
        min-height: 5rem;
        color: #000;
    }

    .tracking-item:last-child {
        padding-bottom: 4rem;
    }

    .tracking-item .tracking-date {
        margin-bottom: 0.5rem;
    }

    .tracking-item .tracking-date span {
        color: #888;
        font-size: 85%;
        padding-left: 0.4rem;
    }

    .tracking-item .tracking-content {
        padding: 0.5rem 0.8rem;
        background-color: #f4f4f4;
        border-radius: 0.5rem;
    }

    .tracking-item .tracking-content span {
        display: block;
        color: #767676;
        font-size: 13px;
    }

    .tracking-item .tracking-icon {
        position: absolute;
        left: -0.7rem;
        width: 1.1rem;
        height: 1.1rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        background-color: #fff;
        color: #fff;
    }

    .tracking-item-pending {
        border-left: 4px solid #d6d6d6;
        position: relative;
        padding: 2rem 1.5rem 0.5rem 2.5rem;
        font-size: 0.9rem;
        margin-left: 3rem;
        min-height: 5rem;
        color: #767676;
    }

    .tracking-item-pending:last-child {
        padding-bottom: 4rem;
    }

    .tracking-item-pending .tracking-date {
        margin-bottom: 0.5rem;
    }

    .tracking-item-pending .tracking-date span {
        color: #888;
        font-size: 85%;
        padding-left: 0.4rem;
    }

    .tracking-item-pending .tracking-content {
        padding: 0.5rem 0.8rem;
        background-color: #f4f4f4;
        border-radius: 0.5rem;
    }

    .tracking-item-pending .tracking-content span {
        display: block;
        color: #767676;
        font-size: 13px;
    }

    .tracking-item-pending .tracking-icon {
        line-height: 2.6rem;
        position: absolute;
        left: -0.7rem;
        width: 1.1rem;
        height: 1.1rem;
        text-align: center;
        border-radius: 50%;
        font-size: 1.1rem;
        color: #d6d6d6;
    }

    .tracking-item-pending .tracking-content {
        font-weight: 600;
        font-size: 17px;
    }

    .tracking-item .tracking-icon.status-current {
        width: 1.9rem;
        height: 1.9rem;
        left: -1.1rem;
    }

    .tracking-item .tracking-icon.status-intransit {
        color: #00ba0d;
        font-size: 0.6rem;
    }

    .tracking-item .tracking-icon.status-current {
        color: #00ba0d;
        font-size: 0.6rem;
    }

    @media (min-width: 992px) {
        .tracking-item {
            margin-left: 10rem;
        }

        .tracking-item .tracking-date {
            position: absolute;
            left: -10rem;
            width: 7.5rem;
            text-align: right;
        }

        .tracking-item .tracking-date span {
            display: block;
        }

        .tracking-item .tracking-content {
            padding: 0;
            background-color: transparent;
        }

        .tracking-item-pending {
            margin-left: 10rem;
        }

        .tracking-item-pending .tracking-date {
            position: absolute;
            left: -10rem;
            width: 7.5rem;
            text-align: right;
        }

        .tracking-item-pending .tracking-date span {
            display: block;
        }

        .tracking-item-pending .tracking-content {
            padding: 0;
            background-color: transparent;
        }
    }

    .tracking-item .tracking-content {
        font-weight: 600;
        font-size: 17px;
    }

    .blinker {
        border: 7px solid #e9f8ea;
        animation: blink 1s;
        animation-iteration-count: infinite;
    }

    @keyframes blink {
        50% {
            border-color: #fff;
        }
    }
</style>
<div class="card-body">
    <ul class="nav nav-pills text-sm" id="myTab4" role="tablist" style="gap: 2px;">
        <li class="nav-item">
            <a class="nav-link active show" id="pr-tab" data-toggle="tab" href="#prtab" role="tab"
                aria-controls="first" aria-selected="true">PR Table
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="prpdf-tab" data-toggle="tab" href="#prpdftab" role="tab"
                aria-controls="second" aria-selected="false">PR PDF
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="receipt-tab" data-toggle="tab" href="#receipttab" role="tab"
                aria-controls="third" aria-selected="false">Receipt Slip
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="pow-tab" data-toggle="tab" href="#powtab" role="tab"
                aria-controls="fifth" aria-selected="false">POW
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="ppmp-tab" data-toggle="tab" href="#ppmptab" role="tab"
                aria-controls="sixth" aria-selected="false">PPMP
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="track-tab" data-toggle="tab" href="#tracktab" role="tab"
                aria-controls="fourth" aria-selected="false">Track
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent2">
        <div class="tab-pane fade active show" id="prtab" role="tabpanel" aria-labelledby="pr-tab">
            <div class="table-responsive">
                <table id="" class="table table-bordered styled-table text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Item</th>
                            <th>Unit Cost</th>
                            <th>Qty</th>
                            <th>Total Cost</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php
                            $no = 1;
                            $grandTotal = 0;
                        @endphp
                        @foreach ($appItem as $data)
                            <tr id="tr-{{ $data->iid }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->category_name }}</td>
                                <td>{{ $data->unit_name }}</td>
                                <td>{{ $data->item_descrip }}</td>
                                <td>{{ $data->fitem_cost }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>{{ number_format($data->total_cost, 2) }}</td>
                                @if (is_numeric(str_replace(',', '', $data->total_cost)))
                                    @php $grandTotal += str_replace(',', '', $data->total_cost); @endphp
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Grand Total:</strong></td>
                            <td style="background-color: #e9e9e9"><strong
                                    id="granTotal">{{ number_format($grandTotal, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="prpdftab" role="tabpanel" aria-labelledby="prpdf-tab">
            @php
                $currentRoute = request()->route()->getName();
            @endphp

            @if ($currentRoute == 'approvedListView')
                <iframe src="{{ route('PDFprApproved', encrypt($data['purpose_id'] ?? '')) }}" width="100%"
                    height="500"></iframe>
            @elseif ($currentRoute == 'approvedAllListView')
                <iframe src="{{ route('PDFprAllApproved', encrypt($data['purpose_id'] ?? '')) }}" width="100%"
                    height="500"></iframe>
            @else
                <iframe src="{{ route('PDFprApproved', encrypt($data['purpose_id'])) }}" width="100%"
                    height="500"></iframe>
            @endif
        </div>
        <div class="tab-pane fade" id="receipttab" role="tabpanel" aria-labelledby="receipt-tab">
            @php
                $currentRoute = request()->route()->getName();
            @endphp

            @if ($currentRoute == 'approvedListView')
                <iframe src="{{ route('PDFrbarasApproved', encrypt($data['purpose_id'] ?? '')) }}" width="100%"
                    height="600"></iframe>
            @elseif ($currentRoute == 'approvedAllListView')
                <iframe src="{{ route('PDFrbarasAllApproved', encrypt($data['purpose_id'] ?? '')) }}" width="100%"
                    height="600"></iframe>
            @else
                <iframe src="{{ route('PDFrbarasApproved', encrypt($data['purpose_id'])) }}" width="100%"
                    height="600"></iframe>
            @endif
        </div>
        {{-- <div class="tab-pane fade" id="remarkstab" role="tabpanel" aria-labelledby="remarks-tab">
            @if (Auth::user()->role == 'Checker')
                <form action="{{ route('checkingPR') }}" class="form-horizontal" method="post" id="addItem">
                    @csrf
                    
                    <input type="hidden" name="purpose_id" value="{{ encrypt($data->purpose_id ?? '') }}">
                    <input type="hidden" name="officeidreturn" value="{{ Auth::guard('web')->user()->role }}">
                    <input type="hidden" name="trnsacno" value="{{ $appItem->first()->transaction_no }}">
                    <input type="hidden" name="userid" value="{{ $appItem->first()->user_id }}">
                    <input type="hidden" name="userprno" value="{{ $appItem->first()->pr_no }}">

                    <div class="row">
                        <div class="col-4">
                            <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PR Status:</span>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <select class="form-control form-control-sm" name="status">
                                            <option disabled selected>Select</option>
                                            @php
                                                $reqitem = $appItem->first();
                                            @endphp
                                            <option value="3" @if (old('pstatus') == 3 || $reqitem->pstatus == '3') {{ 'selected' }} @endif>
                                                Return to Client
                                            </option>
                                            <option value="4" @if (old('pstatus') == 4 || $reqitem->pstatus == '4') {{ 'selected' }} @endif>
                                                Checking PR
                                            </option>
                                            <option value="5" @if (old('pstatus') == 5 || $reqitem->pstatus == '5') {{ 'selected' }} @endif>
                                                Checking PPMP
                                            </option>
                                            <option value="6" @if (old('pstatus') == 6 || $reqitem->pstatus == '6') {{ 'selected' }} @endif>
                                                Endorse PR to Budget Office
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PPMP Remarks Verification:</span>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        @foreach ($appItem as $index => $item)
                                            @if ($index === 0)
                                                <input type="text" name="ppmp_remarks" value="{{ old('ppmp_remarks', $item->ppmp_remarks) }}" class="form-control">
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PR Remarks Status:</span>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <select class="form-control form-control-sm" name="prstatus">
                                            <option disabled selected>Select</option>
                                            <option value="1" @if (old('prstatus') == 1 || ($appItem->isNotEmpty() && $appItem[0]->prstatus == '1')) {{ 'selected' }} @endif>With PPMP</option>
                                            <option value="2" @if (old('prstatus') == 2 || ($appItem->isNotEmpty() && $appItem[0]->prstatus == '2')) {{ 'selected' }} @endif>Without PPMP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div> --}}
        <div class="tab-pane fade" id="powtab" role="tabpanel" aria-labelledby="pow-tab" style="border-top: 1px solid #009879; margin-top: 10px">
            <div style="background-color: #e9e9e9; padding: 10px">
                @if ($docFile && $docFile->doc_file)
                    @php
                        $filePath = storage_path('app/public/' . $docFile->doc_file);
                        $fileExists = file_exists($filePath);
                    @endphp

                    @if ($fileExists)
                        <iframe src="{{ asset('storage/' . $docFile->doc_file) }}#toolbar=0" type="application/pdf"
                            style="width:100%; height:500px;"></iframe>
                    @else
                        <div>
                            <div class="card text-center" style="width: 250px; border: 1px solid #eee;">
                                <div class="card-body p-3">
                                    <i class="far fa-file-pdf" style="font-size: 60pt"></i>
                                </div>
                                <div class="card-footer bg-white p-2" style="font-size: 15pt">
                                    <small class="text-muted">File not found on server</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li class="fileattached">
                                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                                <div class="mailbox-attachment-info">
                                    <span class="mailbox-attachment-name">
                                        <center>No PDF File uploaded</center>
                                    </span>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="ppmptab" role="tabpanel" aria-labelledby="ppmp-tab"
            style="border-top: 1px solid #009879; margin-top: 10px">
            <div style="background-color: #e9e9e9; padding: 10px">
                @if ($docFile && $docFile->ppmp_file)
                    @php
                        $filePath = storage_path('app/public/' . $docFile->ppmp_file);
                        $fileExists = file_exists($filePath);
                    @endphp

                    @if ($fileExists)
                        <iframe src="{{ asset('storage/' . $docFile->ppmp_file) }}#toolbar=0" type="application/pdf"
                            style="width:100%; height:500px;"></iframe>
                    @else
                        <div>
                            <div class="card text-center" style="width: 250px; border: 1px solid #eee;">
                                <div class="card-body p-3">
                                    <i class="far fa-file-pdf" style="font-size: 60pt"></i>
                                </div>
                                <div class="card-footer bg-white p-2" style="font-size: 15pt">
                                    <small class="text-muted">File not found on server</small>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li class="fileattached">
                                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                                <div class="mailbox-attachment-info">
                                    <span class="mailbox-attachment-name">
                                        <center>No PDF File uploaded</center>
                                    </span>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane fade" id="tracktab" role="tabpanel" aria-labelledby="track-tab">            
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="tracking-list">
                            <div class="tracking-item">
                                <div class="tracking-icon status-intransit">
                                    <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                        data-prefix="fas" data-icon="circle" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                        data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="tracking-date">
                                    <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                        class="img-responsive" alt="order-placed" />
                                </div>
                                <div class="tracking-content">
                                    Purchase Request Submitted<span>{{ \Carbon\Carbon::parse($appItem[0]->pcrtdat)->format('F j, Y h:i:s A') }}</span>
                                </div>
                            </div>

                            @php
                                $item = $appItem->first();
                            @endphp
                             @if(in_array($item->cat_id, ['2','10']))
                                {{-- If status is Approved --}}
                                @if(in_array($item->pstatus, ['6','7', '8', '9', '10', '11', '12', '13', '14', '15', '16']) || in_array($item->status, ['6','7', '8', '9', '10', '11', '12', '13', '14', '15', '16']))
                                    <div class="tracking-item">
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                    248-111 248-248S393 8 256 8z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="tracking-date">
                                            <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                                class="img-responsive" alt="order-placed" />
                                        </div>
                                        <div class="tracking-content">
                                            Approved in MIS - Specification Review
                                            @if(!empty($item->datetech))
                                                <span>{{ \Carbon\Carbon::parse($item->datetech)->format('F j, Y h:i:s A') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    {{-- If status is still Pending --}}
                                    <div class="tracking-item-pending">
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="currentColor"
                                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                    248-111 248-248S393 8 256 8z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="tracking-date">
                                            <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                                class="img-responsive" alt="order-placed" />
                                        </div>
                                        <div class="tracking-content">
                                            Pending in MIS - Specification Review
                                            @if(!empty($item->datetech))
                                                <span>{{ \Carbon\Carbon::parse($item->datetech)->format('F j, Y h:i:s A') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                            {{-- Step 6: Approved by Procurement Office --}}
                            @if (in_array($item->pstatus, ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16']))
                                <div class="tracking-item">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            data-prefix="fas" data-icon="circle" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                            data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request has Approved by the Procurement Office
                                        @if(!empty($item->dateproc))
                                            <span>{{ \Carbon\Carbon::parse($item->dateproc)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 7: Approved by Budget Office --}}
                            @if ($item->pstatus >= 7)
                                <div class="tracking-item {{ $item->pstatus == 7 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request has Approved by the Budget Office
                                        @if(!empty($item->datebud))
                                            <span>{{ \Carbon\Carbon::parse($item->datebud)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 8: Received by Procurement Office --}}
                            @if ($item->pstatus >= 8)
                                <div class="tracking-item {{ $item->pstatus == 8 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request has Received by the Procurement Office
                                        @if(!empty($item->datereceived))
                                            <span>{{ \Carbon\Carbon::parse($item->datereceived)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 9: Canvassing --}}
                            @if ($item->pstatus >= 9) {{-- ✅ FIXED: should check >= 9, not 8 --}}
                                <div class="tracking-item {{ $item->pstatus == 9 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is Canvassing
                                        @if(!empty($item->datecanvassing))
                                            <span>{{ \Carbon\Carbon::parse($item->datecanvassing)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 10: Canvassed --}}
                            @if ($item->pstatus >= 10) {{-- ✅ FIXED: should check >= 10, not 9 --}}
                                <div class="tracking-item {{ $item->pstatus == 10 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is being Canvassed
                                        @if(!empty($item->datecanvassed))
                                            <span>{{ \Carbon\Carbon::parse($item->datecanvassed)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 11: Canvassed --}}
                            @if ($item->pstatus >= 11) {{-- ✅ FIXED: should check >= 11, not 10 --}}
                                <div class="tracking-item {{ $item->pstatus == 11 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is for Philgeps Posting
                                        @if(!empty($item->datephilgeps))
                                            <span>{{ \Carbon\Carbon::parse($item->datephilgeps)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 12: Canvassed --}}
                            @if ($item->pstatus >= 12) {{-- ✅ FIXED: should check >= 12, not 11 --}}
                                <div class="tracking-item {{ $item->pstatus == 12 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is being Posted
                                        @if(!empty($item->dateposted))
                                            <span>{{ \Carbon\Carbon::parse($item->dateposted)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 13: Canvassed --}}
                            @if ($item->pstatus >= 13) {{-- ✅ FIXED: should check >= 13, not 12 --}}
                                <div class="tracking-item {{ $item->pstatus == 13 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is for Bidding
                                        @if(!empty($item->datebidding))
                                            <span>{{ \Carbon\Carbon::parse($item->datebidding)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 14: Canvassed --}}
                            @if ($item->pstatus >= 14) {{-- ✅ FIXED: should check >= 14, not 13 --}}
                                <div class="tracking-item {{ $item->pstatus == 14 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is for Consolidation
                                        @if(!empty($item->dateconsolidate))
                                            <span>{{ \Carbon\Carbon::parse($item->dateconsolidate)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 15: Canvassed --}}
                            @if ($item->pstatus >= 15) {{-- ✅ FIXED: should check >= 15, not 14 --}}
                                <div class="tracking-item {{ $item->pstatus == 15 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is Awarded 
                                        @if(!empty($item->dateawarded))
                                            <span>{{ \Carbon\Carbon::parse($item->dateawarded)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 16: Canvassed --}}
                            @if ($item->pstatus >= 16) {{-- ✅ FIXED: should check >= 16, not 15 --}}
                                <div class="tracking-item {{ $item->pstatus == 16 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is being Purchased
                                        @if(!empty($item->datepurchase))
                                            <span>{{ \Carbon\Carbon::parse($item->datepurchase)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 17: Canvassed --}}
                            @if ($item->pstatus >= 17) {{-- ✅ FIXED: should check >= 17, not 16 --}}
                                <div class="tracking-item {{ $item->pstatus == 17 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is being Returned
                                        @if(!empty($item->datereturned))
                                            <span>{{ \Carbon\Carbon::parse($item->datereturned)->format('F j, Y h:i:s A') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            {{-- Step 18: Canvassed --}}
                            @if ($item->pstatus >= 18) {{-- ✅ FIXED: should check >= 18, not 17 --}}
                                <div class="tracking-item {{ $item->pstatus == 18 ? 'current' : 'completed' }}">
                                    <div class="tracking-icon status-intransit">
                                        <svg class="svg-inline--fa fa-circle fa-w-10" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 
                                                248-111 248-248S393 8 256 8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="tracking-date">
                                        <img src="https://raw.githubusercontent.com/shajo/portfolio/a02c5579c3ebe185bb1fc085909c582bf5fad802/delivery.svg"
                                            class="img-responsive" alt="order-placed" />
                                    </div>
                                    <div class="tracking-content">
                                        Purchase Request is being Forwarded to PEDO
                                        <span>{{ \Carbon\Carbon::parse($item->puptdat)->format('F j, Y h:i:s A') }}</span>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
