<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class customerAuthenticateController extends Controller
{
    public function __construct(UserRepository $userRepository){
        $this->middleware('checkCustomerLoginRoute');
        $this->userRepository = $userRepository;
    }
    public function login(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.authenticate.login');
        }else if($request->isMethod('POST')){
            $validate = $request->validate([
                'user-name' => 'required',
                'password' => 'required'
            ],[
                'user-name.required' => 'نام کاربری نمیتواند خالی باشد',
                'password.required' => 'رمز عبور نمیتواند خالی باشد'
            ]);
            if($validate){
                $userName = htmlspecialchars($request->input('user-name'));
                $password = htmlspecialchars($request->input('password'));
                $user = $this->userRepository->getUserByUserName($userName);
                if($user){
                    if($user->user_role_id == 3){
                        if($this->userRepository->checkUserPasswordByUserName($userName, $password)){
                            $this->userRepository->loginUserById($user->user_id);
                            return redirect()->route('customer.panel.home');
                        }else{
                            return redirect()->back()->withErrors('نام کاربری یا رمز عبور اشتباه است');
                        }
                    }else{
                        return redirect()->back()->withErrors('کاربر مجوز ورود ندارد');
                    }
                }else{
                    return redirect()->back()->withErrors('کاربری با این مشخصات یافت نشد');
                }
            }
        }
    }
}
