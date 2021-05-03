<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingProfileRequest extends FormRequest
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
        return [
            'fullname' => [
                'required',
                'filled',
                'string',
                'max:100'
            ],
            'username' => [
                'required',
                'filled',
                'string',
                'alpha_dash',
                'min:5',
                'max:20',
                Rule::unique(\App\Models\User::class, 'username')->ignore($this->user()),
            ],
            'email' => [
                'required',
                'filled',
                'string',
                'email:rfc,dns',
                'max:100',
                Rule::unique(\App\Models\User::class, 'email')->ignore($this->user()),
            ],
            'phone' => [
                'required',
                'filled',
                'numeric',
                Rule::unique(\App\Models\User::class, 'phone')->ignore($this->user()),
            ],
            'image' => [
                'filled',
                'image'
            ]
        ];
    }
}
