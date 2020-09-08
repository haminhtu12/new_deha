<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'phone' => 'required|min:6',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'address' => 'required|min:3',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn chưa nhập :attribute',
            'min' => ':attribute Phải có ít nhất 5 kí tự',
            'unique' => ':attribute đã tồn tại'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'phone' => 'Sô điện thoại ',
            'email' => 'email',
            'address' => 'địa chỉ',
            'password' => 'mật khẩu',

        ];
    }

}
