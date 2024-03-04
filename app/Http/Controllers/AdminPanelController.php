<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUserLogin');
    }

    public function index(Request $request){
        return true;
    }
}
