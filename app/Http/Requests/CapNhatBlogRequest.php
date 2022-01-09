<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatBlogRequest extends FormRequest
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
            'user_id' => '',
            'tieude' => '',
            'noidung' => '',
            'anh' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'ngaydang' => '',
            'sobinhluan' => '',
        ];
    }
    public function messages()
    {
        return [
            'anh.image' => 'File được chọn không phải là ảnh',
            'anh.mimes' => 'Định dạng ảnh phải là: jpeg, png, jpg, gif, svg'
        ];
    }
}