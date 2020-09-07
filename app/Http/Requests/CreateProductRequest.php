<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|min:5:unique:products',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn chưa nhập :attribute',
            'min' => ':attribute Phải có ít nhất 5 kí tự'
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm'
        ];
    }
}
