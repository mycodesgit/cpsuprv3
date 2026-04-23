<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;
use App\Traits\ReturnedCountTrait;

use App\Models\YearPR;

class YearController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function yearRead() 
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

        $year = YearPR::all();
        return view('manage.year', compact('data', 'year'));
    }

    public function getyearRead() 
    {
        $data = YearPR::all();
        return response()->json(['data' => $data]);
    }

    public function yearCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'pryear' => 'required',
            ]);

            $yearName = $request->input('pryear'); 
            $existingYear = YearPR::where('pryear', $yearName)->first();

            if ($existingYear) {
                return response()->json(['error' => true, 'message' => 'Year already exists!']);
            }

            try {
                YearPR::create([
                    'pryear' => $yearName
                ]);

                return response()->json(['success' => true, 'message' => 'Year stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Year!']);
            }
        }
    }

    public function yearUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'pryear' => 'required',
        ]);

        try {
            $prsetYear = $request->input('pryear');
            $existingYear = YearPR::where('pryear', $prsetYear)->where('id', '!=', $request->input('id'))->first();

            if ($existingYear) {
                return response()->json(['error' => true, 'message' => 'Year already exists!']);
            }

            $prsyr = YearPR::findOrFail($request->input('id'));
            $prsyr->update([
                'pryear' => $prsetYear,
                'status' => $request->input('status'),
            ]);

            return response()->json(['success' => true, 'message' => 'Year Updated Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Year!']);
        }
    }

    public function yearDelete($id){
        $prsyr = YearPR::find($id);
        $prsyr->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
