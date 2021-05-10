<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'filled',
                'string',
            ],
            'password' => [
                'required',
                'filled',
                'string'
            ],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $username = $this->username;
        if (is_numeric($username)) {
            $credentials = [
                'phone' => $username,
                'password' => $this->password,
            ];
        } elseif (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $credentials = [
                'email' => $username,
                'password' => $this->password,
            ];
        } else {
            $credentials = [
                'username' => $username,
                'password' => $this->password,
            ];
        }

        if (!Auth::attempt($credentials, $this->filled('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey(): string
    {
        return Str::lower($this->input('username')) . '|' . $this->ip();
    }
}
