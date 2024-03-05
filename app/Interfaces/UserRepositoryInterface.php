<?php

namespace App\Interfaces;

use App\Models\User;

interface  UserRepositoryInterface{
    public function checkUserExistByUserName($userName);
    public function getUserByUserName($userName);
    public function checkUserPasswordByUserName($userName , $password);
    public function getUserIdByUserName($userName);
    public function loginUserById($user_id);
    public function logoutUserById($user_id);

}
