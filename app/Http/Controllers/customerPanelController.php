<?php

namespace App\Http\Controllers;

use App\Repositories\basketRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class customerPanelController extends Controller
{
    public function __construct(UserRepository $userRepository , productRepository $productRepository, basketRepository $basketRepository){
        $this->middleware('checkCustomerLogin');
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->basketRepository = $basketRepository;
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
            $basket = $this->basketRepository->getUserBasket(Auth::user()->user_id);
            $basketItems = $this->basketRepository->getBasketItems($basket);
            return view('customerPanel.factor.add' , compact('basketItems'));
        }
    }
    public function productSearchResult(Request $request){
        if($request->isMethod('GET')){
            $value = htmlspecialchars($request->input('q'));
            $products = $this->productRepository->searchProduct($value , 'title');
            return $products;
        }
    }
    public function basketItemAdder(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'product-id' => 'required',
                'count' => 'required'
            ],[
                'product-id.required' => 'لطفا یک محصول را انتخاب کنید',
                'count.required' => 'تعداد محصول را وارد کنید'
            ]);
            if($validate){
                $product_id = htmlspecialchars($request->input('product-id'));
                $count = htmlspecialchars($request->input('count'));
                $user = Auth::user();
                $checkBasket = $this->basketRepository->checkUserBasket($user->user_id);
                $basketId = 0;
                if($checkBasket){
                    $basketId = $checkBasket;
                }else{
                    $basketId = $this->basketRepository->createBasket($user->user_id);
                }
                if($this->basketRepository->addBasketItem($basketId , $product_id , $count)){
                    return redirect()->back()->with(['success' => 'با موفقیت اضافه شد']);
                }else{
                    return redirect()->back()->withErrors('مشکلی در افزودن محصول رخ داده است');
                }
            }
        }
    }
}
