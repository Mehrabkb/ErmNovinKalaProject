<?php

namespace App\Repositories;



use App\Interfaces\UserRepositoryInterface;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function checkUserExistByUserName($userName)
    {
        // TODO: Implement checkUserExistByUserName() method.
        if(\App\Models\User::where('user_name' , $userName)->first()){
            return true;
        }
        return false;
    }

    public function getUserByUserName($userName)
    {
        // TODO: Implement getUserByUserName() method.
        $user = \App\Models\User::where('user_name' , $userName)->first();
        return $user;
    }
    public function checkUserPasswordByUserName($userName, $password)
    {
        // TODO: Implement checkUserPasswordByUserName() method.
        $user = $this->getUserByUserName($userName);
        if(Hash::check( $password  , $user->password )){
            return true;
        }
        return false;
    }
    public function getUserIdByUserName($userName)
    {
        // TODO: Implement getUserIdByUserName() method.
        $user = \App\Models\User::where('user_name' , $userName)->first();
        return $user->user_id;
    }
    public function loginUserById($user_id)
    {
        // TODO: Implement loginUserById() method.
        $user = \App\Models\User::where('user_id' , $user_id)->first();
        Auth::login($user);
        if(Auth::check() && Auth::user()->user_id == $user_id){
            return true;
        }else{
            return false;
        }
    }
    public function logoutUserById($user_id)
    {
        // TODO: Implement logoutUserById() method.
        $user = \App\Models\User::where('user_id' , $user_id)->first();
        if(Auth::logout($user)){
            return true;
        }
        return false;
    }
}
