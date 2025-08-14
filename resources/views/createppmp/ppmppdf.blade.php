<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PPMP PDF</title>

    <style>
        #ppmppdftemplate {
		  	font-family: Arial, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		}

		#ppmppdftemplate td {
			border: 1px solid #000;
		  	padding: 5px;
            font-size: 9pt;
		} 
		#ppmppdftemplate th {
		  	border: 1px solid #000;
		  	font-weight: bold;
		  	font-size: 10pt;
		}

        #ppmppdftemplatetotal {
		  	font-family: Arial, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	font-size: 10pt;
		}

		#ppmppdftemplatetotal td {
			border: none;
		  	padding: 8px;
		} 
		#ppmppdftemplatetotal th {
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
            PROJECT PROCUREMENT MANAGEMENT PLAN (PPMP)
        </h5>
    </div>

    <div style="font-family:Arial, Helvetica, sans-serif; font-size:11pt; font-style:italic">
        <p>END-USER/UNIT:</p>
        <p style="margin-top: -7px; font-weight:bold">Charged to:</p>
        <p style="margin-top: -7px; font-weight:initial">Projects, Programs and Activities (PAPs)</p>
    </div>

    <div>
        <table id="ppmppdftemplate">
            <thead>
                <tr>
                    <th rowspan="2">CODE</th>
                    <th rowspan="2">GENERAL DESCRIPTION</th>
                    <th>QUANTITY</th>
                    <th rowspan="2">ESTIMATED<br>BUDGET</th>
                    <th rowspan="2">Mode of<br>Procurement</th>
                    <th colspan="12">SCHEDULE/MILESTONE OF ACTIVITIES</th>
                </tr>
                <tr>
                    <th>SIZE</th>
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
                <tr>
                    <th></th>
                    <th colspan="16" style="text-align: left !important; padding-left: 10px;">A1. Office Management</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planitem as $item)
                    <tr>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->general_description }}</td>
                        <td>{{ $item->quantity_size }}</td>
                        <td>{{ number_format($item->estimated_budget, 2) }}</td>
                        <td>{{ $item->mode_of_procurement }}</td>
                        <td>{{ $item->jan }}</td>
                        <td>{{ $item->feb }}</td>
                        <td>{{ $item->mar }}</td>
                        <td>{{ $item->apr }}</td>
                        <td>{{ $item->may }}</td>
                        <td>{{ $item->jun }}</td>
                        <td>{{ $item->jul }}</td>
                        <td>{{ $item->aug }}</td>
                        <td>{{ $item->sep }}</td>
                        <td>{{ $item->oct }}</td>
                        <td>{{ $item->nov }}</td>
                        <td>{{ $item->dec }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 10px">
        <table id="ppmppdftemplatetotal">
            <thead>
                <tr>
                    <th style="text-align: left; font-weight: bold; font-size: 10pt; text-decoration: underline; width: 360px"></th>
                    <th style="text-align: left; font-weight: bold">=============</th>
                </tr>
            </thead>
        </table>
        <table id="ppmppdftemplatetotal">
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