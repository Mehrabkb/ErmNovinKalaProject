<?php

namespace App\Http\Controllers;

use App\Repositories\alertifyRepository;
use App\Repositories\productRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelController extends Controller
{
    public function __construct(UserRepository $userRepository , productRepository $productRepository , alertifyRepository $alertifyRepository)
    {
        $this->middleware('checkUserLogin');
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->alertifyRepository = $alertifyRepository;
    }

    public function index(Request $request){
        return view('panel/home');
    }
    public function product(Request $request){
        switch ($request->method()){
            case 'GET':
                return view('panel/product/all');
        }
    }
    public function addProduct(Request $request){
        switch($request->method()){
            case 'GET':
                return view('panel/product/add');
        }
    }
    public function unit(Request $request){
        switch($request->method()){
            case 'GET':
                $units = $this->productRepository->getAllUnits();
                return view('panel/product/unit' , compact('units'));
        }
    }
    public function importExport(Request $request){
        switch($request->method()){
            case 'GET':
                return view('panel/product/importExport');
        }
    }
    public function feature(Request $request){
        switch($request->method()){
            case 'GET':
                return view('panel/product/feature');
        }
    }
    public function category(Request $request){
        switch($request->method()){
            case 'GET':

        }
    }
    public function addUnit(Request $request){
        if($request->method() == 'POST'){
            $validate = $request->validate([
                'long-title' => 'required ',
                'short-title' => 'required | regex:/^[a-zA-Z]+$/'
            ],[
                'long-title.required' => 'نام کامل واحد الزامی است',
//                'long-title.regex' => 'نام کامل واحد به صورت صحیح وارد نشده است',
                'short-title.required' => 'علامت واحد الزامی است',
                'short-title.regex' => 'فرمت علامت واحد صحیح نمی باشد'
            ]);
            if($validate){
                $long_title = htmlspecialchars($request->input('long-title'));
                $short_title = htmlspecialchars($request->input('short-title'));
                if($this->productRepository->addUnit($long_title , $short_title)){
                    return $this->alertifyRepository->successMessage('با موفقیت ثبت شد');
                }else{
                    return $this->alertifyRepository->errorMessage('خطایی در ثبت واحد رخ داده است');
                }
            }else{
                return $this->alertifyRepository->errorMessage('لطفا در وارد کردن مقادیر دقت کنید');
            }
        }
    }
    public function logout($id){
        if($this->userRepository->logoutUserById($id)){
            return redirect()->route('login');
        }else{
            return redirect()->back()->withErrors(['msg' => 'در خروج شما از سیستم مشکلی پیش امده است']);
        }
    }
}
