<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThemSanPhamRequest extends FormRequest
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
            'ten' => 'required',
            'mota' => 'required',
            'gia' => 'required',
            'soluongban' => 'required',
            'ngaydang' => 'required',
            'id_danh_muc' => 'required',
            'anh' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function attributes()
    {
        return [
            'ten' => "Tên Sản Phẩm",
            'mota' => "Mô Tả",
            'gia' => "Giá Bán",
            'soluongban' => "Số Lượng",
            'ngaydang' => "Ngày Đăng",
            'id_danh_muc' => "Danh Mục",
            'anh' => 'Ảnh',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Vui lòng điền vào trường :attribute',
            'anh.image' => 'File được chọn không phải là ảnh',
            'anh.mimes' => 'Định dạng ảnh phải là: jpeg, png, jpg, gif, svg'
        ];
    }
}