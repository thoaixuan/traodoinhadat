<?php

namespace App\Http\Requests\Web\Realestate;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class TransRequest extends FormRequest
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
        $data =  [
            
            'provinceID'=>'required',
            'realestate_mota'=>'required|max:300',
        ];
       
        if($this->cate_type=='trao_doi'){
            return $data;
        }
        return $data;
    }
    public function messages()
    {
        $data =  [
            'provinceID.required'=>"Vui lòng nhập tỉnh thành !",
            'realestate_mota.required'=>"Vui lòng nhập mô tả !",
            'realestate_mota.max'=>"Mô tả  không quá :max ký tự !",
        ];
        // dd($data);
        return $data;
    }
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ],JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
