<?php

namespace App\Http\Requests\CheckOut;

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
        return [
            'name' => 'required',
            'phone' => 'required',
            'address'=>'required',
            'email' => 'required',
            'type'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người nhận !',
            'phone.required' => 'Vui lòng nhập số điện thoại !',
            'address.required' => 'Vui lòng nhập địa chỉ nhận hàng !',
            'email.required' => 'Vui lòng nhập email !',
            'type.required'=>'Vui lòng chọn hình thức vận chuyển '

        ];
    }
}
