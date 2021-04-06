<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SettingProfileRequest;
use App\Http\Requests\Auth\SettingSecurityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use App\Models\AuthTwoFactor;

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
     * Handle an incoming profile update request.
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

        return redirect()->route('profile')->with('status', 'Profile Updated !');
    }

    /**
     * Display setting security view
     *
     * @return \Illuminate\View\View
     */
    public function security()
    {
        $twoFactor = AuthTwoFactor::all();

        $isChecked = 0;
        if (isset(Auth::user()->authTwoFactor)) {
            $isChecked = Auth::user()->authTwoFactor->id;
        }

        return view(
            'auth.setting-security',
            [
                'twoFactor' => $twoFactor,
                'isChecked' => $isChecked,
            ]
        );
    }

    /**
     * Handle an incoming profile update request.
     *
     * @param  SettingProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function securityUpdate(SettingSecurityRequest $request)
    {
        $auth = Auth::user();
        if (empty($request->twoFactor)) {
            $auth->authTwoFactor()->dissociate();
        } else {
            $authTwoFactor = AuthTwoFactor::find($request->twoFactor);
            $auth->authTwoFactor()->associate($authTwoFactor);
        }
        $auth->save();

        return redirect()->route('profile')->with('status', 'Security Updated !');
    }
}
