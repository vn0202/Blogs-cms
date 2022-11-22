<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function prepareForValidation()
    {
    }
    public function withValidator($validator)
    {


}


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
            'fullname'=>'required|min:10',
            'username'=>'alpha_num|size:5',
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => ':attribute khong duoc de trong ',
            'username.required'=>':attribute khong duoc de trong ',


        ];
    }
    public function  attributes()
    {
        return [
            'fullname'=>'Ho va ten ',
            'username'=>"Ten dang nhap "
        ]; // TODO: Change the autogenerated stub
    }
}
