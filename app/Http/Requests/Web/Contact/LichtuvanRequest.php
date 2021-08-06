<?php

namespace App\Http\Requests\Web\Contact;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class LichtuvanRequest extends FormRequest
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
            'full_name'=>'required|max:30',
            'email'=>'required|email|max:50',
            'phone'=>'required|max:15',
            'date'=>'required|max:10',
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>"Không được trống !",
            'email.email'=>"Email không hợp lệ !",
            'email.max'=>"Không quá :max ký tự !",
            'full_name.required'=>"Không được trống !",
            'full_name.max'=>"Không quá :max ký tự !",
            'phone.required'=>"Không được trống !",
            'phone.max'=>"Không quá :max ký tự !",
            // 'phone.numeric'=>"Không hợp lệ !",
            'date.required'=>"Không được trống !",
            'date.max'=>"Không quá :max ký tự !",
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
