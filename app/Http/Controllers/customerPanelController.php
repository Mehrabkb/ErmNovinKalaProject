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
            $pre_factors = $this->factorRepository->getFactorsByStatus(Auth::user()->user_id , 'pre-factor');
            return view('customerPanel.home' , compact('pre_factors'));
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
                    $this->basketRepository->updateBasketPrice($basketId , ($basket->total_price + $product->price * $count) - (($product->price * $count) / 100) * $product->off);
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
                    $price = ($basketItem->count * $product->price) - (($basketItem->count * $product->price / 100) * $product->off);
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
        }else if($request->isMethod('POST')){
            $validate = $request->validate([
                'phone' => 'required'
            ],[
                'phone.required' => 'موبایل نمیتواند خالی باشد'
            ]);
            if($validate){
                $phone = htmlspecialchars($request->input('phone'));
                $data = [];
                $request->input('first-name') != null ? $data['first-name'] = htmlspecialchars($request->input('first-name')) : '';
                $request->input('last-name') != null ? $data['last-name'] = htmlspecialchars($request->input('last-name')) : '';
                $request->input('user-name') != null ? $data['user-name'] = htmlspecialchars($request->input('user-name')) : '';
                $request->input('email') != null ? $data['email'] = htmlspecialchars($request->input('email')) : '';
                $request->input('company-name') != null ? $data['company-name'] = htmlspecialchars($request->input('company-name')) : '';
                $request->input('company-phone') != null ? $data['company-phone'] = htmlspecialchars($request->input('company-phone')) : '';
                $request->input('company-address') != null ? $data['company-address'] = htmlspecialchars($request->input('company-address')) : '';
                $request->input('company-website') != null ? $data['company-website'] = htmlspecialchars($request->input('company-website')): '';
                $request->input('personal-website') != null ? $data['personal-website'] = htmlspecialchars($request->input('personal-website')) : '';
                $request->input('registration-number') != null ? $data['registration-number'] = htmlspecialchars($request->input('registration-number')) : '';
                $request->input('national-id') != null ? $data['national-id'] = htmlspecialchars($request->input('national-id')) : '';
                $request->input('postal-code') != null ? $data['postal-code'] = htmlspecialchars($request->input('postal-code')) : '';
                if(isset($data['user-name'])){
                    $user_name = $data['user-name'];
                    $user = $this->userRepository->getUserByUserName($user_name);
                    if($user){
                        if($user->user_id != Auth::user()->user_id){
                            return redirect()->back()->withErrors('نام کاربری از قبل وجود دارد');
                        }
                    }
                }
                if(Auth::user()->phone != $phone){
                    return redirect()->back()->withErrors('درخواست شما نامعتبر است');
                }
                if($this->userRepository->editCustomerWithMobile($phone , $data)){
                    return redirect()->back()->with(['success' => 'با موفقیت ویرایش شد']);
                }else{
                    return redirect()->back()->withErrors('در ویرایش اطلاعات مشکلی پیش آمده');
                }

            }
        }
    }
}
