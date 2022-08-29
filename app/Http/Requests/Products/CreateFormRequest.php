<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'cate_id'=>'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập thông tin tên sản phẩm',
            'cate_id.required'=>'vui lòng chọn danh mục cho sản phẩm'
        ];
    }
}
