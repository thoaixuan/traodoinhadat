<?php

namespace App\Http\Requests\Web\Register;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class RegisterRequest extends FormRequest
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
    {
        return [
            'email'=>'required|max:50|unique:users,email',
            'phone'=>'required|max:15|unique:users,phone',
            'full_name'=>'required|max:30',
            'password'=>'required|min:6|max:30',
        ];

    }
    public function messages()
    {
        return [
            'email.required'=>"Không được trống !",
            'email.unique'=>"Email đã được sử dụng !",
            'email.max'=>"Không quá :max ký tự !",

            'phone.required'=>"Không được trống !",
            'phone.unique'=>"Số điện thoại đã được sử dụng !",
            'phone.max'=>"Không quá :max ký tự !",
            // 'phone.numeric'=>"Không hợp lệ !",

            'full_name.required'=>"Không được trống !",
            'full_name.max'=>"Không quá :max ký tự !",
            'password.required'=>"Không được trống !",
            'password.min'=>"Phải lớn hơn :min ký tự !",
            'password.max'=>"Không quá :max ký tự !",
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
