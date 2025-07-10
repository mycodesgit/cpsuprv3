<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    // public function index() {
    //     return view('manage.index');
    // }

    public function category_list() {
        return view('manage.category');
    }

    public function unit_list() {
        return view('manage.unit');
    }

    public function item_list() {
        return view('manage.item');
    }

    public function office_list() {
        return view('manage.office');
    }
}
