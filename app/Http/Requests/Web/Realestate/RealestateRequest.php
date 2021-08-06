<?php

namespace App\Http\Requests\Web\Realestate;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
class RealestateRequest extends FormRequest
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
            'name_agent'=>'required',
            'phone_agent'=>'required|max:15',
            'email_agent'=>'email|max:50',

            'provinceID'=>'required',
            'house_number'=>'required|max:5',
            'house_address'=>'required|max:150',
            'realestate_mota'=>'required|max:300',
        ];
        if($this->chinh_chu=='0'&&$this->loai_hinh_thuc_bds=='moi_gioi'){
             $data['chu_nha_full_name']='required|max:30';
             $data['chu_nha_phone']='required|max:15';
             $data['chu_nha_email']='email|max:50';
        }
        if($this->cate_type=='cate_sell'){
            $data['realestate_price']='required|max:15';
        }else{
            $data['realestate_price']='required|max:15';
            $data['realestate_price_rent']='max:15';
        }
        return $data;
    }
    public function messages()
    {
        $data =  [
            'name_agent.required'=>"Vui lòng nhập tên chính chủ !",
            'phone_agent.required'=>"Vui lòng nhập số điện thoại chính chủ !",
            'phone_agent.max'=>"Số điện thoại chính chủ không được quá :max ký tự",
            'email_agent.email'=>"Email chính chủ không hợp lệ !",
            'email_agent.max'=>"Email chính chủ không được quá :max ký tự",

            'chu_nha_full_name.required'=>"Vui lòng nhập tên chủ nhà !",
            'chu_nha_phone.required'=>"Vui lòng nhập số điện thoại chủ nhà !",
            'chu_nha_phone.max'=>"Số điện thoại chủ nhà không được quá :max ký tự",
            'chu_nha_email.email'=>"Email chủ nhà không hợp lệ !",
            'chu_nha_email.max'=>"Email chủ nhà không được quá :max ký tự",

            'realestate_price.max'=>"Giá tiền không được quá :max ký tự",

            'provinceID.required'=>"Vui lòng nhập tỉnh thành !",

            'house_number.required'=>"Vui lòng nhập số nhà !",
            'house_number.max'=>"Số nhà không quá :max ký tự !",

            'house_address.required'=>"Vui lòng nhập địa chỉ !",
            'house_address.max'=>"Địa chỉ  không quá :max ký tự !",


            'realestate_mota.required'=>"Vui lòng nhập mô tả !",
            'realestate_mota.max'=>"Mô tả  không quá :max ký tự !",

        ];
        if($this->cate_type=='cate_buy'){
            $data['realestate_price.required'] = "Vui lòng nhập giá tiền đề nghị !";
            $data['realestate_price.max'] = "Giá tiền đề nghị không được quá :max ký tự !";
        }else{
            $data['realestate_price.required'] = "Vui lòng nhập giá tiền cho thuê !";
            $data['realestate_price.max'] = "Giá tiền tiền thuê không được quá :max ký tự !";
            $data['realestate_price_rent.max'] = "Giá tiền tiền thuê không được quá :max ký tự !";
        }
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
