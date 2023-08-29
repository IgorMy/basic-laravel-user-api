<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserSearchRequest extends FormRequest
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
            'email' => 'email',
            'user_name' => 'string',
            'RoleUlid' => 'ulid',
            'skip' => 'required|integer|min:0',
            'take' => 'required|integer|max:100',
        ];
    }
}
