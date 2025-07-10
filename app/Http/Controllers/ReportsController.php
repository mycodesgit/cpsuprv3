<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use PDF;

use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;

use App\Models\Campus;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\User;

class ReportsController extends Controller
{
    public function consolidateRead() 
    {
        $category = Category::all();
        return view('reports.listreport', compact('category'));
    }

    public function consolidateGen_reports(Request $request) 
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'unit.unit_name', 'item_request.category_id', DB::raw('SUM(item_request.total_cost) as total_cost'), DB::raw('SUM(item_request.qty) as qty'))
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('item.item_descrip','item_request.item_cost', 'unit.unit_name', 'item_request.category_id')
            ->get();

        return view('reports.listreportGen', compact('itemConsolidate'));
    }

    public function consolidatePDFGen_reports(Request $request) 
    {
        $currentDate = Date::now()->format('F j, Y');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');
        $categoryName = Category::where('id', $catId)->value('category_name');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'unit.unit_name', 'item_request.category_id', DB::raw('SUM(item_request.total_cost) as total_cost'), DB::raw('SUM(item_request.qty) as qty'))
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('item.item_descrip','item_request.item_cost', 'unit.unit_name', 'item_request.category_id')
            ->get();

        $itemConsPR = RequestItem::join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('purpose.pr_no', 'item_request.category_id')
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('purpose.pr_no', 'item_request.category_id', 'item_request.purpose_id' )
            ->get();

        $data = [
            'itemConsolidate' => $itemConsolidate,
            'categoryName' => $categoryName,
            'currentDate' => $currentDate,
            'itemConsPR' => $itemConsPR
        ];

        $pdf = PDF::loadView('reports.pdfform.listPDFreportGen',  $data)->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function consolidateForm2Read() 
    {
        $category = Category::all();
        return view('reports.listreportform2', compact('category'));
    }

    public function consolidateGenform2_reports(Request $request) 
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'item_request.qty', 'item_request.total_cost', 'unit.unit_name', 'item_request.category_id', 'office.office_abbr')
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->distinct() 
            ->get();

        return view('reports.listreportGenform2', compact('itemConsolidate'));
    }

    public function consolidatePDFGenform2_reports(Request $request) 
    {
        $currentDate = Date::now()->format('F j, Y');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');
        $categoryName = Category::where('id', $catId)->value('category_name');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'item_request.qty', 'item_request.total_cost', 'unit.unit_name', 'item_request.category_id', 'office.office_abbr')
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->get();

        $itemConsPRf2 = RequestItem::join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('purpose.pr_no', 'item_request.category_id')
            ->where('item_request.category_id', $catId)
            ->whereBetween('item_request.created_at', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('purpose.pr_no', 'item_request.category_id', 'item_request.purpose_id' )
            ->get();

        $data = [
            'itemConsolidate' => $itemConsolidate,
            'categoryName' => $categoryName,
            'currentDate' => $currentDate,
            'itemConsPRf2' => $itemConsPRf2
        ];

        $pdf = PDF::loadView('reports.pdfform.listPDFreportGenform2',  $data)->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
