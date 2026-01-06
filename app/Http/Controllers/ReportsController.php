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
use App\Traits\ReturnedCountTrait;

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
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function consolidateRead() 
    {
        $category = Category::all();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();

        $approvedUserCount = $this->getApprovedUserCount();
        $receivedUserCount = $this->getReceivedUserCount();
        $canvassingUserCount = $this->getCanvassingUserCount();
        $canvassedUserCount = $this->getCanvassedUserCount();
        $philgepUserCount = $this->getPhilGepUserCount();
        $postedUserCount = $this->getPostedUserCount();
        $biddingUserCount = $this->getBiddingUserCount();
        $consolidateUserCount = $this->getConsolidateUserCount();
        $awardedUserCount = $this->getAwardedUserCount();
        $purchaseUserCount = $this->getPurchaseUserCount();

        $returnedAllCount = $this->getReturnedAllCount();
        $returnedUserCount = $this->getReturnedUserCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,

                    'approvedUserCount' => $approvedUserCount,
                    'receivedUserCount' => $receivedUserCount,
                    'canvassingUserCount' => $canvassingUserCount,
                    'canvassedUserCount' => $canvassedUserCount,
                    'philgepUserCount' => $philgepUserCount,
                    'postedUserCount' => $postedUserCount,
                    'biddingUserCount' => $biddingUserCount,
                    'consolidateUserCount' => $consolidateUserCount,
                    'awardedUserCount' => $awardedUserCount,
                    'purchaseUserCount' => $purchaseUserCount,

                    'returnedAllCount' => $returnedAllCount,
                    'returnedUserCount' => $returnedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,

                'approvedUserCount' => $approvedUserCount,
                'receivedUserCount' => $receivedUserCount,
                'canvassingUserCount' => $canvassingUserCount,
                'canvassedUserCount' => $canvassedUserCount,
                'philgepUserCount' => $philgepUserCount,
                'postedUserCount' => $postedUserCount,
                'biddingUserCount' => $biddingUserCount,
                'consolidateUserCount' => $consolidateUserCount,
                'awardedUserCount' => $awardedUserCount,
                'purchaseUserCount' => $purchaseUserCount,

                'returnedAllCount' => $returnedAllCount,
                'returnedUserCount' => $returnedUserCount,
            ]);
        }

        return view('reports.listreport', compact('category', 'data'));
    }

    public function consolidateGen_reports(Request $request) 
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'unit.unit_name', 'item_request.category_id', DB::raw('SUM(item_request.total_cost) as total_cost'), DB::raw('SUM(item_request.qty) as qty'))
            ->where('item_request.category_id', $catId)
            ->whereBetween('purpose.dateconsolidate', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('item.item_descrip','item_request.item_cost', 'unit.unit_name', 'item_request.category_id')
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();

        $approvedUserCount = $this->getApprovedUserCount();
        $receivedUserCount = $this->getReceivedUserCount();
        $canvassingUserCount = $this->getCanvassingUserCount();
        $canvassedUserCount = $this->getCanvassedUserCount();
        $philgepUserCount = $this->getPhilGepUserCount();
        $postedUserCount = $this->getPostedUserCount();
        $biddingUserCount = $this->getBiddingUserCount();
        $consolidateUserCount = $this->getConsolidateUserCount();
        $awardedUserCount = $this->getAwardedUserCount();
        $purchaseUserCount = $this->getPurchaseUserCount();

        $returnedAllCount = $this->getReturnedAllCount();
        $returnedUserCount = $this->getReturnedUserCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,

                    'approvedUserCount' => $approvedUserCount,
                    'receivedUserCount' => $receivedUserCount,
                    'canvassingUserCount' => $canvassingUserCount,
                    'canvassedUserCount' => $canvassedUserCount,
                    'philgepUserCount' => $philgepUserCount,
                    'postedUserCount' => $postedUserCount,
                    'biddingUserCount' => $biddingUserCount,
                    'consolidateUserCount' => $consolidateUserCount,
                    'awardedUserCount' => $awardedUserCount,
                    'purchaseUserCount' => $purchaseUserCount,

                    'returnedAllCount' => $returnedAllCount,
                    'returnedUserCount' => $returnedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,

                'approvedUserCount' => $approvedUserCount,
                'receivedUserCount' => $receivedUserCount,
                'canvassingUserCount' => $canvassingUserCount,
                'canvassedUserCount' => $canvassedUserCount,
                'philgepUserCount' => $philgepUserCount,
                'postedUserCount' => $postedUserCount,
                'biddingUserCount' => $biddingUserCount,
                'consolidateUserCount' => $consolidateUserCount,
                'awardedUserCount' => $awardedUserCount,
                'purchaseUserCount' => $purchaseUserCount,

                'returnedAllCount' => $returnedAllCount,
                'returnedUserCount' => $returnedUserCount,
            ]);
        }

        return view('reports.listreportGen', compact('itemConsolidate', 'data'));
    }

    public function consolidatePDFGen_reports(Request $request) 
    {
        $currentDate = Date::now()->format('F j, Y');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $catId = $request->input('cat_id');
        $categoryName = Category::where('id', $catId)->value('category_name');

        $itemConsolidate = RequestItem::join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->select('item.item_descrip', 'item_request.item_cost', 'unit.unit_name', 'item_request.category_id', DB::raw('SUM(item_request.total_cost) as total_cost'), DB::raw('SUM(item_request.qty) as qty'))
            ->where('item_request.category_id', $catId)
            ->whereBetween('purpose.dateconsolidate', [$start_date, $end_date])
            ->whereIn('item_request.status', ['14'])
            ->groupBy('item.item_descrip','item_request.item_cost', 'unit.unit_name', 'item_request.category_id')
            ->get();

        $itemConsPR = RequestItem::join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('purpose.pr_no', 'item_request.category_id')
            ->where('item_request.category_id', $catId)
            ->whereBetween('purpose.dateconsolidate', [$start_date, $end_date])
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

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();

        $approvedUserCount = $this->getApprovedUserCount();
        $receivedUserCount = $this->getReceivedUserCount();
        $canvassingUserCount = $this->getCanvassingUserCount();
        $canvassedUserCount = $this->getCanvassedUserCount();
        $philgepUserCount = $this->getPhilGepUserCount();
        $postedUserCount = $this->getPostedUserCount();
        $biddingUserCount = $this->getBiddingUserCount();
        $consolidateUserCount = $this->getConsolidateUserCount();
        $awardedUserCount = $this->getAwardedUserCount();
        $purchaseUserCount = $this->getPurchaseUserCount();

        $returnedAllCount = $this->getReturnedAllCount();
        $returnedUserCount = $this->getReturnedUserCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,

                    'approvedUserCount' => $approvedUserCount,
                    'receivedUserCount' => $receivedUserCount,
                    'canvassingUserCount' => $canvassingUserCount,
                    'canvassedUserCount' => $canvassedUserCount,
                    'philgepUserCount' => $philgepUserCount,
                    'postedUserCount' => $postedUserCount,
                    'biddingUserCount' => $biddingUserCount,
                    'consolidateUserCount' => $consolidateUserCount,
                    'awardedUserCount' => $awardedUserCount,
                    'purchaseUserCount' => $purchaseUserCount,

                    'returnedAllCount' => $returnedAllCount,
                    'returnedUserCount' => $returnedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,

                'approvedUserCount' => $approvedUserCount,
                'receivedUserCount' => $receivedUserCount,
                'canvassingUserCount' => $canvassingUserCount,
                'canvassedUserCount' => $canvassedUserCount,
                'philgepUserCount' => $philgepUserCount,
                'postedUserCount' => $postedUserCount,
                'biddingUserCount' => $biddingUserCount,
                'consolidateUserCount' => $consolidateUserCount,
                'awardedUserCount' => $awardedUserCount,
                'purchaseUserCount' => $purchaseUserCount,

                'returnedAllCount' => $returnedAllCount,
                'returnedUserCount' => $returnedUserCount,
            ]);
        }

        return view('reports.listreportform2', compact('category', 'data'));
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

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();

        $approvedUserCount = $this->getApprovedUserCount();
        $receivedUserCount = $this->getReceivedUserCount();
        $canvassingUserCount = $this->getCanvassingUserCount();
        $canvassedUserCount = $this->getCanvassedUserCount();
        $philgepUserCount = $this->getPhilGepUserCount();
        $postedUserCount = $this->getPostedUserCount();
        $biddingUserCount = $this->getBiddingUserCount();
        $consolidateUserCount = $this->getConsolidateUserCount();
        $awardedUserCount = $this->getAwardedUserCount();
        $purchaseUserCount = $this->getPurchaseUserCount();

        $returnedAllCount = $this->getReturnedAllCount();
        $returnedUserCount = $this->getReturnedUserCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,

                    'approvedUserCount' => $approvedUserCount,
                    'receivedUserCount' => $receivedUserCount,
                    'canvassingUserCount' => $canvassingUserCount,
                    'canvassedUserCount' => $canvassedUserCount,
                    'philgepUserCount' => $philgepUserCount,
                    'postedUserCount' => $postedUserCount,
                    'biddingUserCount' => $biddingUserCount,
                    'consolidateUserCount' => $consolidateUserCount,
                    'awardedUserCount' => $awardedUserCount,
                    'purchaseUserCount' => $purchaseUserCount,

                    'returnedAllCount' => $returnedAllCount,
                    'returnedUserCount' => $returnedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,

                'approvedUserCount' => $approvedUserCount,
                'receivedUserCount' => $receivedUserCount,
                'canvassingUserCount' => $canvassingUserCount,
                'canvassedUserCount' => $canvassedUserCount,
                'philgepUserCount' => $philgepUserCount,
                'postedUserCount' => $postedUserCount,
                'biddingUserCount' => $biddingUserCount,
                'consolidateUserCount' => $consolidateUserCount,
                'awardedUserCount' => $awardedUserCount,
                'purchaseUserCount' => $purchaseUserCount,

                'returnedAllCount' => $returnedAllCount,
                'returnedUserCount' => $returnedUserCount,
            ]);
        }

        return view('reports.listreportGenform2', compact('itemConsolidate', 'data'));
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
