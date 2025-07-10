<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;
use App\Traits\ReturnedCountTrait;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\DocFile;
use App\Models\FundingSource;
use App\Models\User;
use App\Models\Campus;
use App\Models\PRnotification;

class RequestApprovedController extends Controller
{
    use ApprovedCountTrait;
    
    public function approvedListRead() {
        $userId = Auth::id();
        

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
        // $returnedCount = $this->getReturnedUserCount();
        $data = [   
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
                    // 'returnedCount' => $returnedCount,
                ];

        if (request()->ajax()) {
            return response()->json([
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
                // 'returnedCount' => $returnedCount,
            ]);
        }

        return view ("request.approved.approvedUserList", compact('data'));
    }

    public function approvedListAllRead() {
        $userId = Auth::id();
        // $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
        //     ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
        //     ->whereIn('purpose.pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
        //     ->orderBy('purpose.created_at', 'DESC')
        //     ->get();

        $approvedCount = $this->getApprovedAllCount();
        $receivedCount = $this->getReceivedAllCount();
        $canvassingCount = $this->getCanvassingAllCount();
        $canvassedCount = $this->getCanvassedAllCount();
        $philgepCount = $this->getPhilGepAllCount();
        $postedCount = $this->getPostedAllCount();
        $biddingCount = $this->getBiddingAllCount();
        $consolidateCount = $this->getConsolidateAllCount();
        $awardedCount = $this->getAwardedAllCount();
        $purchaseCount = $this->getPurchaseAllCount();
        $data = [   
                    'approvedCount' => $approvedCount,
                    'receivedCount' => $receivedCount, 
                    'canvassingCount' => $canvassingCount,
                    'canvassedCount' => $canvassedCount,
                    'philgepCount' => $philgepCount,
                    'postedCount' => $postedCount,
                    'biddingCount' => $biddingCount,
                    'consolidateCount' => $consolidateCount,
                    'awardedCount' => $awardedCount,
                    'purchaseCount' => $purchaseCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'approvedCount' => $approvedCount, 
                'receivedCount' => $receivedCount,
                'canvassingCount' => $canvassingCount,
                'canvassedCount' => $canvassedCount,
                'philgepCount' => $philgepCount,
                'postedCount' => $postedCount,
                'biddingCount' => $biddingCount,
                'consolidateCount' => $consolidateCount,
                'awardedCount' => $awardedCount,
                'purchaseCount' => $purchaseCount,
            ]);
        }

        return view ("request.approved.approvedAllList", compact('data'));
    }

    public function getapprovedListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            // ->whereIn('purpose.pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('purpose.pstatus', 7)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getreceivedListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 8)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getcanvassingListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 9)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getcanvassedListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 10)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getphilgepListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 11)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getpostedListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 12)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getbiddingListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 13)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getconsolidateListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 14)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getawardedListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 15)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getpurchaseListRead() {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 16)
            ->where('purpose.user_id', '=',  $userId)
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllapprovedListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            // ->whereIn('purpose.pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('purpose.pstatus', 7)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllreceivedListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 8)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllcanvassingListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 9)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllcanvassedListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 10)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllphilgepListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 11)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllpostingListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 12)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllfuckyouListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 13)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllmadapakconsolListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 14)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllawardListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 15)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function getAllpurchaseListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 16)
            ->whereYear('purpose.updated_at', '=', now()->year)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function approvedListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $docFile = DocFile::where('purpose_id', $enID)->first();

        $appItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->select('item_request.*', 
                    'category.*',
                    'purpose.*', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        //$approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   
                    //'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.approved.viewlist", compact('category', 'unit', 'item', 'appItem', 'purpose', 'data', 'docFile'));
    }

    public function approvedAllListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $docFile = DocFile::where('purpose_id', $enID)->first();

        $appItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->leftJoin('funding_source', 'purpose.id', '=', 'funding_source.purpose_id')
            ->select('item_request.*', 
                    'category.*',
                    'purpose.*', 
                    'unit.unit_name', 'item.*', 
                    'funding_source.fund_cluster',
                    'item_request.id as iid' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.approved.viewlist", compact('category', 'unit', 'item', 'appItem', 'purpose', 'data', 'docFile'));
    }

    public function PDFprApproved($pid) {
        $userId = Auth::guard('web')->user()->id;
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($enID);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->join('funding_source', 'item_request.purpose_id', '=', 'funding_source.purpose_id')
            ->select('item_request.*', 
                    'purpose.*',
                    'office.*', 
                    'users.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'item_request.item_cost',
                    'office.id as oid',
                    'funding_source.fund_cluster',
                    'funding_source.updated_at as appdatepr' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $data = [
            'purpose_id' => $enID,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.approved.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFprAllApproved($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->leftJoin('funding_source', 'purpose.id', '=', 'funding_source.purpose_id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'office.*', 
                    'users.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'item_request.item_cost',
                    'funding_source.fund_cluster',
                    'office.id as oid',
                    'funding_source.updated_at as appdatepr' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.approved.prpdf',  $data)->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFrbarasApproved($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('funding_source', 'item_request.purpose_id', '=', 'funding_source.purpose_id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->join('campuses', 'item_request.campid', '=', 'campuses.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'office.*',
                    'campuses.*', 
                    'users.*', 
                    'funding_source.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'funding_source.id as fid',
                    'office.id as oid',
                    'campuses.id as cid',
                    'funding_source.updated_at as appdatepr' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
            'purpose' => $purpose,
        ];

        $pdf = PDF::loadView('request.approved.rbarcspdf',  $data)->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function PDFrbarasAllApproved($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('funding_source', 'item_request.purpose_id', '=', 'funding_source.purpose_id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('users', 'item_request.user_id', '=', 'users.id')
            ->join('campuses', 'item_request.campid', '=', 'campuses.id')
            ->select('item_request.*', 
                    'purpose.*',
                    'office.*', 
                    'campuses.*',
                    'users.*', 
                    'funding_source.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'office.id as oid',
                    'funding_source.id as fid',
                    'campuses.id as cid',
                    'funding_source.updated_at as appdatepr' )
            ->whereIn('item_request.status', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $data = [
            'purpose_id' => $pid,
            'reqitem' => $reqitem,
        ];

        $pdf = PDF::loadView('request.approved.rbarcspdf',  $data)->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function receivedPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 8]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  8]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been received by procurement office. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 8,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function canvassingPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 9]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  9]);
        
        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR is now under the canvassing process. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 9,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function canvassedPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 10]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  10]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been successfully canvassed. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 10,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function philgepspostingPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 11]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  11]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been successfully posted on PhilGEPS. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 11,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function postedPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 12]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  12]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been successfully posted. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 12,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function biddingPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 13]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  13]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR is now under the bidding process. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 13,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function consolidationPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 14]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  14]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR is now under the consolidation process. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 14,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function awardedPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 15]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  15]);
        
        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been successfully awarded. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 15,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function purchasedPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 16]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  16]);
        
        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been successfully purchased. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 16,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function rerturnedPR(Request $request) {
        $id = decrypt($request->id);
        RequestItem::where('purpose_id', $id)
            ->update(['status' => 17]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  17]);

        return response()->json(['success' => true]);
    }

    public function forwardedPedoPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 18]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  18]);

        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been forwarded to PEDO. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 18,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function cancelreqheadPR(Request $request) {
        $id = decrypt($request->id);

        $purpose = Purpose::find($id);

        $user_id = $purpose->user_id;
        $prnumber = $purpose->pr_no;

        RequestItem::where('purpose_id', $id)
            ->update(['status' => 19]);

        Purpose::where('id', $id)
            ->update(['pstatus' =>  19]);
        
        PRnotification::create([
            'purp_id' => $id,
            'user_id' => $user_id,
            'message' => 'Your PR has been canceled. </br>PR No.: <b>' . $prnumber . '</b>',
            'notifstatus' => 19,
            'is_read' => '0',
        ]);

        return response()->json(['success' => true]);
    }

    public function getUserRole()
    {
        $role = Auth::user()->role;
        return response()->json(['role' => $role]);
    }
}
