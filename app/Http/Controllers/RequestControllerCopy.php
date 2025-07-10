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
use App\Models\PpmpVerify;
use App\Models\PpmpUser;
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

    public function shop(){
        $userCategoryIds = PpmpUser::where('user_id', Auth::user()->id)
                             ->pluck('ppmp_categories')
                             ->flatMap(function ($item) {
                                 return json_decode($item);
                             })
                             ->unique()
                             ->values()
                             ->all();
        $category = Category::whereIn('id', $userCategoryIds)->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];
        
        return view ("request.add.shop", compact('data', 'category'));
    }

    public function getCategories()
    {
        $categories = Category::all(); 

        return response()->json(['categories' => $categories]);
    }


    public function prPurposeRequest() {
        $userId = Auth::id();
        $category = Category::all();
        $repurpose = Purpose::join('category', 'purpose.cat_id',  'category.id')
            ->select('purpose.*', 'category.*', 'purpose.id as purpose_Id')
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

        return view ("request.add.purpose", compact('repurpose', 'data', 'category'));
    }

    public function prPurposeRequestCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required',
                'camp_id' => 'required',
                'office_id' => 'required',
                'transaction_no' => 'required',
                'cat_id' => 'required',
                'purpose_name' => 'required',
            ]); 

            // $currentYear = now()->year;
            // $prReceipt = Purpose::whereYear('created_at', $currentYear)->latest()->first();
            // $counter = $prReceipt ? (int)substr($prReceipt->pr_no, -5) + 1 : 1;
            // $formattedCounter = str_pad($counter, 5, '0', STR_PAD_LEFT);
            // $prControl = $currentYear . '-' . $formattedCounter;

            $year = Carbon::now()->format('Y');
            $prnumber = '';

            //$latestPrnumber = Purpose::where('pr_no', $prnumber)->latest('created_at')->first();
            $latestPrnumber = Purpose::where('pr_no', 'like', $year . '%')->latest('created_at')->first();

            if (empty($latestPrnumber) || date('Y', strtotime($latestPrnumber->created_at)) < $year) {
                $latestId = 0;
            } else {
                $latestId = (int)substr($latestPrnumber->pr_no, -5);
            }

            $newPrId = $latestId + 1;
            $paddedValue = str_pad($newPrId, 5, '0', STR_PAD_LEFT);
            $prnumber = $year . '-'. $paddedValue;

            $existingPrId = Purpose::where('pr_no', $prnumber)->first();

            if ($existingPrId) {
                $prnumber = $existingPrId->pr_no + 1;
            }
    
            try {
                $purpose = Purpose::create([
                    'user_id' => $request->input('user_id'),
                    'camp_id' => $request->input('camp_id'),
                    'office_id' => $request->input('office_id'),
                    'transaction_no' => $request->input('transaction_no'),
                    'pr_no' => $prnumber,
                    'type_request' => '1',
                    'cat_id' => $request->input('cat_id'),
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
                PpmpVerify::create([
                    'user_id' => $request->input('user_id'),
                    'camp_id' => $request->input('camp_id'),
                    'office_id' => $request->input('office_id'),
                    'purpose_id' => $purpose->id,
                    'remember_token' => Str::random(60),
                ]);
    
                //return redirect()->route('prPurposeRequest')->with('success', 'Purpose added successfully!');
                return redirect()->route('selectItems', encrypt($purpose->id))->with('success', 'Added successfully!');
            } catch (\Exception $e) {
                return redirect()->route('prPurposeRequest')->with('error', 'Failed to add Purpose!');
            }
        }
    }

    public function selectItems($purpose_Id) {
        $userId = Auth::id();
        $purpose_id = decrypt($purpose_Id);
        $purpose = Purpose::find($purpose_id);

        $items = Item::join('purpose', 'item.category_id', '=', 'purpose.cat_id')
                        ->join('category', 'item.category_id', '=', 'category.id')
                        ->join('unit', 'item.unit_id', '=', 'unit.id')
                        ->whereIn('item.category_id', [$purpose->cat_id])
                        ->groupBy('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id', 'item.item_cost', 'category.category_name')
                        ->select('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id AS unit_id_alias', 'item.item_cost', 'category.category_name')
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

        return view ("request.add.add_cart", compact('items', 'userId', 'data', 'purpose', 'selecteditem'));
    }

    // public function prCreateRequest($purpose_Id) {
    //     $userId = Auth::id();
    //     $category = Category::all();
    //     $unit = Unit::all();
    //     $item = Item::all();

    //     $purpose_id = decrypt($purpose_Id);
    //     $purpose = Purpose::find($purpose_id);

    //     $reqitem = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
    //         ->leftJoin('unit', 'item_request.unit_id', '=', 'unit.id')
    //         ->join('item', 'item_request.item_id', '=', 'item.id')
    //         ->join('office', 'item_request.off_id', '=', 'office.id')
    //         ->select('item_request.*', 
    //                 'category.category_name', 
    //                 'unit.unit_name', 'item.*', 
    //                 'item_request.id as iid' )
    //         ->where('item_request.status', '=', '1')
    //         ->where('item_request.purpose_id', '=',  $purpose_id)
    //         ->where('item_request.user_id', '=',  $userId)
    //         ->get();

    //     $pendCount = $this->getPendingAllCount();
    //     $pendUserCount = $this->getPendingUserCount();
    //     $approvedCount = $this->getApprovedAllCount();
    //     $approvedUserCount = $this->getApprovedUserCount();
    //     $data = [   'pendCount' => $pendCount, 
    //                 'pendUserCount' => $pendUserCount,
    //                 'approvedCount' => $approvedCount, 
    //                 'approvedUserCount' => $approvedUserCount,
    //             ];

    //     return view ("request.add.add_newpr", compact('category', 'unit', 'item', 'reqitem', 'purpose', 'data'));
    // }

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
                $nowInManila = Carbon::now('Asia/Manila');

                $itemCost = str_replace(',', '', $request->input('item_cost'));
                $totalCost = str_replace(',', '', $request->input('total_cost'));

                $newlyCreatedItem = RequestItem::create([
                    'transaction_no' => $request->input('transaction_no'),
                    'category_id' => $request->input('category_id'),
                    'unit_id' => $request->input('unit_id'),
                    'item_id' => $request->input('item_id'),
                    'item_cost' => $itemCost,
                    'qty' => $request->input('qty'),
                    'total_cost' => $totalCost,
                    'purpose_id' => $request->input('purpose_id'),
                    'user_id' => $request->input('user_id'),
                    'off_id' => $request->input('off_id'),
                    'campid' => $request->input('campid'),
                    'remember_token' => Str::random(60),
                    'created_at' => $nowInManila,
                    'updated_at' => $nowInManila,
                ]);

                $newItemId = $newlyCreatedItem->id;

                $reqItem = RequestItem::find($newItemId);
                $totalcost = number_format($reqItem->sum('total_cost'), 2);

                $newrow = "
                    <tr>
                        <td></td>
                        <td>$reqItem->item_id</td>
                        <td>number_format($totalcost, 2)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>

                        </td>
                    </tr>
                ";

                $data = [
                    'newrow' => $newrow,
                    'totalcost' => $totalcost,
                ];

                //return redirect()->back()->with('success', 'Item add successfully!');
                return response()->json(['success' => true, 'message' => $data]);
            } catch (\Exception $e) {
                //return redirect()->back()->with('error', 'Failed to add Item!');
                return response()->json(['error' => true, 'message' => 'Failed to add Item in Cart!']);
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

        return redirect()->route('pendingListRead')->with('success', 'PR Submit Successfully');
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
