@extends('layouts.master')

@section('body')
    <style>
        label {
            font-weight: thin !important;
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
                        <div class="card-header d-flex justify-content-start" style="font-weight: bold; color: #000">
                            PROPOSED BUDGET / PROGRAM OF RECEIPTS AND EXPENDITURES (PRE) &nbsp;<span style="font-weight: bold">{{ $plan->pryearname ?? '' }}</span>
                            <div class=" d-flex justify-content-start" style="margin-left: auto;">
                                @php
                                    $planItemExists = \App\Models\PapsPrePlanItem::where('papspreplan_id', $plan->id)->exists();
                                @endphp
                                
                                <button class="btn btn-outline-success btn-sm" id="refreshPageBtn">
                                    <i class="fas fa-refresh"></i> Refresh/Reload
                                </button>&nbsp;&nbsp;

                                <a href="{{ $planItemExists ? route('papsprefrompdfTemplate', encrypt($plan->id)) : '#' }}" class="btn btn-outline-danger btn-sm {{ !$planItemExists ? 'disabled' : '' }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View PAPs PRE PDF
                                </a>
                                &nbsp;&nbsp;
                                <a href="{{ $planItemExists ? route('papspreitemsppmp', encrypt($plan->id)) : '#' }}" class="btn btn-outline-info btn-sm {{ !$planItemExists ? 'disabled' : '' }}">
                                    <i class="fas fa-file"></i> Create PPMP
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="load" style="overflow-x:auto;">
                                <form id="papsForm" action="{{ route('ppmp.papssaveAll') }}" method="POST" class="mb-3">
                                    @csrf
                                    <input type="hidden" value="{{ $plan->id ?? '' }}" name="papspreplan_id">
                                    <input type="hidden" value="{{ $plan->papsyearname ?? '' }}" name="papspreplanyearname">

                                    @php
                                        $categories = [
                                            'A' => 'General Management and Supervision',
                                            'B' => 'Conduct of Activities',
                                            'C' => 'Capital Outlay Projects',
                                            'D' => 'Non-Financial Related PAPs'
                                        ];
                                        $months = ['jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec'];
                                    @endphp

                                    {{-- LOOP CATEGORIES --}}
                                    @foreach($categories as $catKey => $catName)
                                        <h4 class="mt-4" style="color: #000">{{ $catKey }}. {{ $catName }}</h4>

                                        <div id="category{{ $catKey }}">
                                            {{-- Existing subcategories from DB --}}
                                            @foreach($planitem->where('ppa_cat',$catKey)->groupBy('ppa_catsub') as $subKey => $subItems)
                                                <div class="subcategory-block mb-3" id="subcategory-{{ $catKey }}-{{ Str::slug($subKey,'_') }}">
                                                    <h5 class="mt-3" style="color: #000">{{ $subKey }}</h5>

                                                    <div class="subcat-rows" id="rows-{{ $catKey }}-{{ Str::slug($subKey,'_') }}">
                                                        @foreach($subItems as $item)
                                                            <div class="form-group ppmp-row">
                                                                <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                                                    <input type="hidden" name="ppa_cat[]" value="{{ $catKey }}">
                                                                    <input type="hidden" name="ppa_catsub[]" value="{{ $subKey }}">
                                                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                                                                    <div class="pr-3" style="min-width:280px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Programs Projects and Activities :</label> 
                                                                        @endif
                                                                        <input type="text" name="ppa[]" value="{{ $item->ppa }}" class="form-control form-control-sm tinput">
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:350px;">
                                                                        @if($loop->first)
                                                                            <labe style="font-weight: bold; color: #000"l>Title:</labe>
                                                                        @endif
                                                                        <select name="papstitle[]" class="form-control form-control-sm select2 papstitle-select">
                                                                            <option disabled selected> --Select-- </option>
                                                                            @foreach ($uacscode as $itemuacscode)
                                                                                <option value="{{ $itemuacscode->id }}" 
                                                                                        data-code="{{ $itemuacscode->uacs_code }}"
                                                                                        {{ $item->papstitle == $itemuacscode->id ? 'selected' : '' }}>
                                                                                    {{ $itemuacscode->uacs_title }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:120px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Code:</label>
                                                                        @endif
                                                                        <input type="text" name="papsprecode[]" value="{{ $item->papsprecode }}" class="form-control form-control-sm papscode-input tinput">
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:150px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Total Amount:</label>
                                                                        @endif
                                                                        <input type="text" name="papsamount[]" value="{{ $item->papsamount }}" class="form-control form-control-sm total-amount tinput" readonly>
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:180px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Procurable? (Y/N):</label>
                                                                        @endif
                                                                        <select name="papsprocyn[]" class="form-control form-control-sm select2 papsprocyn-select tinput">
                                                                            <option disabled selected>-- Select --</option>
                                                                            <option value="Yes" {{ $item->papsprocyn == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                                            <option value="No" {{ $item->papsprocyn == 'No' ? 'selected' : '' }}>No</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:200px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Responsible Person:</label>
                                                                        @endif
                                                                        <input type="text" name="papsresperson[]" value="{{ $item->papsresperson }}" class="form-control form-control-sm tinput">
                                                                    </div>
                                                                    <div class="pr-3" style="min-width:350px;">
                                                                        @if($loop->first)
                                                                            <label style="font-weight: bold; color: #000">Verifiable Evidences (of procurement):</label>
                                                                        @endif
                                                                        <input type="text" name="papsevidences[]" value="{{ $item->papsevidences }}" class="form-control form-control-sm tinput">
                                                                    </div>
                                                                    @foreach($months as $m)
                                                                        <div class="pr-3" style="min-width:115px;">
                                                                            @if($loop->parent->first)
                                                                                <label style="font-weight: bold; color: #000; font-size:11px;">{{ strtoupper($m) }}</label>
                                                                            @endif
                                                                            <input type="text" name="{{ $m }}[]" value="{{ $item->$m }}" class="form-control form-control-sm month-input" inputmode="decimal">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    {{-- Add Row under subcategory --}}
                                                    <button type="button" class="btn btn-success btn-sm addRow" data-cat="{{ $catKey }}" data-sub="{{ $subKey }}">
                                                        <i class="fas fa-plus"></i> Add Row ({{ $subKey }})
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        {{-- Add Subcategory under Category --}}
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" id="newSub{{ $catKey }}" class="form-control form-control-sm ppa_catsub-input" placeholder="Enter Subcategory">
                                            </div>
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-sm addSubcategory" data-cat="{{ $catKey }}">+ Add Subcategory</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- Save Button --}}
                                    <button type="submit" class="btn btn-outline-success mt-4">
                                        <i class="fas fa-save"></i> Save All
                                    </button>
                                </form>

                                {{-- BLANK ROW TEMPLATE --}}
                            </div>
                            <template id="blankRowTemplate">
                                <div class="form-group ppmp-row">
                                    <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                        <input type="hidden" name="ppa_cat[]" value="__CAT__">
                                        <input type="hidden" name="ppa_catsub[]" value="__SUB__">
                                        <input type="hidden" name="item_id[]" value="">
                                        <div class="pr-3" style="min-width:280px;">
                                            <label style="color: #000">Programs Projects and Activities :</label>
                                            <input type="text" name="ppa[]" class="form-control form-control-sm tinput">
                                        </div>
                                        <div class="pr-3" style="min-width:350px;">
                                            <label style="color: #000">Title:</label>
                                            <select name="papstitle[]" class="form-control form-control-sm select2 papstitle-select">
                                                <option disabled selected> --Select-- </option>
                                                @foreach ($uacscode as $itemuacscode)
                                                    <option value="{{ $itemuacscode->id }}" data-code="{{ $itemuacscode->uacs_code }}">
                                                        {{ $itemuacscode->uacs_title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="pr-3" style="min-width:120px;">
                                            <label style="color: #000">Code:</label>
                                            <input type="text" name="papsprecode[]" class="form-control form-control-sm papscode-input tinput">
                                        </div>
                                        <div class="pr-3" style="min-width:150px;">
                                            <label style="color: #000">Total Amount:</label>
                                            <input type="text" name="papsamount[]" class="form-control form-control-sm total-amount tinput" readonly>
                                        </div>
                                        <div class="pr-3" style="min-width:180px;">
                                            <label style="color: #000">Procurable? (Y/N):</label>
                                            <select name="papsprocyn[]" class="form-control form-control-sm select2 papsprocyn-select">
                                                <option disabled selected>-- Select --</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="pr-3" style="min-width:200px;">
                                            <label style="color: #000">Responsible Person:</label>
                                            <input type="text" name="papsresperson[]" class="form-control form-control-sm tinput" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" value="{{ ucfirst(strtolower(Auth::guard('web')->user()->fname)) }} {{ substr(Auth::guard('web')->user()->mname, 0,1) }}. {{ ucfirst(strtolower(Auth::guard('web')->user()->lname)) }}">
                                        </div>
                                        <div class="pr-3" style="min-width:350px;">
                                            <label style="color: #000">Verifiable Evidences (of procurement):</label>
                                            <input type="text" name="papsevidences[]" class="form-control form-control-sm tinput">
                                        </div>
                                        @foreach($months as $m)
                                            <div class="pr-3" style="min-width:115px;">
                                                <label style="color: #000" style="font-size:11px;">{{ strtoupper($m) }}</label>
                                                <input type="text" name="{{ $m }}[]" class="form-control form-control-sm month-input" inputmode="decimal">
                                            </div>
                                        @endforeach
                                        <div class="pr-3" style="min-width:80px;">
                                            <label style="color: #000">&nbsp;</label>
                                            <button type="submit" class="btn btn-danger btn-sm removeRow">
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
    </section>

    <script>
        var papsdetailCreateRoute = "{{ route('ppmp.papssaveAll') }}";
        var papsRowsPartialRoute = "{{ route('viewlistpapspre', '') }}"; 
        var currentPlanId = "{{ encrypt($plan->id) }}"; 
        var papsRowsGetPartialRoute = "{{ route('getviewlistpaps', ['ppid' => ':ppid']) }}";
        var routeToPPMP = "{{ route('papsprefrompdfTemplate', encrypt($plan->id)) }}";
    </script>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // --- helper: format number to 2 decimals or return empty string ---
            function formatNumber(val) {
                if (val === "" || isNaN(val)) return "";
                return parseFloat(val).toFixed(2);
            }

            // --- update total for a given row element ---
            function updateTotalForRow(row) {
                if (!row) return;
                const monthInputs = Array.from(row.querySelectorAll(".month-input"));
                const totalInput = row.querySelector(".total-amount");

                let sum = 0;
                let hasValue = false;
                monthInputs.forEach(function(inp) {
                    const v = parseFloat(inp.value);
                    if (!isNaN(v)) {
                        sum += v;
                        hasValue = true;
                    }
                });

                if (totalInput) {
                    // only show total if there is at least one valid number
                    totalInput.value = hasValue ? formatNumber(sum) : "";
                }
            }

            // --- attach listeners to all month inputs inside a single row ---
            function attachMonthListeners(row) {
                if (!row || row.dataset.monthAttached === "1") return; // already attached
                const monthInputs = Array.from(row.querySelectorAll(".month-input"));
                if (monthInputs.length === 0) {
                    row.dataset.monthAttached = "1";
                    return;
                }

                monthInputs.forEach(function(input) {
                    // only allow numbers + decimal while typing
                    input.addEventListener("input", function () {
                        this.value = this.value.replace(/[^0-9.]/g, '');
                        updateTotalForRow(row); // live update
                    });

                    // format to 2 decimals only if not empty
                    input.addEventListener("focusout", function () {
                        if (this.value !== "") {
                            this.value = formatNumber(this.value);
                        }
                        updateTotalForRow(row);
                    });
                });

                // initial calculation in case there are prefilled values
                updateTotalForRow(row);

                row.dataset.monthAttached = "1"; // mark row as handled
            }

            // --- initialize existing rows on page load ---
            document.querySelectorAll(".ppmp-row").forEach(function(row) {
                attachMonthListeners(row);
            });

            // --- watch for new rows being added ---
            const observer = new MutationObserver(function(mutationsList) {
                for (const mutation of mutationsList) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType !== 1) return;
                        if (node.matches && node.matches('.ppmp-row')) {
                            attachMonthListeners(node);
                        }
                        const rows = node.querySelectorAll && node.querySelectorAll('.ppmp-row');
                        if (rows && rows.length) {
                            rows.forEach(r => attachMonthListeners(r));
                        }
                    });
                }
            });

            observer.observe(document.body, { childList: true, subtree: true });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("refreshPageBtn").addEventListener("click", function () {
                // Reload the page
                location.reload();
            });
        });
    </script>

@endsection
