<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SettingProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display setting profile view
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        return view('auth.setting-profile');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  SettingProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profileUpdate(SettingProfileRequest $request)
    {
        $auth = Auth::user();
        $auth->update([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('profile')->with('status', 'Profile Updated!');
    }
}
