<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;

class PSISController extends Controller
{
    public function approvedPr($prno)
    {
        $apppr = Purpose::whereIn('pstatus', ['7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'])
            ->where('purpose.pr_no', $prno)
            ->leftJoin('item_request', 'item_request.purpose_id', '=', 'purpose.id')
            ->select(
                'purpose.pr_no',
                \DB::raw('SUM(item_request.total_cost) as grand_total')
            )
            ->groupBy('purpose.id', 'purpose.pr_no')
            ->get();

        return response()->json([
            'data' => $apppr
        ]);
    }
}
