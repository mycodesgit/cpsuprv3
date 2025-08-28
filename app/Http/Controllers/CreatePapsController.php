<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
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
use App\Models\FundingSource;
use App\Models\User;
use App\Models\PpmpUser;
use App\Models\YearPR;
use App\Models\PapsPrePlan;
use App\Models\PapsPrePlanItem;
use App\Models\ProcurementPlan;
use App\Models\ProcurementPlanItem;

class CreatePapsController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;
    
    public function papsYearRead()
    {
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

        $prppmpyear = YearPR::all();
        

        return view('createpaps.papspre', compact('data', 'prppmpyear'));
    }

    public function papsstore(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'papsyearid' => 'required',
                'papsyearname' => 'required',
            ]);

            $userID = Auth::guard('web')->user()->id;
            $planYearID = $request->input('papsyearid'); 
            $planYearName = $request->input('papsyearname'); 
            $planYearCamp = Auth::guard('web')->user()->campus_id; 
            $planFundSource = $request->input('papsuserfundsource'); 

            $existingPlan = PapsPrePlan::where('papsyearid', $planYearID)
                ->where('papsyearname', $planYearName)
                ->where('papsuserid', $userID)
                ->where('papsusercampus', $planYearCamp)
                ->where('papsuserfundsource', $planFundSource)
                ->first();

            if ($existingPlan) {
                return response()->json([
                    'error' => true,
                    'message' => 'PAPs PRE ' . $planYearName .' already exists'
                ], 409);
            }

            try {
                $plan = PapsPrePlan::create([
                    'papsyearid' => $planYearID,
                    'papsyearname' => $planYearName,
                    'papsuserid' => $userID,
                    'papsusercampus' => $planYearCamp,
                    'papsuserfundsource' => $planFundSource,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'PAPs PRE ' . $planYearName . ' created successfully'
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to create PAPs PRE',
                    'debug' => $e->getMessage() // optional for debugging
                ], 500);
            }
        }
    }

    public function getpapsYearRead() 
    {
        $data = PapsPrePlan::where('papsuserid', Auth::guard('web')->user()->id)
                ->select('papspre_plan.*', 'papspre_plan.id as ppid')
                ->get();
        foreach ($data as $record) {
            $record->ppid = encrypt($record->ppid);
        }

        return response()->json(['data' => $data]);
    }

    public function viewlistpapspre($ppid) 
    {
        $decryptedId = decrypt($ppid);

        $plan = PapsPrePlan::find($decryptedId);
        $planitem = PapsPrePlanItem::where('papspreplan_id', $decryptedId)->get();

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

        return view('createpaps.papspreviewlist', compact('plan', 'planitem', 'data'));
    }

    public function saveAll(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',

            // arrays per column
            'item_id'             => 'nullable|array',
            'code'                => 'nullable|array',
            'general_description' => 'nullable|array',
            'quantity_size'       => 'nullable|array',
            'estimated_budget'    => 'nullable|array',
            'mode_of_procurement' => 'nullable|array',
            'planyearname'        => 'required',
            'pap'                 => 'nullable|array',
            'jan' => 'nullable|array','feb' => 'nullable|array','mar' => 'nullable|array',
            'apr' => 'nullable|array','may' => 'nullable|array','jun' => 'nullable|array',
            'jul' => 'nullable|array','aug' => 'nullable|array','sep' => 'nullable|array',
            'oct' => 'nullable|array','nov' => 'nullable|array','dec' => 'nullable|array',
        ]);

        $rowCount = max(
            count($request->input('code', [])),
            count($request->input('item_id', [])),
            count($request->input('general_description', []))
        );

        DB::transaction(function () use ($request, $rowCount) {
            for ($i = 0; $i < $rowCount; $i++) {
                $id   = $request->input("item_id.$i"); 

                $data = [
                    'papspreplan_id'        => $request->papspreplan_id,
                    'papspreplanyearname'   => $request->papspreplanyearname,
                    'ppa_cat'               => $request->input("ppa_cat.$i"),
                    'ppa'                   => $request->input("ppa.$i"),
                    'papsprecode'           => $request->input("papsprecode.$i"),
                    'papstitle'             => $request->input("papstitle.$i"),
                    'papsamount'            => $request->input("papsamount.$i"),
                    'papsprocyn'            => $request->input("papsprocyn.$i"),
                    'papsresperson'         => $request->input("papsresperson.$i"),
                    'papsevidences'         => $request->input("papsevidences.$i"),
                    'jan' => $request->input("jan.$i"),
                    'feb' => $request->input("feb.$i"),
                    'mar' => $request->input("mar.$i"),
                    'apr' => $request->input("apr.$i"),
                    'may' => $request->input("may.$i"),
                    'jun' => $request->input("jun.$i"),
                    'jul' => $request->input("jul.$i"),
                    'aug' => $request->input("aug.$i"),
                    'sep' => $request->input("sep.$i"),
                    'oct' => $request->input("oct.$i"),
                    'nov' => $request->input("nov.$i"),
                    'dec' => $request->input("dec.$i"),
                ];

                // Skip totally blank rows (avoid inserting empty records)
                $isBlank = collect($data)
                    ->except(['plan_id']) // plan_id is always present
                    ->filter(function ($v) { return $v !== null && $v !== ''; })
                    ->isEmpty();

                if ($isBlank) {
                    continue;
                }

                if ($id) {
                    // UPDATE existing
                    $item = PapsPrePlanItem::find($id);
                    if ($item) {
                        $item->update($data);
                    } 
                    // else {
                    //     // if id not found (e.g., deleted meanwhile), fallback to CREATE
                    //     PapsPrePlanItem::create($data);
                    // }
                } else {
                    // INSERT new
                     $exists = PapsPrePlanItem::where('plan_id', $request->plan_id)
                                ->where('code', $data['code'])
                                ->where('general_description', $data['general_description'])
                                ->exists();

                    if (!$exists) {
                        PapsPrePlanItem::create($data);
                    }
                }
            }
        });

        return response()->json(['success' => true, 'message' => 'Save Successfully!'],  200);
    }
}
