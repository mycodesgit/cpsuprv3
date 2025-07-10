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

use App\Models\Campus;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\DocFile;
use App\Models\FundingSource;
use App\Models\PpmpVerify;
use App\Models\User;

class RequestReturnController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function returnedAllListRead() 
    {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['3'])
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $returnedCount = $this->getReturnedAllCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                    'returnedCount' => $returnedCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
                'returnedCount' => $returnedCount,
            ]);
        }

        return view("request.returned.return_list", compact('reqitempurpose', 'data'));
    }

    public function getreturnedAllListRead() 
    {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->whereIn('purpose.pstatus', ['3'])
            ->where('purpose.officeidreturn', Auth::guard('web')->user()->role)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function returnedUserListRead() 
    {
        $userId = Auth::id();

        $returnedCount = $this->getReturnedUserCount();
        
        $data = [   
                    'returnedCount' => $returnedCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'returnedCount' => $returnedCount,
            ]);
        }

        return view("request.returned.return_list", compact('data'));
    }

    public function getreturnedUserListRead() 
    {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 3)
            ->where('purpose.user_id', '=',  $userId)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function returnedpendingListView($pid) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $enID = decrypt($pid);
        $purpose = Purpose::find($pid);

        $docFile = DocFile::where('purpose_id', $enID)->first();

        $pendItem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('purpose', 'item_request.purpose_id', '=', 'purpose.id')
            ->join('ppmpverify', 'purpose.id', '=', 'ppmpverify.purpose_id')
            ->select('item_request.*', 'item_request.updated_at as itemrq_updated_at',
                    'category.*',
                    'ppmpverify.*',
                    'purpose.*', 'purpose.id as puid', 'purpose.created_at as purpose_created_at', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'item_request.item_cost as fitem_cost' )
            ->whereIn('item_request.status', ['2', '3', '4', '5', '6', '7', '8', '9'])
            ->where('item_request.purpose_id', '=',  $enID)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $returnedCount = $this->getReturnedUserCount();
        $data = [   
                    'returnedCount' => $returnedCount,
                ];

        return view ("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data', 'docFile'));
    }

    public function cancelUserListRead() 
    {
        $userId = Auth::id();

        return view("request.returned.canceled_list");
    }

    public function getcanceledUserListRead() 
    {
        $userId = Auth::id();
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.created_at as cpdate')
            ->where('purpose.pstatus', 19)
            ->where('purpose.user_id', '=',  $userId)
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function editreturnselectItems($pid) {
        $userId = Auth::id();
        $purposeid = decrypt($pid);
        
        $purpose = Purpose::find($purposeid);

        $items = Item::join('purpose', 'item.category_id', '=', 'purpose.cat_id')
                        ->join('category', 'item.category_id', '=', 'category.id')
                        ->join('unit', 'item.unit_id', '=', 'unit.id')
                        ->whereIn('item.category_id', [$purpose->cat_id])
                        ->groupBy('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id', 'item.item_cost', 'category.category_name')
                        ->select('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id as unit_id_alias', 'item.item_cost', 'category.category_name')
                        ->get();

        $selecteditem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->select('item_request.*', 
                    'category.category_name', 'item.*',
                    'unit.unit_name', 
                    'item_request.id as iid' )
            ->where('item_request.status', '=', '1')
            ->where('item_request.purpose_id', '=',  $purposeid)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $returnedCount = $this->getReturnedUserCount();
        $data = [   
                    'returnedCount' => $returnedCount,
                ];

        return view ("request.add.add_cart", compact('items', 'userId', 'data', 'purpose', 'selecteditem'));
    }
}
