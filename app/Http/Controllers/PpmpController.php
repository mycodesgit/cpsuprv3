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

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\FundingSource;
use App\Models\User;
use App\Models\PpmpUser;

class PpmpController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;

    public function ppmpRead() 
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

        $categories = Category::all();

        $userppmp = PpmpUser::join('users', 'ppmpuser.user_id', '=', 'users.id')
            ->join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->select('ppmpuser.*', 'ppmpuser.id as puid', 'users.*', 'campuses.*', 'office.*', )
            ->get();
        
        return view("ppmp.list_officeppmp", compact('data', 'categories', 'userppmp'));
    }

    public function ppmpShow()
    {
        $userppmp = PpmpUser::join('users', 'ppmpuser.user_id', '=', 'users.id')
            ->join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->select(
                'ppmpuser.*',
                'ppmpuser.id as puid',
                'users.fname',
                'users.lname',
                'campuses.campus_name',
                'office.office_abbr'
            )
            ->get();

        $data = $userppmp->map(function ($item, $index) {

            $categories = [];
            $categoryIds = [];

            if ($item->ppmp_categories) {
                $decoded = json_decode($item->ppmp_categories);

                foreach ($decoded as $categoryId) {
                    $category = Category::find($categoryId);

                    $categories[] = $category ? $category->category_name : 'Unknown Category';
                    $categoryIds[] = $categoryId;
                }
            }

            return [
                'no' => $index + 1,
                'campus' => $item->campus_name,
                'office' => $item->office_abbr,
                'name' => $item->fname . ' ' . $item->lname,
                'categories' => $categories,
                'category_ids' => $categoryIds,
                'puid' => $item->puid
            ];
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function ppmpEdit($puid) {
        $userppmp = PpmpUser::find($puid);
        $categories = Category::all();

        return view('ppmp.list_officeppmp', compact('userppmp', 'categories'));
    }

    public function userppmpUpdate(Request $request) {
        $request->validate([
            'ppmp_categories' => 'required',
        ]);

        try {
            $userppmp = PpmpUser::findOrFail($request->input('id'));
            $userppmp->update([
                'ppmp_categories' => $request->input('ppmp_categories')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Updated successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
