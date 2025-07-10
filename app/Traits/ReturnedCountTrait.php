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

trait ReturnedCountTrait
{
    public function getReturnedAllCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->whereIn('purpose.pstatus', ['3'])
            ->where('purpose.officeidreturn', Auth::guard('web')->user()->role)
            ->count();
    }
    public function getReturnedBudgetCount()
    {
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->select('purpose.*', 'purpose.id as pid', 'office.*', 'office.id as oid')
            ->where('purpose.officeidreturn', Auth::guard('web')->user()->role)
            ->whereIn('purpose.pstatus', ['3'])
            ->count();
    }
    public function getReturnedUserCount()
    {
        $userId = Auth::id();
        return Purpose::join('office', 'purpose.office_id', '=', 'office.id')
            ->join('users', 'purpose.user_id', '=', 'users.id')
            ->whereIn('purpose.pstatus', ['3'])
            ->where('purpose.user_id', '=', $userId)
            ->count();
    }
}
