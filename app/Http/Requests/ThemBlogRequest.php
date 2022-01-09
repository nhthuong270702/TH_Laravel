<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemBlogRequest extends FormRequest
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
            'user_id' => 'required',
            'tieude' => 'required|string',
            'noidung' => 'required|string',
            'anh' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'ngaydang' => 'required|string',
            'sobinhluan' => 'string',
        ];
    }
    public function attributes()
    {
        return [
            'tieude' => 'Tiêu đề',
            'noidung' => 'Nội dung',
            'anh' => 'Ảnh',
            'ngaydang' => 'Ngày Đăng',
            'sobinhluan' => 'Số Bình Luận'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Vui lòng điền đầy đủ thông tin vào trường :attribute',
            'anh.image' => 'File được chọn không phải là ảnh',
            'anh.mimes' => 'Định dạng ảnh phải là: jpeg, png, jpg, gif, svg'
        ];
    }
}