<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'numeric', 'min:1'],
            'name' => ['nullable', 'alpha_num', 'min:3'],
            'email' => ['nullable', 'min:3'],
            'status' => ['nullable', Rule::in([User::STATUS_ACTIVE, User::STATUS_WAIT])],
            'role' => ['nullable', Rule::in([User::ROLE_USER, User::ROLE_ADMIN])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
