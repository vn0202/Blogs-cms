<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'title'=>['required',Rule::unique('categories')->ignore(request()->id)],
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'Bạn không được để trống danh mục này',
            'title.unique'=>"Danh mục này đã tồn tại"
        ];
    }
}
