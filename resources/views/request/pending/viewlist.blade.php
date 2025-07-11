

<div class="card-body">
    <ul class="nav nav-pills text-sm" id="myTab4" role="tablist" style="gap: 2px;">
        <li class="nav-item">
            <a class="nav-link active show" id="pr-tab" data-toggle="tab" href="#prtab"
                role="tab" aria-controls="first" aria-selected="true">PR Table
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="prpdf-tab" data-toggle="tab" href="#prpdftab"
                role="tab" aria-controls="second" aria-selected="false">PR PDF
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="receipt-tab" data-toggle="tab" href="#receipttab"
                role="tab" aria-controls="third" aria-selected="false">Receipt Slip
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="remarks-tab" data-toggle="tab" href="#remarkstab"
                role="tab" aria-controls="fourth" aria-selected="false">Remarks
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="pow-tab" data-toggle="tab" href="#powtab"
                role="tab" aria-controls="fifth" aria-selected="false">POW
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link ml-1" id="ppmp-tab" data-toggle="tab" href="#ppmptab"
                role="tab" aria-controls="sixth" aria-selected="false">PPMP
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
                        @php $no = 1; $grandTotal = 0; @endphp
                        @foreach($pendItem as $data)
                        <tr id="tr-{{ $data->iid }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $data->category_name }}</td>
                            <td>{{ $data->unit_name }}</td>
                            <td>{{ $data->item_descrip }}</td>
                            <td>{{ $data->fitem_cost }}</td>
                            <td>{{ $data->qty }}</td>
                            <td>{{ number_format($data->total_cost, 2) }}</td>
                            @if(is_numeric(str_replace(',', '', $data->total_cost)))
                                @php $grandTotal += str_replace(',', '', $data->total_cost); @endphp
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Grand Total:</strong></td>
                            <td style="background-color: #e9e9e9"><strong id="granTotal">{{ number_format($grandTotal, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="prpdftab" role="tabpanel" aria-labelledby="prpdf-tab">
            @php
                $currentRoute = request()->route()->getName();
            @endphp

            @if ($currentRoute == 'pendingListView')
                <iframe src="{{ route('PDFprPending', encrypt($data['purpose_id'])) }} #toolbar=0" width="100%" height="800"></iframe>
            @elseif ($currentRoute == 'pendingAllListView')
                <iframe src="{{ route('PDFprAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="800"></iframe>
            @elseif ($currentRoute == 'pendingAllListTechView')
                <iframe src="{{ route('PDFprAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="500"></iframe>
            @else
                <iframe src="{{ route('PDFprPending', encrypt($data['purpose_id'])) }}" width="100%" height="500"></iframe>
            @endif
        </div>
        <div class="tab-pane fade" id="receipttab" role="tabpanel" aria-labelledby="receipt-tab">
            @php
                $currentRoute = request()->route()->getName();
            @endphp

            @if ($currentRoute == 'pendingListView')
                <iframe src="{{ route('PDFrbarasPending', encrypt($data['purpose_id'])) }} #toolbar=0" width="100%" height="500"></iframe>
            @elseif ($currentRoute == 'pendingAllListView')
                <iframe src="{{ route('PDFrbarasAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="500"></iframe>
            @elseif ($currentRoute == 'pendingAllListTechView')
                <iframe src="{{ route('PDFrbarasAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="500"></iframe>
            @else
                <iframe src="{{ route('PDFrbarasAllPending', encrypt($data['purpose_id'])) }}" width="100%" height="500"></iframe>
            @endif
        </div>
        <div class="tab-pane fade" id="remarkstab" role="tabpanel" aria-labelledby="remarks-tab">
            @if(Auth::user()->role =='Checker')
                <form action="{{ route('checkingPR') }}" class="form-horizontal" method="post" id="addItem">
                    @csrf
                    
                    <input type="hidden" name="purpose_id" value="{{ encrypt($data->purpose_id ?? '') }}">
                    <input type="hidden" name="officeidreturn" value="{{ Auth::guard('web')->user()->role }}">
                    <input type="hidden" name="trnsacno" value="{{ $pendItem->first()->transaction_no }}">
                    <input type="hidden" name="userid" value="{{ $pendItem->first()->user_id }}">
                    <input type="hidden" name="userprno" value="{{ $pendItem->first()->pr_no }}">

                    <div class="row">
                        <div class="col-4">
                            <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PR Status:</span>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <select class="form-control form-control-sm" name="status">
                                            <option disabled selected>Select</option>
                                            @php
                                                $reqitem = $pendItem->first();
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
                                        @foreach($pendItem as $index => $item)
                                            @if($index === 0)
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
                                            <option value="1" @if (old('prstatus') == 1 || ($pendItem->isNotEmpty() && $pendItem[0]->prstatus == '1')) {{ 'selected' }} @endif>With PPMP</option>
                                            <option value="2" @if (old('prstatus') == 2 || ($pendItem->isNotEmpty() && $pendItem[0]->prstatus == '2')) {{ 'selected' }} @endif>Without PPMP</option>
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
        </div>
    </div>
</div>
