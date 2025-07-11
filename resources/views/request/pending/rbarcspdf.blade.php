<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<style>
		#prtemplate {
		  	font-family: sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	/*font-size: 10pt;*/
		}

		#prtemplate td {
			border: 1px solid #000;
		  	padding: 8px;
		} 
		#prtemplate th {
		  	border: 1px solid #000;
		  	font-weight: normal;
		  	padding: 5px;
		}

		.cell-normal-top-left {
			border-top: 2px solid #000 !important;
			border-left: 2px solid #000 !important;
		}
		.cell-normal-top-right {
			border-top: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
		}
		.cell-normal-top {
			border-top: 2px solid #000 !important;
		}

		.cell-normal-side-left {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-left: 2px solid #000 !important;
		}
		.cell-normal-side-right {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
		}
		.cell-normal-side-inside {
			border-top: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}

		.cell-bold-left {
			border-left: 2px solid #000 !important;
		}
		.cell-bold-right {
			border-right: 2px solid #000 !important;
		}
		.cell-bold-total-left {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
		}
		.cell-bold-total-right {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
		}
		.cell-bold-purpose {
			border-left: 2px solid #000 !important;
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			border-top: 2px solid #000 !important;
			text-align: left !important;
			padding: 8px;
		}
		.cell-requested-empty {
			border-left: 2px solid #000 !important;
		}
		.cell-approved {
			border-right: 2px solid #000 !important;
		}
		.cell-requested-signature-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-requested-signature {
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-approved-signature {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			padding: 8px !important;
		}
		.cell-requested-name-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			font-size: 8pt;
		}
		.cell-requested-name {
			border-bottom: 2px solid #000 !important;
		}
		.cell-approved-name {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}
		.cell-requested-designation-label {
			border-left: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
			font-size: 8pt;
		}
		.cell-requested-designation {
			border-bottom: 2px solid #000 !important;
		}
		.cell-approved-designation {
			border-right: 2px solid #000 !important;
			border-bottom: 2px solid #000 !important;
		}
		.text-item {
			text-align: left !important;
		}


		.attach-label {
			font-size: 10pt;
			text-align: center;
			font-family: sans-serif;
		}
		.typerequest { 
			font-weight: ; 
		}
		.title-form {
			font-family: sans-serif;
			text-align: center;
			font-size: 12pt;
			font-weight: bold;
		}
		.square {
	        width: 15px; 
	        height: 15px; 
	        border: 1px solid #000;
	        background-color: #fff; 
	    }
	</style>
