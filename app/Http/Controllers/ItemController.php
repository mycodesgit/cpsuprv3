<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\Unit;
use App\Models\Item;

class ItemController extends Controller
{
    public function itemRead() {
        $category = Category::all();
        $unit = Unit::all();
        $item = Item::join('unit', 'item.unit_id', '=', 'unit.id')
                ->join('category', 'item.category_id', '=', 'category.id')
                ->select('item.*', 'category.category_name', 'unit.*', 'item.id as itid')
                ->get();

        return view('manage.item', compact('category', 'unit', 'item'));
    }

    public function getitemRead() {
        $category = Category::all();
        $unit = Unit::all();
        $data = Item::join('unit', 'item.unit_id', '=', 'unit.id')
                ->join('category', 'item.category_id', '=', 'category.id')
                ->select('item.*', 'category.category_name', 'unit.*', 'item.id as itid')
                ->where('item.status', '=', 1)
                ->get();

        return response()->json(['data' => $data]);
    }

    public function itemCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'category_id' => 'required',
                'unit_id' => 'required',
                'item_descrip' => 'required',
                'item_cost' => 'required',
            ]);

            // $itemName = $request->input('item_descrip'); 
            // $existingItem = Item::where('item_descrip', $itemName)->first();

            // if ($existingItem) {
            //     return response()->json(['error' => true, 'message' => 'Item already exists!']);
            // }

            try {
                Item::create([
                    'category_id' => $request->input('category_id'),
                    'unit_id' => $request->input('unit_id'),
                    'item_name' => $request->input('item_name'),
                    'item_descrip' => $request->input('item_descrip'),
                    'item_cost' => $request->input('item_cost'),
                    'remember_token' => Str::random(60),
                ]);

                return response()->json(['success' => true, 'message' => 'Item stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Item!']);
            }
        }
    }

    public function itemUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'item_descrip' => 'required',
            'item_cost' => 'required',
        ]);

        try {
            $itemdescripName = $request->input('item_descrip');
            $existingItem = Item::where('item_descrip', $itemdescripName)->where('id', '!=', $request->input('id'))->first();

            if ($existingItem) {
                return response()->json(['error'=> true, 'message' => 'Item already exists!']);
            }

            $item = Item::findOrFail($request->input('id'));
            $item->update([
                'category_id' => $request->input('category_id'),
                'unit_id' => $request->input('unit_id'),
                'item_descrip' => $itemdescripName,
                'item_cost' => $request->input('item_cost'),
        ]);
            return response()->json(['success' => true, 'message' => 'Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Category!']);
        }
    }

    public function itemDelete($id) {
        $item = Item::find($id);
        if ($item) {
            $item->status = 2;
            $item->save();
            return response()->json(['success'=> true, 'message'=>'Status updated to deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Item not found']);
    }

    public function itemAllDelete() {
        $updated = Item::where('status', '!=', 2)->update(['status' => 2]);
        if ($updated) {
            return response()->json(['success' => true, 'message' => 'All items status updated to deleted successfully']);
        }
        return response()->json(['error' => true, 'message' => 'No items found to update']);
    }
}
