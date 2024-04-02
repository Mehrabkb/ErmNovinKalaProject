<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class customerPanelController extends Controller
{
    public function __construct(UserRepository $userRepository){
        $this->middleware('checkCustomerLogin');
        $this->userRepository = $userRepository;
    }
    public function home(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.home');
        }
    }
    public function logout($id){
        if($this->userRepository->logoutUserById($id)){
            return redirect()->route('customer.login');
        }else{
            return redirect()->back()->withErrors(['msg' => 'در خروج شما از سیستم مشکلی پیش امده است']);
        }
    }
}
