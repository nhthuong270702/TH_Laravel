<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapNhatGioiThieuRequest extends FormRequest
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
            'tieude' => '',
            'noidung' => '',
            'tieuchi1' => '',
            'tieuchi2' => '',
            'tieuchi3' => '',
            'anh' => 'image|mimes:jpeg,png,jpg,gif,svg',
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