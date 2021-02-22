<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if (Auth::user()->isSysAdmin()) {
            return [
                'name' => ['required'],
                'surname' => ['required', 'min:4'],
                'email' => ['nullable', 'email', 'unique:users,email,' . $this->user_id],
                'organization_id' => ['nullable', 'exists:organizations,id'],
                'role' => ['required', 'in:normal,admin,super_admin'],
                'password' => ['nullable', 'min:6', 'confirmed'],
            ];
        } elseif (Auth::user()->isSuperAdmin()) {
            return [
                'name' => ['required'],
                'surname' => ['required', 'min:4'],
                'email' => ['nullable', 'email', 'unique:users,email,' . $this->user_id],
                'organization_id' => ['required', 'exists:organizations,id'],
                'role' => ['required', 'in:normal,admin'],
                'password' => ['nullable', 'min:6', 'confirmed'],
            ];
        }

        return [
            'name' => ['required'],
            'surname' => ['required', 'min:4'],
            'email' => ['nullable', 'email', 'unique:users,email,' . $this->user_id],
            'password' => ['nullable', 'min:6', 'confirmed'],
        ];
    }
}
