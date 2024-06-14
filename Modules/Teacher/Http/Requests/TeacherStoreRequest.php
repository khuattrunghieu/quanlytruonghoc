<?php

namespace Modules\Teacher\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends ApiRequest
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
            'email' => [
                'required',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
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
                'unique:users,phone'
            ]
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Họ và tên không được để trống',
            'email.required'=> 'Email không để trống',
            'email.unique' => 'Email đã đăng ký tài khoản, vui lòng xử dụng email khác',
            'password.required'=>'Mật khẩu không để trống',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp với mật khẩu',
            'birthday.required' => 'Vui lòng nhập ngày tháng năm sinh của bạn',
            'address.required' => 'Vui lòng nhập địa chỉ hiện tại của bạn',
            'phone.required' => 'Vui lòng nhập số điện thoại liên hệ của bạn',
            'phone.min' => 'Số điện thoại quá ngắn, vui lòng nhập lại',
            'phone.max' => 'Số điện thoại quá dài, vui lòng nhập lại',
            'phone.unique' => 'Số điện thoại đã được đăng ký tài khoản, vui lòng lấy số điện thoại khác'
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
