<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PubRequest extends FormRequest
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
            'product_name' => 'required|min:2|max:50',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Vui lòng nhập tên!',
            'product_name.min' => 'Vui lòng nhập tên không ít hơn 2 ký tự!',
            'product_name.max' => 'Vui lòng nhập tên không quá hơn 50 ký tự!',
            'amount.required' => 'Vui lòng nhập số lượng!',
            'amount.required' => 'Vui lòng nhập chữ số!',
            'price.required' => 'Vui lòng nhập giá!',
            'price.required' => 'Vui lòng nhập chữ số!',
        ];
    }
}
