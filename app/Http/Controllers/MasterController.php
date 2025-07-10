<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Category;
use App\Models\Office;
use App\Models\Campus;
use App\Models\User;
use App\Models\PpmpUser;
use App\Models\Annoucement;


class MasterController extends Controller
{
    public function dashboard()
    {
        $camp = Campus::all();
        $userCount = User::count();
        $campusCount = Campus::count();
        $offCount = Office::count();
        $annoucement = Annoucement::first();
        $userCategoryIds = PpmpUser::where('user_id', Auth::user()->id)
                             ->pluck('ppmp_categories')
                             ->flatMap(function ($item) {
                                 return json_decode($item);
                             })
                             ->unique()
                             ->values()
                             ->all();
        $category = Category::whereIn('id', $userCategoryIds)->get();
                  
        
        return view("home.dashboard", compact('camp', 'userCount', 'campusCount', 'offCount', 'category', 'annoucement'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
