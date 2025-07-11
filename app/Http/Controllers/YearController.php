<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\YearPR;

class YearController extends Controller
{
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
