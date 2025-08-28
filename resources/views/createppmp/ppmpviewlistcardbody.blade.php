<div class="load">
    <form id="ppmpForm" action="{{ route('ppmp.saveAll') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $plan->id ?? '' }}" name="plan_id">
        <input type="hidden" value="{{ $plan->pryearname ?? '' }}" name="planyearname">

        <div id="ppmpRows">
            @forelse($planitem as $index => $item)
                <div class="form-group ppmp-row" data-item-id="{{ $item->id }}">
                    <div class="form-row align-items-center">
                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                        <div class="col-md-1">
                            @if($index === 0) <label>CODE:</label> @endif
                            <input type="text" name="code[]" value="{{ $item->code }}" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-2">
                            @if($index === 0) <label>GENERAL DESCRIPTION:</label> @endif
                            <input type="text" name="general_description[]" value="{{ $item->general_description }}" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-1">
                            @if($index === 0) <label>QUANTITY/SIZE:</label> @endif
                            <input type="text" name="quantity_size[]" value="{{ $item->quantity_size }}" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-1">
                            @if($index === 0) <label>EST. BUDGET:</label> @endif
                            <input type="text" name="estimated_budget[]" value="{{ $item->estimated_budget }}" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-2">
                            @if($index === 0) <label>MODE OF PROCUREMENT:</label> @endif
                            <input type="text" name="mode_of_procurement[]" value="{{ $item->mode_of_procurement }}" class="form-control form-control-sm autosave-input">
                        </div>

                        @php
                            $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
                        @endphp
                        @foreach($months as $m)
                            <div class="col-md-1 p-1 text-center" style="max-width: 40px;">
                                @if($index === 0) <label style="font-size:11px;">{{ strtoupper($m) }}</label> @endif
                                <input type="text" maxlength="1" name="{{ $m }}[]" value="{{ $item->$m }}" class="form-control form-control-sm text-center autosave-input month-cell">
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                {{-- First empty row with labels --}}
                <div class="form-group ppmp-row">
                    <div class="form-row align-items-center">
                        <input type="hidden" name="item_id[]" value="">
                        <div class="col-md-1">
                            <label>CODE:</label>
                            <input type="text" name="code[]" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-2">
                            <label>GENERAL DESCRIPTION:</label>
                            <input type="text" name="general_description[]" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-1">
                            <label>QUANTITY/SIZE:</label>
                            <input type="text" name="quantity_size[]" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-1">
                            <label>EST. BUDGET:</label>
                            <input type="text" name="estimated_budget[]" class="form-control form-control-sm autosave-input">
                        </div>
                        <div class="col-md-2">
                            <label>MODE OF PROCUREMENT:</label>
                            <input type="text" name="mode_of_procurement[]" class="form-control form-control-sm autosave-input">
                        </div>
                        @php
                            $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
                        @endphp
                        @foreach($months as $m)
                            <div class="col-md-1 p-1 text-center" style="max-width: 40px;">
                                <label style="font-size:11px;">{{ strtoupper($m) }}</label>
                                <input type="text" maxlength="1" name="{{ $m }}[]" class="form-control form-control-sm text-center autosave-input month-cell">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforelse
        </div>

        <button type="button" id="addRow" class="btn btn-outline-info mt-2">
            <i class="fas fa-plus"></i> Add Row
        </button>
        <button type="submit" class="btn btn-outline-success mt-2">
            <i class="fas fa-save"></i> Save
        </button>
    </form>

    {{-- Hidden blank row template --}}
    <template id="blankRowTemplate">
        <div class="form-group ppmp-row">
            <div class="form-row align-items-center">
                <input type="hidden" name="item_id[]" value="">
                <div class="col-md-1"><input type="text" name="code[]" class="form-control form-control-sm autosave-input"></div>
                <div class="col-md-2"><input type="text" name="general_description[]" class="form-control form-control-sm autosave-input"></div>
                <div class="col-md-1"><input type="text" name="quantity_size[]" class="form-control form-control-sm autosave-input"></div>
                <div class="col-md-1"><input type="text" name="estimated_budget[]" class="form-control form-control-sm autosave-input"></div>
                <div class="col-md-2"><input type="text" name="mode_of_procurement[]" class="form-control form-control-sm autosave-input"></div>
                @foreach($months as $m)
                    <div class="col-md-1 p-1 text-center" style="max-width: 40px;">
                        <input type="text" maxlength="1" name="{{ $m }}[]" class="form-control form-control-sm text-center autosave-input month-cell">
                    </div>
                @endforeach
                <div class="col-md-1 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger btn-sm removeRow" style="margin-top:5px;">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </template>

    
</div>