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

class RequestController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function shop()
    {
        $annoucement = Annoucement::first();
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
        $returnedCount = $this->getReturnedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                    'returnedCount' => $returnedCount,
                ];
        
        return view ("request.add.shop", compact('data', 'category', 'annoucement'));
    }

    public function getCategories()
    {
        $categories = Category::all(); 

        return response()->json(['categories' => $categories]);
    }


    public function prPurposeRequest() 
    {
        $userId = Auth::id();
        $category = Category::all();
        $repurpose = Purpose::join('category', 'purpose.cat_id',  'category.id')
            ->join('ppmpverify', 'purpose.id',  'ppmpverify.purpose_id')
            ->select('purpose.*', 'category.*', 'purpose.id as purpose_Id', 'ppmpverify.*')
            ->whereIn('purpose.pstatus', ['1', '3'])
            ->where('purpose.user_id', '=',  $userId)
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $returnedCount = $this->getReturnedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                    'returnedCount' => $returnedCount,
                ];

        return view ("request.add.purpose", compact('repurpose', 'data', 'category'));
    }

    public function prPurposeRequestCreate(Request $request) 
    {
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
    
            try {
                $purpose = Purpose::create([
                    'user_id' => $request->input('user_id'),
                    'camp_id' => $request->input('camp_id'),
                    'office_id' => $request->input('office_id'),
                    'transaction_no' => $request->input('transaction_no'),
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
                DocFile::create([
                    'purpose_id' => $purpose->id,
                    'user_id' => $request->input('user_id'),
                    'remember_token' => Str::random(60),
                ]);
    
                //return redirect()->route('prPurposeRequest')->with('success', 'Purpose added successfully!');
                return redirect()->route('selectItems', encrypt($purpose->id))->with('success', 'Added successfully!');
            } catch (\Exception $e) {
                return redirect()->route('prPurposeRequest')->with('error', 'Failed to add Purpose!');
            }
        }
    }

    public function prPurposeRequestUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'purpose_name' => 'required',
        ]);

        try {
            $purpose = Purpose::findOrFail($request->input('id'));
            $purpose->update([
                'purpose_name' => $request->input('purpose_name')
            ]);

            return redirect()->back()->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error1', 'Failed to update!');
        }
    }

    public function selectItems($purpose_Id) 
    {
        $userId = Auth::id();
        $purpose_id = decrypt($purpose_Id);
        $purpose = Purpose::find($purpose_id);

        $items = Item::join('purpose', 'item.category_id', '=', 'purpose.cat_id')
                        ->join('category', 'item.category_id', '=', 'category.id')
                        ->join('unit', 'item.unit_id', '=', 'unit.id')
                        ->whereIn('item.category_id', [$purpose->cat_id])
                        ->where('item.status', '=', 1)
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
            ->where('item_request.purpose_id', '=',  $purpose_id)
            ->where('item_request.user_id', '=',  $userId)
            ->get();


        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $returnedCount = $this->getReturnedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                    'returnedCount' => $returnedCount,
                ];

        return view ("request.add.add_cart", compact('items', 'userId', 'data', 'purpose', 'selecteditem'));
    }

    public function getcartitemListRead($purpose_Id) 
    {
        $userId = Auth::id();
        $purpose_id = decrypt($purpose_Id);
        $purpose = Purpose::find($purpose_id);
        $data = RequestItem::leftJoin('category', 'item_request.category_id', '=', 'category.id')
            ->join('item', 'item_request.item_id', '=', 'item.id')
            ->join('office', 'item_request.off_id', '=', 'office.id')
            ->join('unit', 'item_request.unit_id', '=', 'unit.id')
            ->select('item_request.*', 
                    'category.category_name', 'item.*',
                    'unit.unit_name', 
                    'item_request.id as iid',
                    'item_request.item_cost as fitem_cost' )
            ->whereIn('item_request.status', ['1', '3'])
            ->where('item_request.purpose_id', '=',  $purpose_id)
            ->where('item_request.user_id', '=',  $userId)
            ->orderBy('item_request.created_at', 'ASC')
            ->get();

        foreach ($data as $record) {
            $record->pid = encrypt($record->pid);
        }
        return response()->json(['data' => $data]);
    }

    public function prCreate(Request $request) 
    {
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

                RequestItem::create([
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

                //return redirect()->back()->with('success', 'Item add successfully!');
                return response()->json(['success' => true, 'message' => 'Item added successfully']);
            } catch (\Exception $e) {
                //return redirect()->back()->with('error', 'Failed to add Item!');
                return response()->json(['error' => true, 'message' => 'Item added successfully']);
            }
        }
    }

    public function getItemsByCategory($id) 
    {
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

    public function savePR(Request $request) 
    {
        $userId = Auth::id();
        $purpose_id = decrypt($request->input('purpose_id'));
        $purpose = Purpose::find($purpose_id);
        
        // Get related request items
        $items = RequestItem::whereIn('status', ['1', '2', '3', '99'])
            ->where('user_id', $userId)
            ->where('purpose_id', $purpose_id)
            ->get();

        // Update each item's status
        foreach ($items as $item) {
            $item->status = ($item->category_id == 10) ? '99' : '2';
            $item->save();
        }

        // Check if any item has category_id == 10
        $hasCat10 = $items->contains('category_id', 10);

        // Update purpose pstatus
        $purpose = Purpose::find($purpose_id);
        if ($purpose) {
            $purpose->pstatus = $hasCat10 ? '99' : '2';
            $purpose->save();
        }

            // POW docs upload
        if ($request->hasFile('doc_file')) {
            $file = $request->file('doc_file');
            $userLastName = Auth::user()->lname;
            $currentDateTime = now()->format('YmdHis');
            $filename = $userLastName . '-pow-' . $currentDateTime;
            $extension = $file->getClientOriginalExtension();
            $filenameWithExtension = $filename . '.' . $extension;
            $path = $file->storeAs('pow', $filenameWithExtension, 'public');
            $docFile = DocFile::where('purpose_id', $purpose_id)->first();
            if (!$docFile) {
                $docFile = new DocFile();
                $docFile->purpose_id = $purpose_id;
            }
            $docFile->doc_file = $path;
            $docFile->save();
        }

        // PPMP docs upload
        if ($request->hasFile('ppmp_file')) {
            $file = $request->file('ppmp_file');
            $userLastName = Auth::user()->lname;
            $currentDateTime = now()->format('YmdHis');
            $filename = $userLastName . '-ppmp-' . $currentDateTime;
            $extension = $file->getClientOriginalExtension();
            $filenameWithExtension = $filename . '.' . $extension;
            $path = $file->storeAs('ppmp', $filenameWithExtension, 'public');
            $ppmpFile = DocFile::where('purpose_id', $purpose_id)->first();
            if (!$ppmpFile) {
                $ppmpFile = new DocFile();
                $ppmpFile->purpose_id = $purpose_id;
            }
            $ppmpFile->ppmp_file = $path;
            $ppmpFile->save();
        }

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

    public function mycartDelete($id)
    {
        DB::beginTransaction();
        
        try {
            FundingSource::where('purpose_id', $id)->delete();
            PpmpVerify::where('purpose_id', $id)->delete();
            DocFile::where('purpose_id', $id)->delete();

            $mycart = Purpose::find($id);
            if ($mycart) {
                $mycart->delete();
            }

            DB::commit();
            
            return response()->json([
                'status' => 200,
                'message' => 'Deleted Successfully',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 500,
                'message' => 'Failed to delete records',
                'error' => $e->getMessage(),
            ]);
        }
    }
}
