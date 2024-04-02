<?php

namespace App\Http\Controllers;

use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerPanelController extends Controller
{
    public function __construct(UserRepository $userRepository , productRepository $productRepository){
        $this->middleware('checkCustomerLogin');
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
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
    public function addFactor(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.factor.add');
        }
    }
    public function productSearchResult(Request $request){
        if($request->isMethod('GET')){
            $value = htmlspecialchars($request->input('q'));
            $products = $this->productRepository->searchProduct($value , 'title');
            return $products;
        }
    }
}
