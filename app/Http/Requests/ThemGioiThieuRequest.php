<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemGioiThieuRequest extends FormRequest
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
            'tieude' => 'required',
            'noidung' => 'required',
            'tieuchi1' => 'required',
            'tieuchi2' => 'required',
            'tieuchi3' => 'required',
            'anh' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
    public function messages()
    {
        return [
            'tieude.required' => "Vui lòng điền vào trường Tiêu Đề",
            'noidung.required' => "Vui lòng điền vào trường Nội Dung",
            'tieuchi1.required' => "Vui lòng điền vào trường Tiêu Chí 1",
            'tieuchi2.required' => "Vui lòng điền vào trường Tiêu Chí 2",
            'tieuchi3.required' => "Vui lòng điền vào trường Tiêu Chí 3",
            'anh.required' => "Vui lòng điền vào trường Ảnh",
            'anh.image' => 'File được chọn không phải là ảnh',
            'anh.mimes' => 'Định dạng ảnh phải là: jpeg, png, jpg, gif, svg'
        ];
    }
}