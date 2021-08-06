<?php

namespace App\Http\Requests\Web\Home;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class subscribeRequest extends FormRequest
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
            'email'=>'required|max:50|unique:subscribe,email',
        ];

    }
    public function messages()
    {
        return [
            'email.required'=>"Không được trống !",
            'email.email'=>"Email không hợp lệ !",
            'email.max'=>"Không quá :max ký tự !",
            'email.unique'=>"Email đã đăng ký rồi !",
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
