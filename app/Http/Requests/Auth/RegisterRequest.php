<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RegisterRequest extends FormRequest
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
            'fullname' => 'required|string|max:100',
            'username' => 'required|string|alpha_dash|min:5|max:20|unique:user,username',
            'email' => 'required|string|email|max:100|unique:user,email',
            'phone' => 'required|numeric|max:100|unique:user,phone',
            'password' => 'required|string|alpha_dash|confirmed|min:8',
        ];
    }
}
