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
    public function getAllUsersWithUserRoleName();
    public function getAllUserRoles();
    public function createUser($data);
    public function deleteUserByUserId($userId);
    public function getUserDataByUserId($userId);
    public function editUserByUserId($userId , $data);
    public function createVerificationCode($user_id);
    public function getUserByMobile($mobile);
    public function checkUserCodeByMobile($mobile , $code);
    public function editCustomerWithMobile($mobile , $data);
}
