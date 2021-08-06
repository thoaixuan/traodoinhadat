<?php
namespace App\Repositories\Auth;

use App\Repositories\EloquentRepository;
use Auth;
use App\User;
use App\Models\Users;
class AuthRepositories extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }
    public function _checkLogin($phone,$pass)
    {
        $fieldType = filter_var($phone, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $data = ['email'=>$phone,'password'=>$pass];
        if($fieldType=='phone'){
                    $data = ['phone'=>$phone,'password'=>$pass];
        }
        if (Auth::attempt($data)) {
            return true;
        }else{
            return false;
        }
    }
    public function _register($data)
    {
        $users = new Users();
        $users->loai_hinh_thuc_bds = $data->loai_hinh_thuc_bds;
        $users->full_name = $data->full_name;
        $users->email = $data->email;
        $users->phone = $data->phone;
        if(!empty($data->password)){
            $users->password = bcrypt($data->password);
        }else{
            $users->password = bcrypt("123456");
        }
        $result = $users->save();
        if($result) return true;
        return false;
    }
}
