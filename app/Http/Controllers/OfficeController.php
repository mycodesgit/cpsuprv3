<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Office;

class OfficeController extends Controller
{
    public function officeRead() {
        $office = Office::all();
        return view('manage.office', compact('office'));
    }

     public function officeCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'office_name' => 'required',
                'office_abbr' => 'required',
            ]);

            $officeName = $request->input('office_name'); 
            $existingOffice = Office::where('office_name', $officeName)->first();

            if ($existingOffice) {
                return redirect()->route('officeRead')->with('error1', 'Office already exists!');
            }

            try {
                Office::create([
                    'office_name' => $officeName,
                    'office_abbr' => $request->input('office_abbr'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('officeRead')->with('success', 'Office stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('officeRead')->with('error1', 'Failed to store Office!');
            }
        }
    }

    public function officeEdit($id) {
        $office = Office::all();

        $selectedOffice = Office::findOrFail($id);

        return view('manage.office', compact('office', 'selectedOffice'));
    }

    public function officeUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'office_name' => 'required',
            'office_abbr' => 'required',
        ]);

        try {
            $officeName = $request->input('office_name');
            $existingOffice = Office::where('Office_name', $officeName)->where('id', '!=', $request->input('id'))->first();

            if ($existingOffice) {
                return redirect()->back()->with('error1', 'Office already exists!');
            }

            $office = Office::findOrFail($request->input('id'));
            $office->update([
                'office_name' => $officeName,
                'office_abbr' => $request->input('office_abbr')
            ]);

            return redirect()->route('officeEdit', ['id' => $office->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error1', 'Failed to update Office!');
        }
    }

    public function officeDelete($id){
        $office = Office::find($id);
        $office->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}
