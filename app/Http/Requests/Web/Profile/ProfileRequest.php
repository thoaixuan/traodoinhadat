<?php

namespace App\Http\Requests\Web\Profile;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class ProfileRequest extends FormRequest
{
/**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize()
    {

        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {   $user = \App\User::find(user()->id);
        $rules = [
            'full_name'=>'required|max:30',
            'birthday'=>'required|max:10',
            'address'=>'required|max:191',
            'about'=>'max:300',
        ];
        if($this->email!=""&&$this->phone==""){
            $rules['email']='required|email|max:50|unique:users,email,'.$user->id;
        }else if($this->email==""&&$this->phone!=""){
            $rules['phone']='required|max:15|unique:users,phone,'.$user->id;
        }else{
            $rules['email']='required|email|max:50|unique:users,email,'.$user->id;
            $rules['phone']='required|max:15|unique:users,phone,'.$user->id;
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'phone.required'=>"Không được trống !",
            'phone.unique'=>"Số ĐT đã được sử dụng !",
            'phone.max'=>"Không quá :max ký tự !",
            'email.required'=>"Không được trống !",
            'email.email'=>"Email không hợp lệ !",
            'email.unique'=>"Email đã được sử dụng !",
            'email.max'=>"Không quá :max ký tự !",
            'full_name.required'=>"Không được trống !",
            'full_name.max'=>"Không quá :max ký tự !",
            'birthday.required'=>"Không được trống !",
            'birthday.max'=>"Không quá :max ký tự !",
            'address.required'=>"Không được trống !",
            'address.max'=>"Không quá :max ký tự !",
            'about.max'=>"Không quá :max ký tự !",
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
