<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 */
class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users')->ignore($this->user->id)],
            'role' => ['required', Rule::in([User::ROLE_USER, User::ROLE_ADMIN])]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
