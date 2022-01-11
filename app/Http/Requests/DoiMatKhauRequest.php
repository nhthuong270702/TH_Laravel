<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoiMatKhauRequest extends FormRequest
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
            'password' => 'required',
            'newpassword' => 'required|same:confirm_newpassword|min:8',
            'confirm_newpassword' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => 'Vui lòng điền vào trường mật khẩu hiện tại',
            'newpassword.required' => 'Vui lòng điền vào trường mật khẩu mới',
            'confirm_newpassword.required' => 'Vui lòng điền vào trường xác nhận mật khẩu mới',
            'newpassword.same' => "Nhập lại mật khẩu không trùng khớp",
            'newpassword.min' => "Mật khẩu tối thiểu 8 kí tự",
        ];
    }
}