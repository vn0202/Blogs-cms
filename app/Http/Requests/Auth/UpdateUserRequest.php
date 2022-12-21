<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
            'fullname'=>['required','min:12','max:60','regex:/[^\d]+/'],
            'username'=>['required',Rule::unique('users','name')->ignore(Auth::id()),'min:6','max:32'],
            'email'=>['required','email',Rule::unique('users')->ignore(Auth::id())],
            'password'=>['required',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
            'password_confirmation' => 'same:password',
            'avatar'=>['nullable',File::image()->max(20*1024)]
        ];
    }
    public function messages()
    {
        return [
            'avatar.image'=>"Chỉ hỗ trợ định dạng file image",
            'avatar.max'=>"Kích thước file của bạn quá lớn",
            'password_confirmation.same'=>"Mật khẩu xác thực của bạn không khớp",
            '*.required'=>"Bạn chưa nhập :attribute",
            '*.min'=>":attribute tối thiểu :min ký tự",
            '*.max' =>":attribute tối đa :max ký tự",
            '*.unique'=>":attribute đã tồn tại ",
            "email.email"=>"email không đúng đinh dạng ",
            'password_confirmation'=>"Xác nhận mật khẩu không đúng",
        ];
    }
}
