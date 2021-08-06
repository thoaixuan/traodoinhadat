<?php

namespace App\Http\Requests\Admin\Realestate;

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

        $rules = [
            'provinceID'=>'required',

            'cate_type'=>'required',
            'realestate_title'=>'required|max:300',
            'realestate_status'=>'required',
            'realestate_price'=>'required|max:30',

            'realestate_nha_huong'=>'max:30',
            'realestate_nha_phongngu'=>'max:30',
            'realestate_nha_phongtam'=>'max:30',
            'realestate_nha_tan'=>'max:30',
            'realestate_nha_giayto'=>'max:30',
            'realestate_nha_chieudai'=>'max:30',
            'realestate_nha_chieurong'=>'max:30',
            'realestate_nha_hem'=>'max:30',

            'realestate_dat_dientich'=>'max:30',
            'realestate_dat_giayto'=>'max:30',
        ];
        $rules['send_chu_nha_full_name']='max:30';
        $rules['send_chu_nha_phone']='max:15';
        if($this->send_chu_nha_email){
            $rules['send_chu_nha_email']='email|max:50';
        }
        if($this->cate_type!='cate_project'){
            $rules['category_id']='required';
        }
        return  $rules;



    }
    public function messages()
    {
        return [
            'provinceID.required'=>"Vui lòng chọn tỉnh thành !",

            'category_id.required'=>"Chọn Lọai bất động sản !",
            'cate_type.required'=>"Chọn Loại hình giao dịch !",

            'realestate_title.required'=>"Tiêu đê Không được để trống !",
            'realestate_title.max'=>"Tiêu đê Không quá :max ký tự !",

            'realestate_status.required'=>"Vui lòng chọn trạng thái !",

            'realestate_price.required'=>"Vui lòng nhập giá tiền !",
            'realestate_price.max'=>"Giá tiền Không quá :max ký tự !",

            'realestate_nha_huong.max'=>"Hướng Không quá :max ký tự !",
            'realestate_nha_phongngu.max'=>"Phòng ngủ Không quá :max ký tự !",
            'realestate_nha_phongtam.max'=>"Phòng tắm Không quá :max ký tự !",
            'realestate_nha_tan.max'=>"Tần Không quá :max ký tự !",
            'realestate_nha_giayto.max'=>"Giấy tờ Không quá :max ký tự !",
            'realestate_nha_chieudai.max'=>"Chiều dài Không quá :max ký tự !",
            'realestate_nha_chieurong.max'=>"Chiều rộng Không quá :max ký tự !",
            'realestate_nha_hem.max'=>"Hẻm Không quá :max ký tự !",
            'realestate_dat_dientich.max'=>"Diễn tích Không quá :max ký tự !",

            'send_chu_nha_full_name.max'=>"Tên chủ nhà không được quá :max ký tự",
            'send_chu_nha_phone.max'=>"Số điện thoại chủ nhà không được quá :max ký tự",
            'send_chu_nha_email.email'=>"Email chủ nhà không hợp lệ !",
            'send_chu_nha_email.max'=>"Email chủ nhà không được quá :max ký tự",
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
