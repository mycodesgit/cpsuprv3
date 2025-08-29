@extends('layouts.master')

@section('body')
    <style>
        label {
            font-weight: bold !important;
        }
    </style>
    <section class="section">
        <div class="" style="margin-left: -20px; margin-right: -20px; border-radius: 5px; margin-top: 20px; padding: 3px;">
            <h5>Create PAPs PRE</h5>
        </div>

        <div class="section-body" style="margin-left: -20px; margin-right: -20px; border-radius: 5px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-start">
                            PROPOSED BUDGET / PROGRAM OF RECEIPTS AND EXPENDITURES (PRE) &nbsp;<span style="font-weight: bold">{{ $plan->pryearname ?? '' }}</span>
                            <div class=" d-flex justify-content-start" style="margin-left: auto;">
                                @php
                                    $planItemExists = \App\Models\ProcurementPlanItem::where('plan_id', $plan->id)->exists();
                                @endphp
                                <a href="{{ $planItemExists ? route('ppmpfrompdfTemplate', encrypt($plan->id)) : '#' }}" class="btn btn-outline-danger btn-sm {{ !$planItemExists ? 'disabled' : '' }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View PAPs PRE PDF
                                </a>
                                {{-- <a href="" class="btn btn-outline-success btn-sm ml-2" target="_blank">
                                    <i class="fas fa-file-excel"></i> View PPMP Excel
                                </a> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="load" style="overflow-x:auto;">
                                <form id="papsForm" action="{{ route('ppmp.papssaveAll') }}" method="POST" class="mb-3">
                                    @csrf
                                    <input type="hidden" value="{{ $plan->id ?? '' }}" name="papspreplan_id">
                                    <input type="hidden" value="{{ $plan->papsyearname ?? '' }}" name="papspreplanyearname">

                                    <div id="ppmpRows">
                                        @forelse($planitem as $index => $item)
                                            <div class="form-group ppmp-row">
                                                <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">
                                                    
                                                    <div class="pr-3" style="min-width:280px;">
                                                        <label>Programs Projects and Activities :</label>
                                                        <input type="text" name="ppa[]" value="{{ $item->ppa }}" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:200px;">
                                                        <label>Title:</label>
                                                        <input type="text" name="papstitle[]" value="{{ $item->papstitle }}" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:120px;">
                                                        <label>Code:</label>
                                                        <input type="text" name="papsprecode[]" value="{{ $item->papsprecode }}" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:150px;">
                                                        <label>Total Amount:</label>
                                                        <input type="text" name="papsamount[]" value="{{ $item->papsamount }}" class="form-control form-control-sm autosave-input total-amount" readonly>
                                                    </div>

                                                    <div class="pr-3" style="min-width:180px;">
                                                        <label>Procurable? (Y/N):</label>
                                                        <select name="papsprocyn[]" class="form-control form-control-sm autosave-input">
                                                            <option disabled {{ $item->papsprocyn == null ? 'selected' : '' }}>-- Select --</option>
                                                            <option value="Yes" {{ $item->papsprocyn == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ $item->papsprocyn == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>

                                                    <div class="pr-3" style="min-width:200px;">
                                                        <label>Responsible Person:</label>
                                                        <input type="text" name="papsresperson[]" value="{{ $item->papsresperson }}" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:350px;">
                                                        <label>Verifiable Evidences (of procurement):</label>
                                                        <input type="text" name="papsevidences[]" value="{{ $item->papsevidences }}" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    @php
                                                        $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
                                                    @endphp
                                                    @foreach($months as $m)
                                                        <div class="pr-3" style="min-width:115px;">
                                                            <label style="font-size:11px;">{{ strtoupper($m) }}</label>
                                                            <input type="text" name="{{ $m }}[]" value="{{ $item->$m }}" class="form-control form-control-sm autosave-input month-input" inputmode="decimal">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @empty
                                            {{-- First empty row with labels --}}
                                            <div class="form-group ppmp-row">
                                                <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                                    <input type="hidden" name="item_id[]" value="">
                                                    
                                                    <div class="pr-3" style="min-width:280px;">
                                                        <label>Programs Projects and Activities :</label>
                                                        <input type="text" name="ppa[]" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:200px;">
                                                        <label>Title:</label>
                                                        <input type="text" name="papstitle[]" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:120px;">
                                                        <label>Code:</label>
                                                        <input type="text" name="papsprecode[]" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:150px;">
                                                        <label>Total Amount:</label>
                                                        <input type="text" name="papsamount[]" class="form-control form-control-sm autosave-input total-amount" readonly>
                                                    </div>

                                                    <div class="pr-3" style="min-width:180px;">
                                                        <label>Procurable? (Y/N):</label>
                                                        <select name="papsprocyn[]" class="form-control form-control-sm autosave-input">
                                                            <option disabled selected>-- Select --</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>

                                                    <div class="pr-3" style="min-width:200px;">
                                                        <label>Responsible Person:</label>
                                                        <input type="text" name="papsresperson[]" class="form-control form-control-sm autosave-input">
                                                    </div>

                                                    <div class="pr-3" style="min-width:350px;">
                                                        <label>Verifiable Evidences (of procurement):</label>
                                                        <input type="text" name="papsevidences[]" class="form-control form-control-sm autosave-input">
                                                    </div>
                                                    @php
                                                        $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
                                                    @endphp
                                                    @foreach($months as $m)
                                                        <div class="pr-3" style="min-width:115px;">
                                                            <label style="font-size:11px;">{{ strtoupper($m) }}</label>
                                                            <input type="text" name="{{ $m }}[]" class="form-control form-control-sm autosave-input month-input" inputmode="decimal">
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
                                        <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                            <div class="pr-3" style="min-width:280px;">
                                                <input type="text" name="ppa[]" class="form-control form-control-sm autosave-input">
                                            </div>

                                            <div class="pr-3" style="min-width:200px;">
                                                <input type="text" name="papstitle[]" class="form-control form-control-sm autosave-input">
                                            </div>

                                            <div class="pr-3" style="min-width:120px;">
                                                <input type="text" name="papsprecode[]" class="form-control form-control-sm autosave-input">
                                            </div>

                                            <div class="pr-3" style="min-width:150px;">
                                                <input type="text" name="papsamount[]" class="form-control form-control-sm autosave-input total-amount" readonly>
                                            </div>

                                            <div class="pr-3" style="min-width:180px;">
                                                <select name="papsprocyn[]" class="form-control form-control-sm autosave-input">
                                                    <option disabled selected>-- Select --</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>

                                            <div class="pr-3" style="min-width:200px;">
                                                <input type="text" name="papsresperson[]" class="form-control form-control-sm autosave-input">
                                            </div>

                                            <div class="pr-3" style="min-width:350px;">
                                                <input type="text" name="papsevidences[]" class="form-control form-control-sm autosave-input">
                                            </div>

                                            @php
                                                $months = ['january','february','march','april','may','june','july','august','september','october','november','december'];
                                            @endphp

                                            @foreach($months as $m)
                                                <div class="pr-3" style="min-width:115px;">
                                                    <input type="text" name="{{ $m }}[]" class="form-control form-control-sm autosave-input month-input" inputmode="decimal">
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
        var papsdetailCreateRoute = "{{ route('ppmp.papssaveAll') }}";
        var papsRowsPartialRoute = "{{ route('viewlistpapspre', '') }}"; 
        var currentPlanId = "{{ encrypt($plan->id) }}"; 
        var papsRowsGetPartialRoute = "{{ route('getviewlistpaps', ['ppid' => ':ppid']) }}";
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
        document.addEventListener("DOMContentLoaded", function () {
            let inputs = document.querySelectorAll(".month-input");

            inputs.forEach(function(input) {
                // Allow only numbers + decimal
                input.addEventListener("input", function(e) {
                    this.value = this.value.replace(/[^0-9.]/g, '');
                });

                // On blur (when leaving input), format with .00
                input.addEventListener("blur", function() {
                    if (this.value !== "") {
                        let val = parseFloat(this.value).toFixed(2); // force 2 decimal places
                        this.value = val;
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Function to format number with 2 decimals
            function formatNumber(val) {
                if (isNaN(val) || val === "") return "";
                return parseFloat(val).toFixed(2);
            }

            // Listen to inputs for each row
            document.querySelectorAll(".ppmp-row").forEach(function(row) {
                let monthInputs = row.querySelectorAll(".month-input");
                let totalInput = row.querySelector(".total-amount");

                monthInputs.forEach(function(input) {
                    // Allow only numbers + decimal
                    input.addEventListener("input", function() {
                        this.value = this.value.replace(/[^0-9.]/g, '');
                    });

                    // On blur: format value and update total
                    input.addEventListener("blur", function() {
                        if (this.value !== "") {
                            this.value = formatNumber(this.value);
                        }
                        updateTotal();
                    });
                });

                function updateTotal() {
                    let sum = 0;
                    monthInputs.forEach(function(inp) {
                        let val = parseFloat(inp.value);
                        if (!isNaN(val)) sum += val;
                    });
                    totalInput.value = formatNumber(sum);
                }
            });
        });
        </script>


@endsection
