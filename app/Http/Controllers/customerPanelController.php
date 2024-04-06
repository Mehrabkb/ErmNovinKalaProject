<?php

namespace App\Http\Controllers;

use App\Repositories\alertifyRepository;
use App\Repositories\basketRepository;
use App\Repositories\factorRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class customerPanelController extends Controller
{
    public function __construct(UserRepository $userRepository , productRepository $productRepository, basketRepository $basketRepository ,
    alertifyRepository $alertifyRepository , factorRepository $factorRepository){
        $this->middleware('checkCustomerLogin');
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->basketRepository = $basketRepository;
        $this->alertifyRepository = $alertifyRepository;
        $this->factorRepository = $factorRepository;
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
            $fullBasket = $this->basketRepository->getUserBasketFullModelByBasketId($basket);
            return view('customerPanel.factor.add' , compact('basketItems' , 'fullBasket'));
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
                    $product = $this->productRepository->getProductById($product_id);
                    $basket = $this->basketRepository->getUserBasketFullModelByBasketId($basketId);
                    $this->basketRepository->updateBasketPrice($basketId , $basket->total_price + $product->price * $count);
                    return redirect()->back()->with(['success' => 'با موفقیت اضافه شد']);
                }else{
                    return redirect()->back()->withErrors('مشکلی در افزودن محصول رخ داده است');
                }
            }
        }
    }
    public function deleteBasketItem(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'id' => 'required'
            ],[
                'id.required' => 'آیدی نمیتواند خالی باشد'
            ]);
            if($validate){
                $id = htmlspecialchars($request->input('id'));
                $basketItem = $this->basketRepository->getBasketItemByBasketItemId($id);
                $basket = $this->basketRepository->getUserBasketFullModelByBasketId($basketItem->basket_id);
                if($basketItem){
                    $product = $this->productRepository->getProductById($basketItem->product_id);
                    $price = $basketItem->count * $product->price;
                    if($this->basketRepository->deleteBasketItemByBasketItemId($basketItem->basket_item_id)){
                        $totalPrice = $basket->total_price - $price;
                        $this->basketRepository->updateBasketPrice($basket->basket_id , $totalPrice);
                        return $this->alertifyRepository->successMessage('با موفقیت حذف شد');
                    }else{
                        return $this->alertifyRepository->errorMessage('در حذف رکورد مشکلی رخ داده است');
                    }
                }else{
                    return $this->alertifyRepository->errorMessage('رکورد یافت نشد');
                }
            }
        }
    }
    public function addPreFactor($id){
         $basketId = htmlspecialchars($id);
         $basket = $this->basketRepository->getUserBasketFullModelByBasketId($basketId);
         if($basket->user_id == Auth::user()->user_id){
            if($this->factorRepository->addFactor($basket->basket_id)){
                 return redirect()->back()->with(['success' => 'پیش فاکتور با موفقیت ایجاد شد']);
            }
            }else{
                return redirect()->back()->withErrors('کاربر گرامی شما مجوز انجام این فعالیت را ندارید');
            }
    }
    public function factors(Request $request){
        if($request->isMethod('GET')){
            $factors = $this->factorRepository->getFactorsByUserId(Auth::user()->user_id);
            return view('customerPanel.factor.factors' , compact('factors'));
        }
    }
    public function userInfo(Request $request){
        if($request->isMethod('GET')){
            $user = $this->userRepository->getUserByMobile(Auth::user()->phone);
            return view('customerPanel.userInfo' , compact('user') );
        }
    }
}
