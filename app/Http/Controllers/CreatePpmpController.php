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
use App\Models\Uacs;
use App\Models\PapsPrePlan;
use App\Models\PapsPrePlanItem;
use App\Models\PapsPrePlanItemPPMP;

use App\Models\ProcurementPlan;
use App\Models\ProcurementPlanItem;

class CreatePpmpController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function ppmpYearRead()
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
        

        return view('createppmp.ppmp', compact('data', 'prppmpyear'));
    }

    public function ppmpstore(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'pryearid' => 'required',
                'pryearname' => 'required',
            ]);

            $userID = Auth::guard('web')->user()->id;
            $planYearID = $request->input('pryearid'); 
            $planYearName = $request->input('pryearname'); 
            $planYearCamp = Auth::guard('web')->user()->campus_id; 

            $existingPlan = ProcurementPlan::where('pryearid', $planYearID)
                ->where('pryearname', $planYearName)
                ->where('pruserid', $userID)
                ->where('prusercampus', $planYearCamp)
                ->first();

            if ($existingPlan) {
                return response()->json([
                    'error' => true,
                    'message' => 'PPMP ' . $planYearName .' already exists'
                ], 409);
            }

            try {
                $plan = ProcurementPlan::create([
                    'pryearid' => $planYearID,
                    'pryearname' => $planYearName,
                    'pruserid' => $userID,
                    'prusercampus' => $planYearCamp,
                ]);

                // ProcurementPlanItem::create([
                //     'plan_id' => $plan->id,
                //     'planyearname' => $planYearName,
                // ]);

                return response()->json([
                    'success' => true,
                    'message' => 'PPMP ' . $planYearName . ' created successfully'
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'message' => 'Failed to create PPMP',
                    'debug' => $e->getMessage() // optional for debugging
                ], 500);
            }
        }
    }

    public function getppmpYearRead() 
    {
        $data = ProcurementPlan::where('pruserid', Auth::guard('web')->user()->id)
                ->select('procurement_plan.*', 'procurement_plan.id as ppid')
                ->get();
        foreach ($data as $record) {
            $record->ppid = encrypt($record->ppid);
        }

        return response()->json(['data' => $data]);
    }

    public function viewlistppmp($ppid) 
    {
        $decryptedId = decrypt($ppid);

        $plan = ProcurementPlan::find($decryptedId);
        $planitem = ProcurementPlanItem::where('plan_id', $decryptedId)->get();

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

        return view('createppmp.ppmpviewlist', compact('plan', 'planitem', 'data'));
    }

    public function getviewlistppmp($ppid) 
    {
        $decryptedId = decrypt($ppid);

        $plan = ProcurementPlan::find($decryptedId);
        $planitem = ProcurementPlanItem::where('plan_id', $decryptedId)->get();

        return view('createppmp.ppmpviewlistcard', compact('plan', 'planitem'));
    }

    

// public function saveAll(Request $request)
//     {
//         $request->validate([
//             'plan_id' => 'required|exists:procurement_plans,id',
//             'code' => 'required|array',
//             'general_description' => 'nullable|array',
//             'quantity_size' => 'nullable|array',
//             'estimated_budget' => 'nullable|array',
//             'mode_of_procurement' => 'nullable|array',
//             'jan' => 'nullable|array',
//             'feb' => 'nullable|array',
//             'mar' => 'nullable|array',
//             'apr' => 'nullable|array',
//             'may' => 'nullable|array',
//             'jun' => 'nullable|array',
//             'jul' => 'nullable|array',
//             'aug' => 'nullable|array',
//             'sep' => 'nullable|array',
//             'oct' => 'nullable|array',
//             'nov' => 'nullable|array',
//             'dec' => 'nullable|array',
//             'item_id' => 'nullable|array', // hidden field for existing rows
//         ]);

//         $rowCount = count($request->code);

