<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['required'],
            'content' => ['required'],
            'thumb' => ['nullable', 'image'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => "Bạn cần cung cấp tiêu đề bài viết",
            'description.required' => "Bạn chưa có mô tả bài viết",
            'content.requried' => "Bạn chưa có nội dung bài viết",
            'thumb.image' => "Chỉ hỗ trợ định dạng hình ảnh",
        ];
    }
}
