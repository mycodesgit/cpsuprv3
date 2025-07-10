<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;
use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;

class PDFprController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;

    public function PDFprRead() {
        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
            ]);
        }

        return view('request.forms.PRFormTemplate', compact('data'));
    }

    public function PDFprShowTemplate() {
        $pdf = PDF::loadView('request.forms.prTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }

    public function PDFbarsRead() {
        $pendCount = $this->getPendingAllCount();
        $pendUserCount = $this->getPendingUserCount();
        $approvedCount = $this->getApprovedAllCount();
        $approvedUserCount = $this->getApprovedUserCount();
        $data = [   'pendCount' => $pendCount, 
                    'pendUserCount' => $pendUserCount,
                    'approvedCount' => $approvedCount, 
                    'approvedUserCount' => $approvedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendUserCount' => $pendUserCount,
                'approvedCount' => $approvedCount, 
                'approvedUserCount' => $approvedUserCount,
            ]);
        }

        return view('request.forms.BARSFormTemplate', compact('data'));
    }
    
    public function PDFbarsShowTemplate() {
        $pdf = PDF::loadView('request.forms.barsTemplate')->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
}
