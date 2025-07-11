<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;

class CategoryController extends Controller
{   
    public function categoryRead() 
    {
        $category = Category::orderBy('category_name', 'ASC')->get();
        $unit = Unit::all();

        return view('manage.category', compact('category', 'unit'));
    }

    public function getcategoryRead() 
    {
        $data = Category::orderBy('category_name', 'ASC')->get();
        return response()->json(['data' => $data]);
    }

    public function categoryCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_name' => 'required',
            ]);

            $categoryName = $request->input('category_name'); 
            $existingCategory = Category::where('category_name', $categoryName)->first();

            if ($existingCategory) {
                return redirect()->route('categoryRead')->with('error1', 'Category already exists!');
            }

            try {
                Category::create([
                    'category_name' => $request->input('category_name'),
                    'remember_token' => Str::random(60),
                ]);
                return response()->json(['success' => true, 'message' => 'Category stored successfully!'],  200);

            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Category!'],  404);
            }
        }
    }

    public function categoryUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'category_name' => 'required',
        ]);

        try {
            $categoryName = $request->input('category_name');
            $existingCategory = Category::where('category_name', $categoryName)->where('id', '!=', $request->input('id'))->first();

            if ($existingCategory) {
                return response()->json(['error' => true, 'message' => 'Category already exists!'], 200);
            }

            $category = Category::findOrFail($request->input('id'));
            $category->update([
                'category_name' => $categoryName,
            ]);
            return response()->json(['success' => true, 'message' => 'Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Category!'], 404);
        }
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json(['success'=> true, 'message'=>'Deleted Successfully',]);
    }
}
