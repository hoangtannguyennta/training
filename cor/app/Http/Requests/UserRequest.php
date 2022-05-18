<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->request->get('password') != NULL){
            return [
                'name' => 'required|min:3|max:50',
                'email' => 'required|string|email|max:255|unique:users,email,'.$this->id, 'id',
                'password' => 'required|string|confirmed|min:6',
            ];
        }else {
            return [
                'name' => 'required|min:3|max:50',
                'email' => 'required|string|email|max:255|unique:users,email,'.$this->id, 'id',
            ];
        }

    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên!',
            'name.min' => 'Vui lòng nhập tên không ít hơn 3 ký tự!',
            'name.max' => 'Vui lòng nhập tên không quá hơn 50 ký tự!',
            'password.required' => 'Vui lòng nhập mật khẩu!',
            'password.confirmed' => 'Mật khẩu không khớp !',
            'password.min' => 'Vui lòng nhập mật khẩu ít hơn 6 ký tự!',
            'email.string' => 'Email phải là một chuỗi!',
            'email.unique' => 'Email đã tồn tại!',
            'email.required' => 'Vui lòng nhập email',
        ];
    }
}
