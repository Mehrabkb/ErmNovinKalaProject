<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\alertifyRepository;
use App\Repositories\smsRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class customerAuthenticateController extends Controller
{
    public function __construct(UserRepository $userRepository , smsRepository $smsRepository ,
        alertifyRepository $alertifyRepository){
        $this->middleware('checkCustomerLoginRoute');
        $this->userRepository = $userRepository;
        $this->smsRepository = $smsRepository;
        $this->alertifyRepository = $alertifyRepository;
    }
    public function login(Request $request){
        if($request->isMethod('GET')){
            return view('customerPanel.authenticate.login');
        }else if($request->isMethod('POST')){
            $validate = $request->validate([
                'mobile' => 'required',
                'code' => 'required'
            ],[
                'mobile.required' => 'شماره موبایل نمیتواند خالی باشد',
                'code.required' => 'کد اعتبارسنجی نمیتواند خالی باشد'
            ]);
            if($validate){
                $mobile = htmlspecialchars($request->input('mobile'));
                $code = htmlspecialchars($request->input('code'));
                $user = $this->userRepository->getUserByMobile($mobile);
                if($user){
                    if($user->user_role_id == 3){
                        if($this->userRepository->checkUserCodeByMobile($mobile, $code)){
                            $this->userRepository->loginUserById($user->user_id);
                            return redirect()->route('customer.panel.home');
                        }else{
                            return redirect()->back()->withErrors('نام کاربری یا رمز عبور اشتباه است');
                        }
                    }else{
                        return redirect()->back()->withErrors('کاربر مجوز ورود ندارد');
                    }
                }else{


                }
            }
        }
    }
    public function verifyCode(Request $request){
        if($request->isMethod('POST')){
            $validate = $request->validate([
                'mobile' => 'required|regex:/[0]{1}[0-9]{10}/'
            ],[
                'mobile.required' => 'موبایل الزامی می باشد',
                'mobile.regex' => 'موبایل معتبر نمی باشد'
            ]);
            if($validate){
                $mobile = htmlspecialchars($request->input('mobile'));
                $user = $this->userRepository->getUserByMobile($mobile);
                if($user){
                    $code = $this->userRepository->createVerificationCode($user->user_id);
                    if($this->smsRepository->sendOtpSms($mobile , $code)){
                        return $this->alertifyRepository->successMessage('کد فعالسازی با موفقیت ارسال شد');
                    }else{
                        return $this->alertifyRepository->errorMessage('در ارسال کد فعالسازی مشکلی پیش آمده است');
                    }
                }else{
                    $data = [];
                    $number = rand(1 , 10000) + Carbon::now()->timestamp;
                    $data['user-name'] = 'user'. $number;
                    $data['password'] = '12345';
                    $data['user-role'] = 3 ;
                    $data['phone'] = $mobile;
                    $newUser = $this->userRepository->createUser($data);
                    $code = $this->userRepository->createVerificationCode($user->user_id);
                    $currentUser = $this->userRepository->getUserByMobile($mobile);
                    if($this->userRepository->checkUserCodeByMobile($mobile, $code)){
                        $this->userRepository->loginUserById($currentUser->user_id);
                        return redirect()->route('customer.panel.home');
                    }else{
                        return redirect()->back()->withErrors('کد فعالسازی اشتباه است');
                    }
                }
            }
        }
    }
}
