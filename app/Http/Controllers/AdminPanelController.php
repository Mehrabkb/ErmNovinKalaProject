<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('checkUserLogin');
        $this->userRepository = $userRepository;
    }

    public function index(Request $request){
        return view('panel/home');
    }
    public function logout($id){
        if($this->userRepository->logoutUserById($id)){
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors(['msg' => 'در خروج شما از سیستم مشکلی پیش امده است']);
        }
    }
}
