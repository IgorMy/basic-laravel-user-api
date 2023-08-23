<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'UsersUlid' => 'ulid',
            'user_name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email',
            'password' => 'string|min:8',
            'RoleUlid' => 'ulid|exists:role,RoleUlid'
        ];
    }
}
