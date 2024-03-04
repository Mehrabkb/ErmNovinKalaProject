<?php

namespace App\Interfaces;

use App\Models\User;

interface  UserRepositoryInterface{
    public function checkUserExistByUserName($userName);
    public function getUserByUserName($userName);

}
