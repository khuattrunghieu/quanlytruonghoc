<?php

namespace Modules\Teacher\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required'
            ],
            'birthday' => [
                'required'
            ],
            'address' => [
                'required'
            ],
            'phone' => [
                'required',
                'min:8',
                'max:12',
            ]
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Họ và tên không được để trống',
            'birthday.required' => 'Vui lòng nhập ngày tháng năm sinh của bạn',
            'address.required' => 'Vui lòng nhập địa chỉ hiện tại của bạn',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ của bạn',
            'phone.min' => 'Số điện thoại quá ngắn, vui lòng nhập lại',
            'phone.max' => 'Số điện thoại quá dài, vui lòng nhập lại',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
