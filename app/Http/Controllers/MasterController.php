<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;
use App\Traits\ReturnedCountTrait;

use App\Models\Purpose;
use App\Models\Category;
use App\Models\Office;
use App\Models\Item;
use App\Models\Campus;
use App\Models\User;
use App\Models\PpmpUser;
use App\Models\Annoucement;
use App\Models\RecentUpdates;


class MasterController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function dashboard()
    {
        $now = Carbon::now();
        $userId = Auth::guard('web')->user()->id;

        $camp = Campus::all();
        $userActiveCount = User::where('ustatus', '=', '1')->count();
        $userDeactCount = User::where('ustatus', '=', '2')->count();
        $itemsCount = Item::where('item.status', '=', 1)->count();
        $categoryCount = Category::where('cstatus', '=', 1)->count();
        $campusCount = Campus::count();
        $offCount = Office::count();
        $annoucement = Annoucement::first();
        $otherupdates = RecentUpdates::where('status', 1)->orderBy('created_at', 'desc')->get();

        $ppending = Purpose::whereIn('pstatus', ['2', '4', '5', '6', '99'])->where('purpose.user_id', '=',  $userId)->get();
        $papproved = Purpose::whereIn('pstatus', ['7', '8'])->where('purpose.user_id', '=',  $userId)->get();
        $pcancel = Purpose::where('pstatus', '=', '19')->where('purpose.user_id', '=',  $userId)->get();

        $pcheckerpending = Purpose::whereIn('pstatus', ['2'])->get();
        $piconcheckerpending = Purpose::whereIn('pstatus', ['2'])->count();
        $pcheckerapproved = Purpose::whereIn('pstatus', ['7', '8'])->get();
        $pcheckercancel = Purpose::where('pstatus', '=', '19')->get();
        $piconcheckercancel = Purpose::where('pstatus', '=', '19')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();

        $countppending = Purpose::whereBetween('pstatus', [4, 16])
            ->where('purpose.user_id', $userId)
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $countpapproved = Purpose::whereIn('pstatus', ['7', '8'])
            ->where('purpose.user_id', $userId)
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

        $countpreturned = Purpose::where('pstatus', '3')
            ->where('purpose.user_id', $userId)
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)
            ->count();

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
                  
        
        return view("home.dashboard", compact('data', 'camp', 'userActiveCount', 'userDeactCount', 'categoryCount', 'itemsCount', 'campusCount', 'offCount', 'category', 'annoucement', 'otherupdates', 'ppending', 'papproved', 'pcancel', 'pcheckerpending', 'piconcheckerpending', 'pcheckerapproved', 'pcheckercancel', 'piconcheckercancel', 'countppending', 'countpapproved', 'countpreturned'));
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    // }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('getLogin')->with('success', 'You have been Successfully Logged Out');
    }
}
