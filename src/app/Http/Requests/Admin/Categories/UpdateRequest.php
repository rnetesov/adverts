<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'slug' => ['nullable', Rule::unique('categories')->ignore($this->category->id)],
            'parent' => ['nullable', 'numeric', Rule::exists('categories', 'id')]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
