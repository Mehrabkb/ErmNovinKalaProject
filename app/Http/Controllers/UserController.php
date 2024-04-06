<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\alertifyRepository;
use App\Repositories\smsRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Ramsey\Uuid\Type\Integer;
use function GuzzleHttp\default_user_agent;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository , alertifyRepository $alertifyRepository )
    {
        $this->middleware('checkUserLoginUserRoute');
        $this->alertifyRepository = $alertifyRepository;
        $this->userRepository = $userRepository;
    }

    public function login(Request $request){
        $method = $request->method();
        switch ($method){
            case 'GET':
                return view('panel/authenticate/login');
                break;
            case 'POST':
                $validationData = $request->validate([
                    'captcha' => 'required|captcha' .\request('key'),
                    'user-name' => 'required | max:255 | regex:/[a-zA-Z0-9]+$/',
                    'password' => 'required | max:255 | regex:/[a-zA-Z0-9]+$/'
                ],
                [
                    'captcha.required' => 'مقدار کپچا الزامی میباشد',
                    'captcha.captcha' => 'لطفا مقدار کپچا را با دقت وارد کنید',
                    'user-name.required' => 'نام کاربری الزامی می باشد' ,
                    'user-name.regex' => 'فرمت نام کاربری نامعتبر است',
                    'password.required' => 'رمز عبور الزامی می باشد',
                    'password.regex' => 'فرمت رمز عبور نامعتبر اس'
                ]);
                if($validationData){
                    $userName = htmlspecialchars($request->input('user-name'));
                    $password = htmlspecialchars($request->input('password'));
                    if($this->userRepository->checkUserExistByUserName($userName)) {
                        if($this->userRepository->checkUserPasswordByUserName($userName , $password)){
                                $user_id = $this->userRepository->getUserIdByUserName($userName);
                                if($this->userRepository->loginUserById($user_id)){
                                    return $this->alertifyRepository->successMessage('با موفقیت وارد شدید');
                                }else{
                                    return $this->alertifyRepository->errorMessage('مشکلی در ورود شما رخ داده است');
                                }
                        }else{
                            return $this->alertifyRepository->errorMessage('رمز وارد شده صحیح نمی باشد');
                        }
                    }
                    return $this->alertifyRepository->errorMessage('کاربری با این مشخصات یافت نشد');
                }
        }
    }
}
