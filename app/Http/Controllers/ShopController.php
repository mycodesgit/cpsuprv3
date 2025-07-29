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

use App\Models\FundingSource;
use App\Models\PpmpVerify;
use App\Models\PpmpUser;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\DocFile;
use App\Models\User;
use App\Models\Annoucement;

class ShopController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function shoplistRead()
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

        $items = Item::join('purpose', 'item.category_id', '=', 'purpose.cat_id')
                        ->join('category', 'item.category_id', '=', 'category.id')
                        ->join('unit', 'item.unit_id', '=', 'unit.id')
                        ->where('item.status', '=', 1)
                        ->groupBy('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id', 'item.item_cost', 'category.category_name')
                        ->select('item.id', 'item.item_descrip', 'item.category_id', 'unit.unit_name', 'unit.id as unit_id_alias', 'item.item_cost', 'category.category_name')
                        ->get();

        $userId = auth()->id();

        $purposes = Purpose::join('item_request', 'purpose.id', '=', 'item_request.purpose_id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->where('purpose.user_id', $userId)
            ->where('purpose.type_request', 1)
            ->where('item_request.status', 1)
            ->select(
                'purpose.id as purpose_id',
                'purpose.purpose_name',
                'item_request.qty',
                'item_request.item_cost',
                'item_request.total_cost',
                'item.item_descrip'
            )
            ->orderBy('purpose.id')
            ->get()
            ->groupBy('purpose_id');


        
        return view("request.add.shopnew", compact('data', 'items', 'purposes'));
    }

    public function getshoplistSerialize()
    {
        $data = Item::join('unit', 'item.unit_id', '=', 'unit.id')
                ->join('category', 'item.category_id', '=', 'category.id')
                ->select('item.*', 'category.category_name', 'unit.*', 'item.id as itid', 'unit.id as unit_id_alias')
                ->where('item.status', '=', 1)
                ->get();

        return response()->json(['data' => $data]);
    }

    public function addToCartItemShop(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'user_id' => 'required',
                'category_id' => 'required',
                'camp_id' => 'required',
                'office_id' => 'required',
                'item_id' => 'required',
                'unit_id' => 'required',
                'item_cost' => 'required',
                'qty' => 'required',
                'total_cost' => 'required',
            ]);

            try {
                $user = Auth::guard('web')->user();
                $categoryId = $request->input('category_id');

                // Check if Purpose already exists
                $existingPurpose = Purpose::where('user_id', $user->id)
                    ->where('cat_id', $categoryId)
                    ->where('type_request', 1)
                    ->first();

                if ($existingPurpose) {
                    $purpose = $existingPurpose;
                    $transaction_no = $purpose->transaction_no;
                } else {
                    // Count PR Cart for naming
                    $existingPRCount = Purpose::where('user_id', $user->id)
                        ->where('type_request', 1)
                        ->where('purpose_name', 'like', 'PR Cart%')
                        ->count();

                    $newCartNumber = $existingPRCount + 1;
                    $purpose_name = 'PR Cart ' . $newCartNumber;

                    // Generate transaction number
                    $transaction_no = $user->office->office_abbr . '-' . Str::random(3) . rand(100, 999) . '-' . Str::random(3) . '-' . now()->format('Ymd');

                    // Create Purpose
                    $purpose = Purpose::create([
                        'user_id' => $user->id,
                        'camp_id' => $user->campus_id,
                        'office_id' => $user->office_id,
                        'transaction_no' => $transaction_no,
                        'type_request' => 1,
                        'cat_id' => $categoryId,
                        'purpose_name' => $purpose_name,
                        'remember_token' => Str::random(60),
                    ]);

                    // Related tables only if Purpose is new
                    FundingSource::create([
                        'user_id' => $user->id,
                        'camp_id' => $user->campus_id,
                        'office_id' => $user->office_id,
                        'purpose_id' => $purpose->id,
                        'remember_token' => Str::random(60),
                    ]);

                    PpmpVerify::create([
                        'user_id' => $user->id,
                        'camp_id' => $user->campus_id,
                        'office_id' => $user->office_id,
                        'purpose_id' => $purpose->id,
                        'remember_token' => Str::random(60),
                    ]);

                    DocFile::create([
                        'purpose_id' => $purpose->id,
                        'user_id' => $user->id,
                        'remember_token' => Str::random(60),
                    ]);
                }

                // Always add the item to the cart
                $nowInManila = Carbon::now('Asia/Manila');
                $itemCost = str_replace(',', '', $request->input('item_cost'));
                $totalCost = str_replace(',', '', $request->input('total_cost'));

                RequestItem::create([
                    'transaction_no' => $transaction_no,
                    'category_id' => $categoryId,
                    'unit_id' => $request->input('unit_id'),
                    'item_id' => $request->input('item_id'),
                    'item_cost' => $itemCost,
                    'qty' => $request->input('qty'),
                    'total_cost' => $totalCost,
                    'purpose_id' => $purpose->id,
                    'user_id' => $user->id,
                    'off_id' => $user->office_id,
                    'campid' => $user->campus_id,
                    'remember_token' => Str::random(60),
                    'created_at' => $nowInManila,
                    'updated_at' => $nowInManila,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Item added successfully.',
                    'transaction_no' => $transaction_no,
                    'purpose_id' => $purpose->id,
                ]);

            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    public function getAccordion()
    {
        $purposes = Purpose::with(['items'])
            ->where('user_id', auth()->id())
            ->where('type_request', 1)
            ->whereHas('items')
            ->get();

        return view('partials._purpose_accordion', compact('purposes'));
    }

    public function updatePurposeName(Request $request, $id)
    {
        $request->validate([
            'purpose_name' => 'required',
        ]);

        $purpose = Purpose::findOrFail($id);
        $purpose->purpose_name = $request->input('purpose_name');
        $purpose->save();

        return response()->json(['success' => true]);
    }
}
