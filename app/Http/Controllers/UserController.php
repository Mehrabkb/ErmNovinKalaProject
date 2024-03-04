<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function GuzzleHttp\default_user_agent;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkUserLoginUserRoute');
    }

    public function login(Request $request){
        return view('panel/authenticate/login');
    }
}
