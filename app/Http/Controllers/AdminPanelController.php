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
                return view('panel/product/unit');
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
                return view('panel/product/category');
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
