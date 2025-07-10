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

use App\Models\FundingSource;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\User;

class RequestController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;

    public function prPurposeRequest() {
        $userId = Auth::id();
        $repurpose = Purpose::select('purpose.*')
            ->where('purpose.pstatus', '=', '1')
            ->where('purpose.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.add.purpose", compact('repurpose', 'data'));
    }

    public function prPurposeRequestCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required',
                'camp_id' => 'required',
                'office_id' => 'required',
                'transaction_no' => 'required',
                'purpose_name' => 'required',
            ]); 

            $currentYear = now()->year;
            $lastReceipt = Purpose::whereYear('created_at', $currentYear)->latest()->first();
            $counter = $lastReceipt ? (int)substr($lastReceipt->receipt_control, -5) + 1 : 1;
            $formattedCounter = str_pad($counter, 5, '0', STR_PAD_LEFT);
            $receiptControl = $currentYear . '-' . $formattedCounter;
    
            try {
                $purpose = Purpose::create([
                    'user_id' => $request->input('user_id'),
                    'camp_id' => $request->input('camp_id'),
                    'office_id' => $request->input('office_id'),
                    'transaction_no' => $request->input('transaction_no'),
                    'receipt_control' => $receiptControl,
                    'type_request' => '1',
                    'other_specify' => $request->input('other_specify'),
                    'purpose_name' => $request->input('purpose_name'),
                    'remember_token' => Str::random(60),
                ]);
                FundingSource::create([
                    'user_id' => $request->input('user_id'),
                    'camp_id' => $request->input('camp_id'),
                    'office_id' => $request->input('office_id'),
                    'purpose_id' => $purpose->id,
                    'remember_token' => Str::random(60),
                ]);
    
                return redirect()->route('prPurposeRequest')->with('success', 'Purpose added successfully!');
            } catch (\Exception $e) {
                return redirect()->route('prPurposeRequest')->with('error', 'Failed to add Purpose!');
            }
        }
    }

    public function prCreateRequest($purpose_Id) {
        $userId = Auth::id();
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::all();

        $purpose_id = decrypt($purpose_Id);
        $purpose = Purpose::find($purpose_id);

        $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->select('item_request.*', 
                    'category.category_name', 
                    'unit.unit_name', 'item.*', 
                    'item_request.id as iid' )
            ->where('item_request.status', '=', '1')
            ->where('item_request.purpose_id', '=',  $purpose_id)
            ->where('item_request.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        return view ("request.add.add_newpr", compact('category', 'unit', 'item', 'reqitem', 'purpose', 'data'));
    }

    public function prCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'required',
                'unit_id' => 'required',
                'item_id' => 'required',
                'item_cost' => 'required',
                'qty' => 'required',
                'total_cost' => 'required',
                'purpose_id' => 'required',
            ]);

            try {
                RequestItem::create([
                    'transaction_no' => $request->input('transaction_no'),
                    'category_id' => $request->input('category_id'),
                    'unit_id' => $request->input('unit_id'),
                    'item_id' => $request->input('item_id'),
                    'item_cost' => $request->input('item_cost'),
                    'qty' => $request->input('qty'),
                    'total_cost' => $request->input('total_cost'),
                    'purpose_id' => $request->input('purpose_id'),
                    'user_id' => $request->input('user_id'),
                    'off_id' => $request->input('off_id'),
                    'campid' => $request->input('campid'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->back()->with('success', 'Item add successfully!');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to add Item!');
            }
        }
    }

    public function getItemsByCategory($id) {
        if ($id) {
            $items = Item::where('category_id', $id)
                ->select('item_name', 'item_descrip', 'item_cost', 'id')
                ->get();

            $options = "";
            foreach ($items as $item) {
                $options .= "<option value='".$item->id."'  data-item-id='".$item->id."' data-item-cost='".$item->item_cost."'>".$item->item_name. ' ' .$item->item_descrip."</option>";
            }
        } else {
            $options = "<option value=''>Select a category first</option>";
        }

        return response()->json([
            "options" => $options,
        ]);
    }

    public function savePR(Request $request) {
        $userId = Auth::id();
        $purpose_id = decrypt($request->input('purpose_id'));
        $purpose = Purpose::find($purpose_id);

        RequestItem::where('status', 1)
            ->where('user_id', $userId)
            ->where('purpose_id', $purpose_id)
            ->update(['status' => 2]);

        $updatedRequestItems = RequestItem::where('status', 2)
            ->where('user_id', $userId)
            ->where('purpose_id', $purpose_id)
            ->distinct('purpose_id')
            ->get(['purpose_id']);

        Purpose::whereIn('id', $updatedRequestItems->pluck('purpose_id'))
            ->update(['pstatus' => '2']); 

        return back()->with('success', 'Save Successfully');
    }

    public function itemreqDelete($id) {
        $reqitem = RequestItem::find($id);
        $reqitem1 = RequestItem::all();
        $amount = str_replace(',', '', $reqitem->total_cost);

        $totalamount = 0;

        foreach ($reqitem1 as $req) {
            $reqamount = str_replace(',', '', $req->total_cost);
            $totalamount += $reqamount;
        }


        $reqitem->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
            'totalamount' => number_format($totalamount - $amount, 2),
        ]);
    }

}
