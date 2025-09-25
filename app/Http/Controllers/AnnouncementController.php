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

use App\Models\Annoucement;
use App\Models\RecentUpdates;

class AnnouncementController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function annouceInfo() 
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

        $annoucement = Annoucement::first();

        return view('info.announcement', compact('data', 'annoucement'));
    }

    public function annouceUpdate(Request $request) {
        $anouce = Annoucement::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'announcement' => 'required',
            'datestart' => 'required',
            'dateend' => 'required',
        ]);

        try {
            $anouceName = $request->input('announcement');
            $existingAnnouce = Annoucement::where('announcement', $anouceName)->where('id', '!=', $request->input('id'))->first();

            if ($existingAnnouce) {
                return redirect()->back()->with('error', 'Annoucement already exists!');
            }

            $anouce = Annoucement::find($request->input('id'));
            $anouce->update([
                'announcement' => $request->input('announcement'),
                'datestart' => $request->input('datestart'),
                'dateend' => $request->input('dateend'),
                'status' => $request->input('status'),
            ]);

            return redirect()->back()->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Annoucement!');
        }
    }

    public function otherAnnounceCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'otherannouncement' => 'required',
            ]);

            $announceName = $request->input('otherannouncement'); 
            $existingOtherAnnounce = RecentUpdates::where('otherannouncement', $announceName)->first();

            if ($existingOtherAnnounce) {
                return response()->json(['error' => true, 'message' => 'Other Announcement already exists!']);
            }

            try {
                RecentUpdates::create([
                    'otherannouncement' => $request->input('otherannouncement'),
                    'postedby' => Auth::guard('web')->user()->id,
                ]);

                return response()->json(['success' => true, 'message' => 'Other Announcement stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Other Announcement!']);
            }
        }
    }

    public function getotherAnnounceRead() 
    {
        $data = RecentUpdates::join('users', 'recentupdates.postedby', '=', 'users.id')
            ->select('recentupdates.*', 'users.lname', 'users.fname', 'users.mname', 'recentupdates.id as rid')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function otherAnnounceUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'otherannouncement' => 'required',
        ]);

        try {
            $announceName = $request->input('otherannouncement'); 
            $existingOtherAnnounce = RecentUpdates::where('otherannouncement', $announceName)->where('id', '!=', $request->input('id'))->first();

            if ($existingOtherAnnounce) {
                return response()->json(['error' => true, 'message' => 'Other Announcement already exists!'], 200);
            }

            $otheranounce = RecentUpdates::findOrFail($request->input('id'));
            $otheranounce->update([
                'otherannouncement' => $request->input('otherannouncement'),
                'postedby' => Auth::guard('web')->user()->id,
            ]);
            return response()->json(['success' => true, 'message' => 'Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Other Announcement!'], 404);
        }
    }

    public function otherAnnounceDelete($id) 
    {
        $otheranounce = RecentUpdates::find($id);
        if ($otheranounce) {
            $otheranounce->delete();
            return response()->json(['success'=> true, 'message'=>'Deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Data not found']);
    }
}
