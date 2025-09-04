@extends('layouts.master')

@section('body')
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Create PPMP</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-start">
                            PROJECT PROCUREMENT MANAGEMENT PLAN &nbsp;<span style="font-weight: bold">{{ $plan->pryearname ?? '' }}</span>
                            <div class=" d-flex justify-content-start" style="margin-left: auto;">
                                @php
                                    $planItemExists = \App\Models\ProcurementPlanItem::where('plan_id', $plan->id)->exists();
                                @endphp
                                <a href="{{ $planItemExists ? route('ppmpfrompdfTemplate', encrypt($plan->id)) : '#' }}" class="btn btn-outline-danger btn-sm {{ !$planItemExists ? 'disabled' : '' }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View PPMP PDF
                                </a>
                                {{-- <a href="" class="btn btn-outline-success btn-sm ml-2" target="_blank">
                                    <i class="fas fa-file-excel"></i> View PPMP Excel
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="load">
                                <form id="ppmpForm" action="{{ route('ppmp.saveAll') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $plan->id ?? '' }}" name="plan_id">
                                    <input type="text" value="{{ $plan->pryearname ?? '' }}" name="planyearname">

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ppmpdetailCreateRoute = "{{ route('ppmp.saveAll') }}";
        var ppmpRowsPartialRoute = "{{ route('viewlistppmp', '') }}"; 
        var currentPlanId = "{{ encrypt($plan->id) }}"; 
        var ppmpRowsGetPartialRoute = "{{ route('getviewlistppmp', ['ppid' => ':ppid']) }}";
        var routeToPPMP = "{{ route('ppmpfrompdfTemplate', encrypt($plan->id)) }}";
    </script>
    <script>
        function initPPMPFormScripts() {
            document.getElementById('addRow').addEventListener('click', function() {
                let template = document.getElementById('blankRowTemplate');
                let clone = template.content.cloneNode(true);
                document.getElementById('ppmpRows').appendChild(clone);
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.removeRow')) {
                    if (document.querySelectorAll('.ppmp-row').length > 1) {
                        e.target.closest('.ppmp-row').remove();
                    }
                }
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
            initPPMPFormScripts();
        });
    </script>
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('month-cell')) {
                if (e.target.value === 'x') {
                    e.target.value = '';
                } else {
                    e.target.value = 'x';
                }
            }
        });
    </script>
@endsection