</head>
<body>

	<div align="center" style="margin-top: -10px">
		<img src="{{ public_path('template/assets/img/routeslip.png') }}">
	</div>
	<br>
	<div></div>
	<div class="title-form">Request for Budget Allocation For Purchase Request</div>
	<div class="attach-label text-muted"><b>(Attachment to PR)</b></div>

	<p style="margin-top:-13px"></p>
	
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="67" height="20">PR No.</th>
				<th style="text-align: left;font-size: 8pt;" width="273" height="20">{{-- {{ $reqitem->first()->pr_no }} --}}</th>
				<th style="text-align: center;font-size: 8pt;" width="30" height="20">Date</th>
				<th style="text-align: left;font-size: 8pt;" height="20">
					{{ \Carbon\Carbon::parse($reqitem->first()->pur_created_at)->format('F j, Y') }}
				</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="67">Purpose /<br>Project Title/<br>Subject</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="273">{{ $reqitem->first()->purpose_name }}</th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="30">Amount</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;">
					<strong>{{ number_format($reqitem->sum('total_cost'),) }}</strong>
				</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="67">Requesting<br>Personnel</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="273">{{ $reqitem->first()->fname }} {{ $reqitem->first()->mname }}. {{ $reqitem->first()->lname }}</th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="30">Contact No.</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="11%" height="20">Campus</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="24%" height="20">{{ $reqitem->first()->campus_name }}</th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="10%" height="20">Office</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;">{{ $reqitem->first()->office_name }}</th>
			</tr>
		</thead>
	</table>

	<div></div>
	<div class="title-form">Action Taken</div>
	<center><span style="font-size: 9pt">(For use by the Budget Office)</span></center>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Recommend 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->pstatus == 4 ? 'checked' : '' }}>
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">Comment(s) /<br>Suggestion(s)</th>
				<th style="text-align: left;font-size: 8pt;">@if($reqitem->first()->pstatus == 4) {{ $reqitem->first()->reasons }} @endif</th>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Not Recommend 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->pstatus == 5 ? 'checked' : '' }}>
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">Reason(s)</th>
				<th style="text-align: left;font-size: 8pt;">@if($reqitem->first()->pstatus == 5) {{ $reqitem->first()->reasons }} @endif</th>
			</tr>
			<tr>
				<th style="text-align: left;font-size: 8pt;" width="18%" height="20">
					<div style="margin-top: 5px;">
					    Return to Client 
					</div>
					<div style="margin-top: -90px; margin-left: 100px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->pstatus == 3 ? 'checked' : '' }}>
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt;" width="11%" height="20">With further /<br>Instuction(s)</th>
				<th style="text-align: left;font-size: 8pt;">@if($reqitem->first()->pstatus == 3) {{ $reqitem->first()->reasons }} @endif</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th colspan="4" style="border-top: none; text-align: left;">Recommended Funding Source(s):</th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; font-size: 8pt;" width="43"  height="20">Campus</th>
				<th style="border-top: none; font-size: 8pt;" width="145"  height="20">{{ $reqitem->first()->campus_name }}</th>
				<th style="border-top: none; font-size: 8pt;" width="43"  height="20">Program / Activity /<br>Project</th>
				<th style="border-top: none; font-size: 8pt;" width="180"  height="20"></th>
			</tr>
		</thead>
	</table>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="46">Financing<br>Source</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="152" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->financing_source == 1 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    General Fund (MDS Fund)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->financing_source == 2 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Off-Budget Fund
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->financing_source == 3 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Custodial Fund
					</div>
				</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="46">Authorization</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="190" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 1 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    New gen. Appropriations (Current Year Budget)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 2 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Continuing Appropriations (Prior Year's Budget)
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 3 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Special Purpose Fuunds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 4 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Retained Income / Funds 
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 5 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Revolving Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_auth == 6 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Receipts
					</div>
				</th>

			</tr>
		</thead>
	</table>

	<table id="prtemplate">
		<thead>
			<tr>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="46">Fund Cluster</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="150" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_cluster == 1 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Regular Fund Agency
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_cluster == 2 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Internally-Generated Income
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_cluster == 3 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Business Type Income
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_cluster == 4 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Fund
					</div>
				</th>
				<th style="border-top: none; text-align: left; font-size: 8pt;" width="46">Fund Category</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="190" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_category == 1 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Specific Budget of NGAs
					</div>
					<div style="margin-top: -4px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_category == 2 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Special Purpose Fuunds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_category == 3 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Retained Income / Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_category == 4 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Revolving Funds
					</div>
					<div style="margin-top: -3px; margin-left: 0px;">
					    <input type="checkbox" name="" class="" {{ $reqitem->first()->fund_category == 5 ? 'checked' : '' }}>
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    Trust Receipts
					</div>
				</th>

			</tr>
		</thead>
	</table>

	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="53" height="20">Specific Fund/<br>Income Source</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="171" height="20"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="50" height="20">Purpose/Project</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>
	
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="53" height="20">Allotment Class</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;" width="80" height="20">
					<div style="margin-top: -5px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    MOOE
					</div>
					<div style="margin-top: -4px; margin-left: 0px;">
					    <input type="checkbox" name="" class="">
					</div>
					<div style="margin-top: -18px; margin-left: 18px;">
					    CO
					</div>
				</th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="50" height="20">Account Code</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
				<th style="text-align: center;font-size: 8pt; border-top: none;" width="50" height="20">Amount</th>
				<th style="text-align: left;font-size: 8pt; border-top: none;"></th>
			</tr>
		</thead>
	</table>

	<table id="prtemplate">
		<thead>
			<tr>
				<th rowspan="" style="border-top: none; border-bottom: none; font-size: 8pt; text-align: left;" width="20%"  height="20">
					Allotment / Budget Avable: P _____________________<br>
					maximum only.
				</th>
			</tr>
			<tr></tr>
			<tr>
				<th style="border-top: none; font-size: 10pt; text-align: center;" width="20%"  height="20">
					<u><b>SHEILA MAE V. ANABO</b></u><br><span>Budget Officer</span>
				</th>
			</tr>
		</thead>
	</table>
</body>
</html>