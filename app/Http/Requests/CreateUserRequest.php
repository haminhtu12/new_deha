<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name'=>'required|min:5',
            'phone'=>'required|min:5',
            'email'=>'required|unique:users|min:5',
            'address'=>'required|min:5',
            'password'=>'required|min:6',
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
