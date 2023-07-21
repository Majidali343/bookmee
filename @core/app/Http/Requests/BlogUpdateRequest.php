<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'category_id' => 'required',
            'tag_id' => 'nullable',
            'blog_content' => 'required',
            'tags' => 'nullable',
            'excerpt' => 'nullable',
            'title' => 'required|string|max:191',
            'status' => 'nullable',
            'author' => 'nullable',
            'slug' => 'nullable',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'image' => 'nullable|string|max:191',
        ];
    }
}
