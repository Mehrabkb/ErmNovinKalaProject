<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class customerAuthenticateController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.authenticate.login');
        }
    }
}
