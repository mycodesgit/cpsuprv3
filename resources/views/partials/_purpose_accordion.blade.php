<div class="accordion" id="purposeAccordion">
    @foreach ($purposes as $index => $purpose)
        <div class="alert alert-light mb-0">
            <div class="form-group mb-0 d-flex align-items-center">
                <label class="mb-0 me-2 mt-0 text-bold" style="white-space: nowrap;">Edit Purpose:</label>
                <input type="text" class="form-control editable-purpose-name border-0" value="{{ $purpose->first()->purpose_name }}" data-id="{{ $purpose->first()->purpose_id  }}" style="">
            </div>
        </div>
        <div class="card">
            <div class="d-flex justify-content-between align-items-center" id="heading{{ $index }}"></div>
            <div id="collapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : 'show' }}" data-bs-parent="#purposeAccordion">
                <div class="card-body p-0">
                    <table class="table table-sm table-striped m-0">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Cost</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_cost = 0; @endphp
                            @foreach ($purpose as $item)
                                @php $total_cost += $item->total_cost; @endphp
                                <tr>
                                    <td>{{ $item->item_descrip }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>₱{{ number_format($item->item_cost, 2) }}</td>
                                    <td>₱{{ number_format($item->total_cost, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr class="fw-bold">
                                <td colspan="3" class="text-end">Total:</td>
                                <td>₱{{ number_format($total_cost, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('selectItems', encrypt($purpose[0]->purpose_id)) }}" class="btn btn-success">Proceed for Submission</a>
            <hr>
        </div>
    @endforeach
</div>
