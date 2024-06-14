<?php

namespace Modules\Classes\Http\Requests;

use App\Http\Requests\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class ClassUpdateRequest extends ApiRequest
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
            ],
            'school' => [
                'required',
            ],
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Tên không để trống',
            'school.required'=>'Vui lòng chọn trường học',
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
