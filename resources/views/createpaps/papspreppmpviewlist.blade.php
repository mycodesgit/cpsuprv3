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
                            PROJECT PROCUREMENT MANAGEMENT PLAN &nbsp;<span style="font-weight: bold">{{ $plan->papsyearname ?? '' }}</span>
                            <div class=" d-flex justify-content-start" style="margin-left: auto;">
                                @php
                                    $planItemExists = \App\Models\PapsPrePlanItem::where('papspreplan_id', $plan->id)->exists();
                                @endphp
                                <a href="{{ $planItemExists ? route('ppmpfrompdfTemplate', encrypt($plan->id)) : '#' }}" class="btn btn-outline-danger btn-sm {{ !$planItemExists ? 'disabled' : '' }}" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View PPMP PDF
                                </a>
                                <a href="{{ $planItemExists ? route('viewlistpapspre', encrypt($plan->id)) : '#' }}" class="btn btn-outline-success btn-sm ml-2">
                                    <i class="fas fa-eye"></i> View PAP's PRE
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="load">
                                <form id="ppmpForm" action="{{ route('ppmp.saveAllpapspreppmp') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $plan->id ?? '' }}" name="papspreplanid">
                                    <input type="hidden" value="{{ $plan->papsyearname ?? '' }}" name="planyearname">

                                    <div id="ppmpRows">
                                        @forelse($planitem as $index => $item)
                                            <div class="form-group ppmp-row" data-item-id="{{ $item->id }}">
                                                <div class="form-row align-items-center">
                                                    <input type="hidden" name="item_id[]" value="{{ $item->id }}">

                                                    <div class="col-md-1">
                                                        @if($index === 0) <label>CODE:</label> @endif
                                                        <input type="text" name="" value="{{ $item->papsprecode }}" class="form-control form-control-sm autosave-input" readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        @if($index === 0) <label>GENERAL DESCRIPTION:</label> @endif
                                                        <input type="text" name="" value="{{ $item->uacs_title }}" class="form-control form-control-sm autosave-input" readonly>
                                                    </div>
                                                    <div class="col-md-1">
                                                        @if($index === 0) <label>QUANTITY/SIZE:</label> @endif
                                                        <input type="text" name="quantity_size[]" value="{{ $item->quantity_size }}" class="form-control form-control-sm autosave-input">
                                                    </div>
                                                    <div class="col-md-1">
                                                        @if($index === 0) <label>EST. BUDGET:</label> @endif
                                                        <input type="text" name="" value="{{ $item->papsamount }}" class="form-control form-control-sm autosave-input" readonly>
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
                                                            <input type="text" maxlength="1" name="{{ $m }}[]" value="{{ !empty($item->$m) ? 'x' : '' }}" class="form-control form-control-sm text-center autosave-input month-cell" readonly>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @empty
                                            
                                        @endforelse
                                    </div>

                                    <button type="submit" class="btn btn-outline-success mt-2">
                                        <i class="fas fa-save"></i> Save PPMP
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var ppmpdetailCreateRoute = "{{ route('ppmp.saveAllpapspreppmp') }}";
        var ppmpRowsPartialRoute = "{{ route('viewlistppmp', '') }}"; 
        var currentPlanId = "{{ encrypt($plan->id) }}"; 
        var ppmpRowsGetPartialRoute = "{{ route('getviewlistppmp', ['ppid' => ':ppid']) }}";
        var routeToPPMP = "{{ route('ppmpfrompdfTemplate', encrypt($plan->id)) }}";
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
