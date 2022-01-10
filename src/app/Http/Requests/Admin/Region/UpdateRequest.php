<?php

namespace App\Http\Requests\Admin\Region;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:150', Rule::unique('regions', 'name')
                ->where('parent_id', $this->region->parent_id)
                ->ignore($this->region->id)
            ],
            'slug' => ['nullable', 'string', 'min:3', 'max:150', Rule::unique('regions', 'slug')
                ->where('parent_id', $this->region->parent_id)
                ->ignore($this->region->id)
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
