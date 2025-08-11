<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Consolidation || Form 1</title>
	<link rel="icon" type="image/png" href="{{ asset('template/img/CPSU_L.png') }}">

	<style>
		#prtemplate {
		  	font-family: Arial;
		  	border-collapse: collapse;
		  	width: 100%;
		  	font-size: 10pt;
		}

		#prtemplate td {
			border: 1px solid #000;
		  	padding: 8px;
		} 
		#prtemplate th {
		  	border: 1px solid #000;
		  	font-weight: normal;
		  	font-size: 11pt;
		  	padding: 8px;
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

		.appendix-no {
			margin-top: -20px;
			text-align: right;
			font-style: italic;
		}
		.title-form {
			margin-top: -10px;
			text-align: center;
			font-size: 12pt;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="appendix-no"><b>Form 2</b></div>
	<br><br><br><br>

	<div class="title-form">CONSOLIDATION</div>
	<br>

	<div style="display: flex; justify-content: space-between;">
		<span style="float: left;">Category: <u><b>{{ $categoryName }}</b></u></span>
		@php
		    $start_date = request('start_date');
		    $end_date = request('end_date');
		    $formatted_from_date = date('M d', strtotime($start_date));
		    $formatted_to_date = date(' M d, Y', strtotime($end_date));
		@endphp
		<span style="float: right;">As of: <u>{{ $formatted_from_date }} - {{ $formatted_to_date }}</u></span>
	</div>
	<p style="margin-top: 10px"></p>
	<table id="prtemplate">
		<thead>
			<tr>
				<th class="cell-normal-side-left">STOCK NO.</th>
				<th class="cell-normal-side-inside">UNIT</th>
				<th class="cell-normal-side-inside">ITEM DESCRIPTION</th>
				<th class="cell-normal-side-inside">END USER</th>
				<th rowspan="" class="cell-normal-side-right">QTY</th>
			</tr>
		</thead>
		<tbody>
			@php $no = 1; @endphp
		    @foreach ($itemConsolidate as $relatedItem)
		        <tr>
		            <td>{{ $no++ }}</td>
		            <td>{{ $relatedItem->unit_name }}</td>
		            <td>{{ $relatedItem->item_name }} {{ $relatedItem->item_descrip }}</td>
		            <td>{{ $relatedItem->office_abbr }}</td>
		            <td>{{ $relatedItem->qty }}</td>
		        </tr>
		    @endforeach
			<tr>
				<th class="cell-bold-total-left" style="font-size: 8pt"><strong>PR Numbers:</th>
				<th colspan="4" class="cell-bold-total-right" style="text-align: left; font-size: 8pt;">
					@foreach($itemConsPRf2 as $itempr)
						{{ $itempr->pr_no}}, 
					@endforeach
				</th>
			</tr>
			<tr>
				<th class="cell-requested-designation-label">Printed By</th>
				<th colspan="2" class="cell-requested-designation">{{ Auth::user()->fname}} {{ Auth::user()->lname}}</th>
				<th colspan="2" class="cell-approved-designation">{{ $currentDate }}</th>
			</tr>
		</tbody>
	</table>
</body>
</html>