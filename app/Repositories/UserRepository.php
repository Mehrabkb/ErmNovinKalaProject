<?php

namespace App\Repositories;



use App\Interfaces\UserRepositoryInterface;
use http\Client\Curl\User;

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
        $user = \App\Models\User::where('user-name' , $userName)->first();
        return $user;
    }
}
