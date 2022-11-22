<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'fullname'=>['required','min:6','max:60','regex:/[^\d]+/'],
            'username'=>['required','unique:users,name','min:6','max:32'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ],
            'password_confirmation' => 'same:password',
        ];
    }
    public function messages()
    {
        return [
            '*.required'=>"Bạn chưa nhập :attribute",
            '*.min'=>":attribute tối thiểu :min ký tự",
            '*.max' =>":attribute tối đa :max ký tự",
            '*.unique'=>":attribute đã tồn tại ",
            "email.email"=>"email không đúng đinh dạng ",
            'password_confirmation'=>"Xác nhận mật khẩu không đúng",

        ];
    }
    public function attributes()
    {
        return [
            'fullname'=>"Tên đầy đủ",
            'username'=>'Tên đăng nhập',
            'password'=>"Mật khẩu của bạn ",
            'password_confirmation'=> "xác nhận mật khẩu",
        ];
    }
}
