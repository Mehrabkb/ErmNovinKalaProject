<?php

namespace App\Repositories;



use App\Interfaces\UserRepositoryInterface;
use App\Models\User as ModelsUser;
use App\Models\user_role;
use Carbon\Carbon;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function getAllUsersWithUserRoleName(){
        $users =  DB::table('users')
        ->join('user_roles' , 'users.user_role_id' , '=' , 'user_roles.user_role_id')
        ->get();
        return $users;
    }
    public function getAllUserRoles(){
        return user_role::all();
    }
    public function createUser($data){
        $user = new \App\Models\User();
        $user->user_name = $data['user-name'];
        $user->password = Hash::make($data['password']);
        $user->user_role_id = $data['user-role'];
        $user->user_status_id = 1;
        $user->date = Carbon::now()->timestamp;
        isset($data['email']) ? $user->email = $data['email'] : '';
        isset($data['first-name']) ? $user->first_name = $data['first-name'] : '';
        isset($data['last-name']) ? $user->last_name = $data['last-name'] : '';
        isset($data['phone']) ? $user->phone = $data['phone'] : '';
        isset($data['avatar']) ? $user->avatar = $data['avatar'] : '';
        if($user->save()){
            return true;
        }
        return false;
    }
    public function editUserByUserId($userId, $data){
        $user = \App\Models\User::where('user_id' , $userId)->first();
        if($user){
            $user->user_name = $data['user-name'];
            isset($data['password']) ? $user->password = Hash::make($data['password']) : '';
            $user->user_role_id = $data['user-role'];
            $user->user_status_id = 1;
            $user->date = Carbon::now()->timestamp;
            isset($data['first-name']) ? $user->first_name = $data['first-name'] : '';
            isset($data['last-name']) ? $user->last_name = $data['last-name'] : '';
            isset($data['phone']) ? $user->phone = $data['phone'] : '';
            if($user->save()){
                return true;
            }
            return false;
        }
    }
    public function deleteUserByUserId($userId)
    {
        // TODO: Implement deleteUserByUserId() method.
        $user = \App\Models\User::where('user_id' , $userId)->first();
        if($user->delete()){
            return true;
        }
        return false;
    }
    public function getUserDataByUserId($userId)
    {
        // TODO: Implement getUserDataByUserId() method.
        $user = \App\Models\User::where('user_id' , $userId )->first();
        return $user;
    }
    public function createVerificationCode($user_id)
    {
        // TODO: Implement createVerificationCode() method.
        $user = \App\Models\User::where('user_id' , $user_id)->first();
        if($user){
            $code = rand(0 , 9999);
            $user->verification_code = $code;
            $user->save();
            return $user->verification_code;
        }
        return false;
    }
    public function getUserByMobile($mobile)
    {
        // TODO: Implement getUserByMobile() method.
        $user = \App\Models\User::where('phone' , $mobile)->first();
        return $user ? $user : false;
    }
    public function checkUserCodeByMobile($mobile, $code)
    {
        // TODO: Implement checkUserCodeByMobile() method.
        $user = \App\Models\User::where('phone' , $mobile)->first();
        if($user->verification_code == $code){
            return true;
        }
        return false;
    }
}
