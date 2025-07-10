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

trait PendingCountTrait
{
    public function getPendingAllCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['2', '4', '5'])
            ->count();
    }
    public function getPendingBudgetCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['6'])
            ->count();
    }
    public function getPendingUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->whereIn('purpose.pstatus', ['2', '4', '5', '6'])
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }
    public function getPendingTechAllCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.pstatus', '=', '99')
            ->count();
    }
}
