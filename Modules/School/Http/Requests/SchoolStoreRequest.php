<?php

namespace Modules\School\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class SchoolStoreRequest extends ApiRequest
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
                'required',
                'unique:schools',
                'max:100',
                'min:5',
            ],
            'address' => [
                'required',
                'min:15',
            ]
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Tên không để trống',
            'name.unique'=>'Tên trùng',
            'name.max'=>'Tên quá dài',
            'name.min'=>'Tên quá ngắn',
            'address.required'=>'Địa chỉ hông để trống',
            'address.min'=>'Địa chỉ quá ngắn',
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
