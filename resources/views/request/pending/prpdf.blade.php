<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

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
		  	/*padding: 8px;*/
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
			text-align: right;
			font-style: italic;
		}
		.title-form {
			text-align: center;
			font-size: 12pt;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="appendix-no"><b>Appendix 60</b></div>
	<br><br><br><br>

	<div class="title-form">PURCHASE REQUEST</div>
	<br>

	<div>
		Entity Name: <u><b>CENTRAL PHILIPPINES STATE UNIVERSITY</b></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Fund Cluster: _____________
	</div>
	<p style="margin-top:-13px"></p>
	<table id="prtemplate">
		<thead>
			<tr>
				<th style="text-align: center; font-weight: initial;" width="25" class="cell-normal-top-left">Office/<br>Section</th>
				<th colspan="2" class="cell-normal-top">
					@if (!$reqitem->isEmpty())
						{{ $reqitem[0]->office_name }}
					@endif
				</th>
				<th colspan="2" style="text-align: left; font-weight: initial;" class="cell-normal-top">PR  No.:<br>Code:</th>
				<th style="text-align: left; font-weight: initial;" width="100" class="cell-normal-top-right">Date: {{ \Carbon\Carbon::parse($reqitem->first()->cpdate)->format('M j, Y') }}</th>
			</tr>
			<tr>
				<th class="cell-normal-side-left">STOCK NO.</th>
				<th class="cell-normal-side-inside">UNIT</th>
				<th class="cell-normal-side-inside">ITEM DESCRIPTION</th>
				<th class="cell-normal-side-inside">QTY.</th>
				<th class="cell-normal-side-inside">UNIT COST</th>
				<th class="cell-normal-side-right">TOTAL COST</th>
			</tr>
		</thead>
		<tbody>
			@php
				$no = 1;
		        $maxRows = 20;
		        $rowCount = 0;
		        $overallTotal = 0;
		        $grandTotal = 0;
		    @endphp

		    @foreach ($reqitem as $relatedItem)
		        <tr>
		            <td>{{ $no++ }}</td>
		            <td>{{ $relatedItem->unit_name }}</td>
		            <td>{{ $relatedItem->item_name }} {{ $relatedItem->item_descrip }}</td>
		            <td>{{ $relatedItem->qty }}</td>
		            <td>{{ $relatedItem->fitem_cost }}</td>
		            <td align="right"><b>{{ $relatedItem->total_cost }}</b></td>

		            @if (is_numeric(str_replace(',', '', $relatedItem->fitem_cost)))
		                @php 
			                $itemTotal = $relatedItem->qty * str_replace(',', '', $relatedItem->fitem_cost);
			                $overallTotal += $itemTotal;
			                $grandTotal += $itemTotal; // Add to grand total
			            @endphp
		            @endif
		        </tr>

		        @if (is_numeric(str_replace(',', '', $relatedItem->fitem_cost)))
		            @php $rowCount++; @endphp
		        @endif
		    @endforeach

		    @php
                $emptyRows = $maxRows - $rowCount;
            @endphp

            @for ($i = 0; $i < $emptyRows; $i++)
                <tr>
                    <td height="13"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
			<tr>
				<th colspan="5" class="cell-bold-total-left" style="text-align: left;"><b>Total</b></th>
				<th class="cell-bold-total-right"><strong>{{ number_format($grandTotal, 2) }}</th>
			</tr>
			<tr>
				<th colspan="6" class="cell-bold-purpose">
					Purpose: 
					@if (!$reqitem->isEmpty())
						{{ $reqitem[0]->purpose_name }}
					@endif
				</th>
			</tr>
			<tr>
				<th class="cell-requested-empty"></th>
				<th colspan="2" class="cell-requested"><b>Requested by:</b></th>
				<th colspan="3" class="cell-approved"><b>Approved by:</b></th>
			</tr>
			<tr>
				<th class="cell-requested-signature-label">Signature</th>
				<th colspan="2" class="cell-requested-signature"></th>
				<th colspan="3" class="cell-approved-signature"></th>
			</tr>
			<tr>
				<th class="cell-requested-name-label">Printed Name</th>
				<th colspan="2" class="cell-requested-name">@if (!$reqitem->isEmpty()){{ $reqitem[0]->fname }} {{ $reqitem[0]->lname }}@endif</th>
				<th colspan="3" class="cell-approved-name"><b>ALADINO C. MORACA, Ph. D.</b></th>
			</tr>
			<tr>
				<th class="cell-requested-designation-label">Designation</th>
				<th colspan="2" class="cell-requested-designation"><b></b></th>
				<th colspan="3" class="cell-approved-designation"><b>SUC President II</b></th>
			</tr>
		</tbody>
	</table>
</body>
</html>