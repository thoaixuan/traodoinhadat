<?php

namespace App\Http\Requests\Admin\Area;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class actionRequest extends FormRequest
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
        $rules['name']='required|max:199';
        if($this->type=='district'){
            $rules['provinceID']='required|max:199';
        }
        if($this->type=='ward'){
            $rules['provinceID']='required|max:199';
            $rules['districtID']='required|max:199';
        }
        return $rules;
    }
    public function messages()
    {
        $messages =  array();
        if($this->type=='province'){
            $messages['provinceID.required']="Vui lòng chọn tỉnh thành !";
        }
        if($this->type=='district'){
            $messages['provinceID.required']="Vui lòng chọn tỉnh thành !";
        }
        if($this->type=='ward'){
            $messages['provinceID.required']="Vui lòng chọn tỉnh thành !";
            $messages['districtID.required']="Vui lòng chọn quận huyện !";
        }
        $messages['name.required']="Không được trống !";
        $messages['name.max']="Không quá :max ký tự !";
        // dd($messages);
        return  $messages;
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
