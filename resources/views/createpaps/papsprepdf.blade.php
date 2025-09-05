<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PAP's PRE PDF</title>

    <style>
        #papspdftemplate {
		  	font-family: Arial, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
            margin-top: -10px;
		}

		#papspdftemplate td {
			border: 1px solid #000;
            font-size: 6pt;
		  	padding-left: 2px;
		} 
		#papspdftemplate th {
		  	border: 1px solid #000;
		  	font-weight: bold;
		  	font-size: 8pt;
		}
        .prepared-block {
            font-family: Arial, sans-serif;
			font-size: 10px;
		}
    </style>
</head>
<body>
    <div style="text-align: center; font-family:Arial, Helvetica, sans-serif; font-size:12pt">
        <h5 style="font-style:italic; margin-top: -10px">
            CENTRAL PHILIPPINES STATE UNIVERSITY 
             - (@if (Auth::guard('web')->user()->campus_id == '1') Main Campus
                @elseif(Auth::guard('web')->user()->campus_id == '9') Victorias Campus
                @elseif(Auth::guard('web')->user()->campus_id == '7') San Carlos Campus
                @elseif(Auth::guard('web')->user()->campus_id == '4') Hinigaran Campus
                @elseif(Auth::guard('web')->user()->campus_id == '12') Moises Padilla Campus
                @elseif(Auth::guard('web')->user()->campus_id == '6') Ilog Campus
                @elseif(Auth::guard('web')->user()->campus_id == '2') Candoni Campus
                @elseif(Auth::guard('web')->user()->campus_id == '3') Cauayan Campus
                @elseif(Auth::guard('web')->user()->campus_id == '8') Sipalay Campus
                @elseif(Auth::guard('web')->user()->campus_id == '5') Hinobaan Campus
                @elseif(Auth::guard('web')->user()->campus_id == '11') Valladolid Campus
            @endif)
        </h5>
        <h6 style="margin-top: -20px">Kabankalan City, Negros Occidental</h6>
        <h5>
            PROGRAMS/ACTIVITIES/PROJECTS (PAPs)<br>
            PROPOSED BUDGET / PROGRAM OF RECEIPTS AND EXPENDITURES (PRE)
        </h5>
        <h5>
            FISCAL YEAR {{ $planitem->first()->papspreplanyearname }}
        </h5>
    </div>

    <div style="font-family:Arial, Helvetica, sans-serif; font-size:11pt; font-weight:bold">
        <p>{{ $plan->papsuserfundsource }} {{ $plan->papsyearname }} PAPS/PRE: <u> {{ Auth::guard('web')->user()->office->office_name }}</p> </u>
        <p style="margin-top: -7px; font-weight:bold">Fund Source: {{ $plan->papsuserfundsource }}/NEP {{ $plan->papsyearname }}  </p>
    </div>

    <div>
        <table id="papspdftemplate">
            <thead>
                <tr>
                    <th rowspan="2">Programs Projects and Activities</th>
                    <th colspan="2">Proposed Expenditures (Expenses)</th>
                    <th rowspan="2">Total Amount</th>
                    <th rowspan="2">Is this<br>Procurable?<br>(Y/N)</th>
                    <th rowspan="2">Responsible Person</th>
                    <th rowspan="2">Verifiable Evidences<br>(of procurement)</th>
                    <th colspan="12">Financial Targets</th>
                </tr>
                <tr>
                    <th>Expense Account</th>
                    <th>Title</th>
                    <th>Jan</th><th>Feb</th><th>Mar</th><th>Apr</th><th>May</th><th>Jun</th>
                    <th>Jul</th><th>Aug</th><th>Sep</th><th>Oct</th><th>Nov</th><th>Dec</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categories = [
                        'A' => 'General Management and Supervision',
                        'B' => 'Conduct of Activities',
                        'C' => 'Capital Outlay Projects',
                        'D' => 'Non-Financial Related PAPs',
                    ];

                    $grandTotal = 0;

                    $monthTotals = [
                        'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0,
                        'may' => 0, 'jun' => 0, 'jul' => 0, 'aug' => 0,
                        'sep' => 0, 'oct' => 0, 'nov' => 0, 'dec' => 0,
                    ];
                @endphp

                @foreach ($categories as $catKey => $catName)
                    {{-- Main Category --}}
                    <tr>
                        <td colspan="19" style="font-weight:bold; background:#f2f2f2;">
                            {{ $catKey }}. {{ $catName }}
                        </td>
                    </tr>

                    @php
                        $subCounter = 1;
                        $subcategories = $planitem->where('ppa_cat', $catKey)->groupBy('ppa_catsub');
                    @endphp

                    @forelse ($subcategories as $subKey => $items)
                        {{-- Subcategory --}}
                        <tr>
                            <td colspan="19" style="font-weight:bold; background:#e8f6ff;">
                                {{ $catKey . '.' . $subCounter }} {{ $subKey }}
                            </td>
                        </tr>

                        @php $ppaCounter = 1; @endphp
                        @foreach ($items as $item)
                            @php
                                $grandTotal += $item->papsamount;

                                foreach ($monthTotals as $m => $val) {
                                    $monthTotals[$m] += $item->$m ?? 0;
                                }
                            @endphp
                            <tr>
                                {{-- Hierarchical numbering A.1.1, A.1.2, etc --}}
                                <td>{{ $catKey . '.' . $subCounter . '.' . $ppaCounter }} {{ $item->ppa }}</td>
                                <td style="background-color: #bcecff; text-align: center">{{ $item->papsprecode }}</td>
                                <td>{{ $item->uacs_title }}</td>
                                <td style="background-color: #bcecff; text-align: right !important">{{ number_format($item->papsamount, 2) }}</td>
                                <td style="text-align: center">{{ $item->papsprocyn }}</td>
                                <td>{{ $item->papsresperson }}</td>
                                <td>{{ $item->papsevidences }}</td>

                                {{-- Financial months --}}
                                <td>{{ $item->jan ? number_format($item->jan, 2) : '' }}</td>
                                <td>{{ $item->feb ? number_format($item->feb, 2) : '' }}</td>
                                <td>{{ $item->mar ? number_format($item->mar, 2) : '' }}</td>
                                <td>{{ $item->apr ? number_format($item->apr, 2) : '' }}</td>
                                <td>{{ $item->may ? number_format($item->may, 2) : '' }}</td>
                                <td>{{ $item->jun ? number_format($item->jun, 2) : '' }}</td>
                                <td>{{ $item->jul ? number_format($item->jul, 2) : '' }}</td>
                                <td>{{ $item->aug ? number_format($item->aug, 2) : '' }}</td>
                                <td>{{ $item->sep ? number_format($item->sep, 2) : '' }}</td>
                                <td>{{ $item->oct ? number_format($item->oct, 2) : '' }}</td>
                                <td>{{ $item->nov ? number_format($item->nov, 2) : '' }}</td>
                                <td>{{ $item->dec ? number_format($item->dec, 2) : '' }}</td>
                            </tr>
                            @php $ppaCounter++; @endphp
                        @endforeach

                        @php $subCounter++; @endphp
                    @empty
                        <tr>
                            <td colspan="19" style="text-align:center; font-style:italic;">No subcategories under {{ $catKey }}</td>
                        </tr>
                    @endforelse
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #7eb9f7">
                    <td colspan="3" style="font-weight:bold; text-align:left;">Grand Total:</td>
                    <td style="font-weight:bold; text-align:right;">
                        {{ number_format($grandTotal, 2) }}
                    </td>
                    <td colspan="2"></td>
                    <td style="font-weight:bold; text-align:right;"></td>
                    <td style="font-weight:bold;">{{ $monthTotals['jan'] ? number_format($monthTotals['jan'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['feb'] ? number_format($monthTotals['feb'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['mar'] ? number_format($monthTotals['mar'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['apr'] ? number_format($monthTotals['apr'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['may'] ? number_format($monthTotals['may'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['jun'] ? number_format($monthTotals['jun'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['jul'] ? number_format($monthTotals['jul'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['aug'] ? number_format($monthTotals['aug'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['sep'] ? number_format($monthTotals['sep'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['oct'] ? number_format($monthTotals['oct'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['nov'] ? number_format($monthTotals['nov'], 2) : '' }}</td>
                    <td style="font-weight:bold;">{{ $monthTotals['dec'] ? number_format($monthTotals['dec'], 2) : '' }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- <div style="margin-top: 10px">
        <table id="papspdftemplatetotal">
            <thead>
                <tr>
                    <th style="text-align: left; font-weight: bold; font-size: 10pt; text-decoration: underline; width: 360px"></th>
                    <th style="text-align: left; font-weight: bold">=============</th>
                </tr>
            </thead>
        </table>
        <table id="papspdftemplatetotal">
            <thead>
                <tr>
                    <th style="text-align: left; font-weight: bold; font-size: 10pt; text-decoration: underline; width: 360px">TOTAL BUDGET:</th>
                    <th style="text-align: left; font-weight: bold">{{ number_format($planitem->sum('estimated_budget'), 2) }}</th>
                </tr>
            </thead>
        </table>
    </div> --}}

    {{-- <div style="margin-top: 10px">
        <p style="font-size: 8pt; font-family: Arial, sans-serif;">
            <span style="text-decoration: underline">NOTE:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Technical Specifications for each Item/Project being proposed shall be submitted as part of the PPMP
        </p>
    </div> --}}

    <div class="prepared-block" style="text-align: left; margin-right: 20px; margin-top: 5px;">
		<div style="text-align: left; display: inline-block; margin-top: 30px;">
			<div style="margin-bottom: 30px;">Prepared by:<br></div>
			<b>{{ ucfirst(strtolower(Auth::guard('web')->user()->fname)) }} {{ substr(Auth::guard('web')->user()->mname, 0,1) }}. {{ ucfirst(strtolower(Auth::guard('web')->user()->lname)) }}</b><br>
			{{ Auth::guard('web')->user()->role }}
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 30px;">Verified and submitted by:<br></div>
			<b>XXXX</b><br>
			Campus Administrator
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 30px;">PAP's Reviewed by:<br></div>
			<b>ENGR. MARIA CRISTINA I. CANSON-BADAJOS</b><br>
			Director, Planning and Development Office
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 30px;">Recommending Approval:<br></div>
			<b>ELFRED M. SUMONGSONG</b><br>
			Supervising Administrative Officer
		</div>
	</div>
</body>
</html>