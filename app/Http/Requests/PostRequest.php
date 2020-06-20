<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'category_id' => ['bail', 'required', 'integer', 'exists:categories,id'],
            'name' => ['bail', 'required', 'string', 'min:4', 'max:255'],
        ];
    }
}
