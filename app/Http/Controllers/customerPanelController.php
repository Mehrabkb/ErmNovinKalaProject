<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerPanelController extends Controller
{
    public function home(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.home');
        }
    }
}
