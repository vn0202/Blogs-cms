<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PostRequest extends FormRequest
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
            'title' => ['required'],
            'category' => ['required'],
            'description' => ['required'],
            'content' => ['required'],
            'thumb'=>['required',File::image()->max(20*1024)]

        ];
    }

    public function messages()
    {
        return [
            'title.required' => "Bạn chưa đặt tiêu đề bài viêt ",
            'category.required' => "Bạn chưa chọn danh mục bài viết ",
            'description.required' => "Bạn cần nhập mô tả bài viết",
            'content.required' => "Bạn cần nhập nội dung bài viết",
            'thumb.image'=>"Chỉ hỗ trợ định dạng ảnh",
            'thumb.max'=>"Kích thước file của bạn quá lớn",
            'thumb.required'=>"Bạn chưa chọn ảnh bài viết",
        ];
    }
}