//         for ($i = 0; $i < $rowCount; $i++) {
//             $data = [
//                 'plan_id' => $request->plan_id,
//                 'code' => $request->code[$i] ?? null,
//                 'general_description' => $request->general_description[$i] ?? null,
//                 'quantity_size' => $request->quantity_size[$i] ?? null,
//                 'estimated_budget' => $request->estimated_budget[$i] ?? null,
//                 'mode_of_procurement' => $request->mode_of_procurement[$i] ?? null,
//                 'jan' => $request->jan[$i] ?? null,
//                 'feb' => $request->feb[$i] ?? null,
//                 'mar' => $request->mar[$i] ?? null,
//                 'apr' => $request->apr[$i] ?? null,
//                 'may' => $request->may[$i] ?? null,
//                 'jun' => $request->jun[$i] ?? null,
//                 'jul' => $request->jul[$i] ?? null,
//                 'aug' => $request->aug[$i] ?? null,
//                 'sep' => $request->sep[$i] ?? null,
//                 'oct' => $request->oct[$i] ?? null,
//                 'nov' => $request->nov[$i] ?? null,
//                 'dec' => $request->dec[$i] ?? null,
//             ];

//             // If item_id exists → update, else create new
//             if (!empty($request->item_id[$i])) {
//                 ProcurementPlanItem::where('id', $request->item_id[$i])->update($data);
//             } else {
//                 ProcurementPlanItem::create($data);
//             }
//         }

//         return redirect()->back()->with('success', 'Procurement plan items saved successfully.');
//     }

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
                    'plan_id'            => $request->plan_id,
                    'planyearname'       => $request->planyearname,
                    'code'               => $request->input("code.$i"),
                    'pap'                => $request->input("pap.$i"),
                    'general_description'=> $request->input("general_description.$i"),
                    'quantity_size'      => $request->input("quantity_size.$i"),
                    'estimated_budget'   => $request->input("estimated_budget.$i"),
                    'mode_of_procurement'=> $request->input("mode_of_procurement.$i"),
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
                    $item = ProcurementPlanItem::find($id);
                    if ($item) {
                        $item->update($data);
                    } 
                    // else {
                    //     // if id not found (e.g., deleted meanwhile), fallback to CREATE
                    //     ProcurementPlanItem::create($data);
                    // }
                } else {
                    // INSERT new
                     $exists = ProcurementPlanItem::where('plan_id', $request->plan_id)
                                ->where('code', $data['code'])
                                ->where('general_description', $data['general_description'])
                                ->exists();

                    if (!$exists) {
                        ProcurementPlanItem::create($data);
                    }
                }
            }
        });

        return response()->json(['success' => true, 'message' => 'Save Successfully!'],  200);
    }

    // public function ppmpfrompdfTemplate($ppid) 
    // {
    //     $decryptedId = decrypt($ppid);

    //     $plan = ProcurementPlan::find($decryptedId);
    //     $planitem = ProcurementPlanItem::where('plan_id', $decryptedId)->get();

    //     $data = [
    //         'plan_id' => $ppid,
    //         'planitem' => $planitem,
    //     ];

    //     $pdf = PDF::loadView('createppmp.ppmppdf', $data)->setPaper('A4', 'landscape');
    //     return $pdf->stream();
    // }

    public function ppmpfrompdfTemplate($ppid) 
    {
        $decryptedId = decrypt($ppid);

        $plan = PapsPrePlan::find($decryptedId);
        $planitem = PapsPrePlanItem::join('uacs', 'uacs.id', '=', 'paspre_plan_items.papstitle')
                ->leftJoin('papspre_plan_items_ppmp', 'paspre_plan_items.id', '=', 'papspre_plan_items_ppmp.papspreplanitemsid')
                ->select('paspre_plan_items.*', 'uacs.uacs_code', 'uacs.uacs_title', 'papspre_plan_items_ppmp.quantity_size', 'papspre_plan_items_ppmp.mode_of_procurement')
                ->where('paspre_plan_items.papspreplan_id', $decryptedId)
                ->where('paspre_plan_items.papsprocyn', 'Yes')  // only items with procurement needed
                ->get();

        $data = [
            'plan_id' => $ppid,
            'plan' => $plan,
            'planitem' => $planitem,
        ];

        $pdf = PDF::loadView('createppmp.ppmppdf', $data)->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
