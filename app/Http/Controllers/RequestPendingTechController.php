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
use App\Models\PRnotification;

class RequestPendingTechController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;
    
    public function pendingTechCheckListRead()
    {
        $userId = Auth::id();
        $reqitempurpose = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['99'])
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $pendTechCount = $this->getPendingTechAllCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                    'pendTechCount' => $pendTechCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,
                'pendTechCount' => $pendTechCount,
            ]);
        }

        return view('request.pending.pendingListTechChecker');
    }

    public function getpendingTechAllListRead() {
        $data = Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('campuses', 'purpose.camp_id', '=', 'campuses.id')
            ->join('category', 'purpose.cat_id', '=', 'category.id')
            ->select('purpose.*', 'purpose.id as pid', 'campuses.*', 'campuses.id as campid', 'category.*', 'office.*', 'office.id as oid', 'purpose.updated_at as cpdate')
            ->where('purpose.pstatus', '=', '99')
            ->orderBy('purpose.created_at', 'DESC')
            ->get();
        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function pendingAllListTechView($pid) 
    {
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
            ->select('item_request.*', 
                    'category.*',
                    'ppmpverify.*',
                    'ppmpverify.ppmp_remarks',
                    'purpose.*', 'purpose.id as puid', 'purpose.created_at as purpose_created_at', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid',
                    'item_request.item_cost as fitem_cost' )
            ->where('item_request.status', '=', '99')
            ->where('item_request.purpose_id', '=',  $enID)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,
                ];

        return view("request.pending.viewlist", compact('category', 'unit', 'item', 'pendItem', 'purpose', 'data', 'docFile'));
    }
}
