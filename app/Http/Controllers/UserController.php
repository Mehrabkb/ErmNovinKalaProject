<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\alertifyRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function GuzzleHttp\default_user_agent;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository , alertifyRepository $alertifyRepository)
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
                    'user-name' => 'required | max:255 | regex:/[a-zA-Z0-9]+$/',
                    'password' => 'required | max:255 | regex:/[a-zA-Z0-9]+$/'
                ],
                [
                    'user-name.required' => 'نام کاربری الزامی می باشد' ,
                    'user-name.regex' => 'فرمت نام کاربری نامعتبر است',
                    'password.required' => 'رمز عبور الزامی می باشد',
                    'password.regex' => 'فرمت رمز عبور نامعتبر اس'
                ]);
                if($validationData){
                    $userName = htmlspecialchars($request->input('user-name'));
                    $password = htmlspecialchars($request->input('password'));
                    if($this->userRepository->checkUserExistByUserName($userName)) {
                        return $this->alertifyRepository->successMessage('کاربر پیدا شد ');
                    }
                    return $this->alertifyRepository->errorMessage('کاربری با این مشخصات یافت نشد');
                }
        }

    }
}
