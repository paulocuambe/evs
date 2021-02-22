<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
                'username' => ['required', 'unique:users', 'min:4'],
                'email' => ['nullable', 'email', 'unique:users'],
                // 'organization_id' => ['nullable', 'exists:organizations,id'],
                'role' => ['required', 'in:normal,admin,super_admin'],
                'password' => ['required', 'confirmed', 'min:6'],
            ];
            
        // Other super_admins rether than the sys_admin
        } elseif (Auth::user()->isSuperAdmin()) {
            return [
                'name' => ['required'],
                'surname' => ['required', 'min:4'],
                'username' => ['required', 'unique:users', 'min:4'],
                'email' => ['nullable', 'email', 'unique:users'],
                // 'organization_id' => ['required', 'exists:organizations,id'],
                'role' => ['required', 'in:normal,admin'],
                'password' => ['required', 'confirmed', 'min:6'],
            ];
        }

        // For admin
        return [
            'name' => ['required'],
            'surname' => ['required', 'min:4'],
            'username' => ['required', 'unique:users', 'min:4'],
            'email' => ['nullable', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ];
    }

    public function attributes()
    {
        return [
            // 'organization_id' => 'organization'
        ];
    }
}
