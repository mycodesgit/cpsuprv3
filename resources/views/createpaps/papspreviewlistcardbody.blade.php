<head>
    <link rel="stylesheet" href="{{ asset('template/assets/js/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/js/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <style>

        /* Force Select2 to match Bootstrap .form-control-sm */
        .select2-container--default .select2-selection--single {
            height: calc(1.8125rem + 2px) !important; /* ~31px (same as .form-control-sm) */
            min-height: calc(1.8125rem + 2px) !important;
            /* border: 1px solid #ced4da !important; */
            border-radius: .2rem !important;
            font-size: 0.875rem !important;
            padding: 0.25rem 0.5rem !important;
            display: flex !important;
            align-items: center !important; /* vertical align */
        }

        /* Adjust text inside */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 0 !important;
            line-height: 3 !important;
            font-size: 0.875rem !important;
        }

        /* Adjust arrow size + position */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            top: 50% !important;
            transform: translateY(-50%); /* center vertically */
        }
    </style>
</head>

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
            <h4 class="mt-4">{{ $catKey }}. {{ $catName }}</h4>

            <div id="category{{ $catKey }}">
                {{-- Existing subcategories from DB --}}
                @foreach($planitem->where('ppa_cat',$catKey)->groupBy('ppa_catsub') as $subKey => $subItems)
                    <div class="subcategory-block mb-3" id="subcategory-{{ $catKey }}-{{ Str::slug($subKey,'_') }}">
                        <h5 class="mt-3">{{ $subKey }}</h5>

                        <div class="subcat-rows" id="rows-{{ $catKey }}-{{ Str::slug($subKey,'_') }}">
                            @foreach($subItems as $item)
                                <div class="form-group ppmp-row">
                                    <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
                                        <input type="hidden" name="ppa_cat[]" value="{{ $catKey }}">
                                        <input type="hidden" name="ppa_catsub[]" value="{{ $subKey }}">
                                        <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                                        <div class="pr-3" style="min-width:280px;">
                                            <input type="text" name="ppa[]" value="{{ $item->ppa }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="pr-3" style="min-width:350px;">
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
                                            <input type="text" name="papsprecode[]" value="{{ $item->papsprecode }}" class="form-control form-control-sm papscode-input">
                                        </div>
                                        <div class="pr-3" style="min-width:150px;">
                                            <input type="text" name="papsamount[]" value="{{ $item->papsamount }}" class="form-control form-control-sm total-amount" readonly>
                                        </div>
                                        <div class="pr-3" style="min-width:180px;">
                                            <select name="papsprocyn[]" class="form-control form-control-sm select2 papsprocyn-select">
                                                <option disabled selected>-- Select --</option>
                                                <option value="Yes" {{ $item->papsprocyn == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ $item->papsprocyn == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                        <div class="pr-3" style="min-width:200px;">
                                            <input type="text" name="papsresperson[]" value="{{ $item->papsresperson }}" class="form-control form-control-sm">
                                        </div>
                                        <div class="pr-3" style="min-width:350px;">
                                            <input type="text" name="papsevidences[]" value="{{ $item->papsevidences }}" class="form-control form-control-sm">
                                        </div>
                                        @foreach($months as $m)
                                            <div class="pr-3" style="min-width:115px;">
                                                <input type="text" name="{{ $m }}[]" value="{{ $item->$m }}" class="form-control form-control-sm month-input" inputmode="decimal">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Add Row under subcategory --}}
                        <button type="button" class="btn btn-outline-info btn-sm addRow" data-cat="{{ $catKey }}" data-sub="{{ $subKey }}">
                            <i class="fas fa-plus"></i> Add Row ({{ $subKey }})
                        </button>
                    </div>
                @endforeach
            </div>

            {{-- Add Subcategory under Category --}}
            <div class="form-inline my-2">
                <input type="text" id="newSub{{ $catKey }}" class="form-control form-control-sm mr-2" placeholder="Enter Subcategory">
                <button type="button" class="btn btn-outline-primary btn-sm addSubcategory" data-cat="{{ $catKey }}">+ Add Subcategory</button>
            </div>
        @endforeach

        {{-- Save Button --}}
        <button type="submit" class="btn btn-outline-success mt-4">
            <i class="fas fa-save"></i> Save All
        </button>
    </form>

    {{-- BLANK ROW TEMPLATE --}}
</div>
{{-- <template id="blankRowTemplate1">
    <div class="form-group ppmp-row">
        <div class="d-flex flex-nowrap align-items-center" style="min-width:1200px;">
            <input type="hidden" name="ppa_cat[]" value="__CAT__">
            <input type="hidden" name="ppa_catsub[]" value="__SUB__">
            <input type="hidden" name="item_id[]" value="">
            <div class="pr-3" style="min-width:280px;">
                <label>Programs Projects and Activities :</label>
                <input type="text" name="ppa[]" class="form-control form-control-sm">
            </div>
            <div class="pr-3" style="min-width:350px;">
                <label>Title:</label>
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
                <label>Code:</label>
                <input type="text" name="papsprecode[]" class="form-control form-control-sm papscode-input">
            </div>
            <div class="pr-3" style="min-width:150px;">
                <label>Total Amount:</label>
                <input type="text" name="papsamount[]" class="form-control form-control-sm total-amount" readonly>
            </div>
            <div class="pr-3" style="min-width:180px;">
                <label>Procurable? (Y/N):</label>
                <select name="papsprocyn[]" class="form-control form-control-sm select2 papsprocyn-select">
                    <option disabled selected>-- Select --</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="pr-3" style="min-width:200px;">
                <label>Responsible Person:</label>
                <input type="text" name="papsresperson[]" class="form-control form-control-sm">
            </div>
            <div class="pr-3" style="min-width:350px;">
                <label>Verifiable Evidences (of procurement):</label>
                <input type="text" name="papsevidences[]" class="form-control form-control-sm">
            </div>
            @foreach($months as $m)
                <div class="pr-3" style="min-width:115px;">
                    <label style="font-size:11px;">{{ strtoupper($m) }}</label>
                    <input type="text" name="{{ $m }}[]" class="form-control form-control-sm month-input" inputmode="decimal">
                </div>
            @endforeach
            <div class="pr-3" style="min-width:80px;">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-danger btn-sm removeRow">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template> --}}

<!-- General JS Scripts -->
    <script src="{{ asset('template/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('template/js/CodiePie.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('template/js/scripts.js') }}"></script>
    <script src="{{ asset('template/js/custom.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('template/assets/js/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/assets/js/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- JS Libraies -->
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/assets/js/tables/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/tables/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Chartjs -->
    <script src="{{ asset('template/assets/js/chart.js/Chart.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('template/assets/js/select2/js/select2.full.min.js') }}"></script>