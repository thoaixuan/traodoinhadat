<?php
namespace App\Repositories\Users;

use App\Repositories\EloquentRepository;
use App\Models\Users;
use App\Models\Follows;
use App\User;
use DB;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class UsersRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Users::class;
    }
    public function updateProfile($data)
    {
        $user = Users::find(user()->id);
        $user->username = $data->username;
        if(trim($data->email)!=trim($user->email) ){
            $user->email_verified_token = uniqid().csrf_token().uniqid().user()->id;
            configMail();
            $rs =  _sendMail([
                "template"=>"vendor.mail.changeMail",
                "data"=>['email_verified_token'=>$user->email_verified_token],
                "mailSend"=>[$data->email],
                "subject"=>"Xác nhận email của bạn"
            ]);
            if($rs==true){
                $user->email = $data->email;
            }else{
                return false;
            }
        }
        $user->full_name = $data->full_name;
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        $user->cmnd_number = $data->cmnd_number;
        $user->cmnd_date = $data->cmnd_date;
        $user->cmnd_address = $data->cmnd_address;
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
    public function getUserList($request=null)
    {
        $where = array(
            ['users.type','!=','userAdminDefault']
        );
        if(!empty($request->type)){
            if($request->type=='userAdminCreate'){
                $where[] = ['users.type','=',$request->type];
                if(!empty($request->role)){
                    $where[] = ['users.roleID','=',$request->role];
                }
            }
        }
        if(!empty($request->q)){
            $search = $request->q;
            $result =  Users::leftjoin('roles','roles.id','=','users.roleID')->where($where)
            ->Where(function($query)use($search){
                $query->where('users.id', 'LIKE', "%{$search}%")
                ->orWhere('users.full_name', 'LIKE',"%{$search}%")
                ->orWhere('users.email', 'LIKE',"%{$search}%")
                ->orWhere('users.username', 'LIKE',"%{$search}%")
                ->orWhere('users.phone', 'LIKE',"%{$search}%")
                ->orWhere('users.about', 'LIKE',"%{$search}%")
                ->orWhere('roles.role_name', 'LIKE',"%{$search}%")
                ->orWhere('users.created_at', 'LIKE',"%{$search}%");
            })
            ->select('users.*','roles.role_name')
            ->sortable()
            ->paginate(10);
            return $result;
        }else{

            $result =  Users::leftjoin('roles','roles.id','=','users.roleID')->where($where)
            ->where($where)
            ->select('users.*','roles.role_name')
            ->sortable()
            ->paginate(10);
            return $result;
        }
    }
    public function statusUser($request)
    {
        $result =  Users::find($request->id);

        if($result){
            if($result->type=='userAdminDefault'){
                return false;
            }
            if($result->id==user()->id){
                return false;
            }
            if($result->status==1){
                $result->status = 0;
            }else{
                $result->status = 1;
            }
            if($result->save())return true;
            return false;
        }return false;
    }
    public function deleteUser($request)
    {
        $result =  Users::find($request->id);
        if($result->type=='userAdminDefault'){
            return false;
        }
        if($result->id==user()->id){
            return false;
        }
        if($result->delete()){
            return true;
        }return false;
    }
    public function getUserByID($id)
    {
        $result = Users::where('id','=',$id)->first();
        // dd($result);
        if($result){
            if($result->type=='userAdminDefault'){
                return false;
            }
            if($result->id==user()->id){
                return false;
            }
            return $result;
        }

        return false;
    }
    public function editUser($data)
    {
        $user = Users::find($data->id);
        $user->email = $data->email;
        $user->full_name = $data->full_name;
        $user->roleID = $data->roleID;
        $user->type = $data->type;
        if( $data->type=='userCreate'){
            $data->roleID = null;
        }
        if($data->password!=''){
            $user->password =bcrypt($data->password);
        }
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
    public function addUser($data)
    {
        $user = new Users();
        $user->email = $data->email;
        $user->roleID = $data->roleID;
        $user->type = $data->type;
        if($data->password==''){
            $user->password = bcrypt('123456');
        }else{
            $user->password =$data->password;
        }
        $user->full_name = $data->full_name;
        $user->sex = $data->sex;
        $user->birthday = $data->birthday;
        $user->address = $data->address;
        $user->phone = $data->phone;
        $user->about = $data->about;
        $user->save();
        if($user){
            return true;
        }else{
            return false;
        }
    }
    public function updatePassword($data)
    {
        $result = Users::where('id', '=',Auth::user()->id)->update(['password' => \Hash::make($data->new_password)]);
        if($result) return true;
        return false;
    }
}
