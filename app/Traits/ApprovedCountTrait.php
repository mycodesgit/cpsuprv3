<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;
use App\Models\Office;
use App\Models\Purpose;
use App\Models\RequestItem;
use App\Models\User;

trait ApprovedCountTrait
{
    // public function getApprovedAllCount()
    // {
    //     return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
    //         ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
    //         ->whereIn('purpose.pstatus',  ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
    //         ->count();
    // }

    public function getApprovedAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            // ->whereIn('purpose.pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('purpose.pstatus', 7)
            ->count();
    }

    public function getReceivedAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 8)
            ->count();
    }

    public function getCanvassingAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 9)
            ->count();
    }

    public function getCanvassedAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 10)
            ->count();
    }

    public function getPhilGepAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 11)
            ->count();
    }

    public function getPostedAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 12)
            ->count();
    }

    public function getBiddingAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 13)
            ->count();
    }

    public function getConsolidateAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 14)
            ->count();
    }

    public function getAwardedAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 15)
            ->count();
    }

    public function getPurchaseAllCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 16)
            ->count();
    }







    
    public function getApprovedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            // ->whereIn('purpose.pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('purpose.pstatus', 7)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getReceivedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 8)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getCanvassingUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 9)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getCanvassedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 10)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getPhilGepUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 11)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getPostedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 12)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getBiddingUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 13)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getConsolidateUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 14)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getAwardedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 15)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }

    public function getPurchaseUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->where('purpose.pstatus', 16)
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }
}
