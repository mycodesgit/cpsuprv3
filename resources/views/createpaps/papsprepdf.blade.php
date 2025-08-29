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
		}

		#papspdftemplate td {
			border: 1px solid #000;
		  	padding: 3px;
            font-size: 6pt;
		} 
		#papspdftemplate th {
		  	border: 1px solid #000;
		  	font-weight: bold;
		  	font-size: 8pt;
		}

        #papspdftemplatetotal {
		  	font-family: Arial, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	font-size: 10pt;
		}

		#papspdftemplatetotal td {
			border: none;
		  	padding: 8px;
		} 
		#papspdftemplatetotal th {
		  	border: none;
		  	font-weight: normal;
		  	/*padding: 8px;*/
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
                    <th rowspan="2">Programs Projects and Activities </th>
                    <th colspan="2">Proposed Expenditures (Expenses)</th>
                    <th rowspan="2">Total Amount</th>
                    <th rowspan="2">Is this<br>Procurable?<br>(Y/N)</th>
                    <th rowspan="2">Responsible Person</th>
                    <th rowspan="2">Verifiable Evidences<br>(of procurement)</th>
                    <th colspan="12">Financial Targets </th>
                </tr>
                <tr>
                    <th>Expense Account</th>
                    <th>Title</th>
                    <th>Jan</th>
                    <th>Feb</th>
                    <th>Mar</th>
                    <th>Apr</th>
                    <th>May</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Aug</th>
                    <th>Sep</th>
                    <th>Oct</th>
                    <th>Nov</th>
                    <th>Dec</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $categories = [
                        'A' => 'General Management and Supervision',
                        'B' => 'Personnel Development',
                        'C' => 'Capital Outlay Projects',
                        'D' => 'Non-Financial',
                    ];
                @endphp
                @foreach ($categories as $catKey => $catName)
                    <tr>
                        <td colspan="19" style="font-weight:bold; background:#f2f2f2;">
                            {{ $catKey }}. {{ $catName }}
                        </td>
                    </tr>
                    @forelse ($planitem->where('ppa_cat', $catKey) as $item)
                        <tr>
                            <td>{{ $item->ppa }}</td>
                            <td style="background-color: #bcecff; text-align: center">{{ $item->papsprecode }}</td>
                            <td>{{ $item->uacs_title }}</td>
                            <td style="background-color: #bcecff; text-align: right !important">{{ number_format($item->papsamount, 2) }}</td>
                            <td style="text-align: center">{{ $item->papsprocyn }}</td>
                            <td>{{ $item->papsresperson }}</td>
                            <td>{{ $item->papsevidences }}</td>
                            <td>{{ $item->jan !== null && $item->jan != 0 ? number_format($item->jan, 2) : '' }}</td>
                            <td>{{ $item->feb !== null && $item->feb != 0 ? number_format($item->feb, 2) : '' }}</td>
                            <td>{{ $item->mar !== null && $item->mar != 0 ? number_format($item->mar, 2) : '' }}</td>
                            <td>{{ $item->apr !== null && $item->apr != 0 ? number_format($item->apr, 2) : '' }}</td>
                            <td>{{ $item->may !== null && $item->may != 0 ? number_format($item->may, 2) : '' }}</td>
                            <td>{{ $item->jun !== null && $item->jun != 0 ? number_format($item->jun, 2) : '' }}</td>
                            <td>{{ $item->jul !== null && $item->jul != 0 ? number_format($item->jul, 2) : '' }}</td>
                            <td>{{ $item->aug !== null && $item->aug != 0 ? number_format($item->aug, 2) : '' }}</td>
                            <td>{{ $item->sep !== null && $item->sep != 0 ? number_format($item->sep, 2) : '' }}</td>
                            <td>{{ $item->oct !== null && $item->oct != 0 ? number_format($item->oct, 2) : '' }}</td>
                            <td>{{ $item->nov !== null && $item->nov != 0 ? number_format($item->nov, 2) : '' }}</td>
                            <td>{{ $item->dec !== null && $item->dec != 0 ? number_format($item->dec, 2) : '' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="19" style="text-align:center; font-style:italic;">No items under {{ $catKey }}</td>
                        </tr>
                    @endforelse
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 10px">
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
    </div>

    <div style="margin-top: 10px">
        <p style="font-size: 8pt; font-family: Arial, sans-serif;">
            <span style="text-decoration: underline">NOTE:</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Technical Specifications for each Item/Project being proposed shall be submitted as part of the PPMP
        </p>
    </div>

    <div class="prepared-block" style="text-align: left; margin-right: 20px;">
		<div style="text-align: left; display: inline-block; margin-top: 30px;">
			<div style="margin-bottom: 50px;">Prepared by:<br></div>
			<b>Fund Administrator</b><br>
			Designation
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 50px;">Verified and submitted by:<br></div>
			<b>XXXX</b><br>
			Campus Administrator
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 50px;">Reviewed by:<br></div>
			<b>SHEILA MAE V. ANABO, LPT</b><br>
			Administrative Officer V/Budget Officer III
		</div>

        <div style="text-align: left; display: inline-block; margin-left: 150px; margin-top: 30px;">
			<div style="margin-bottom: 50px;">Approved by:<br></div>
			<b>ALADINO C. MORACA, Ph. D.</b><br>
			President
		</div>
	</div>

    <div class="prepared-block" style="text-align: left; margin-right: 20px;">
        <div style="text-align: left; display: inline-block; margin-left: 520px; margin-top: 30px;">
			<br><b>ENGR. KRISTINE B. RODRIGO</b><br>
			Administrative Officer V/Procurement Officer III
		</div>
	</div>
</body>
</html>