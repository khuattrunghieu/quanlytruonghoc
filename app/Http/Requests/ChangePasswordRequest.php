<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'email' => [
                'required',
            ],
            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email không để trống',
            'password.required' => 'Mật khẩu không để trống',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.confirmed' => 'Nhập lại mật khẩu không khớp với mật khẩu',
        ];
    }
}
